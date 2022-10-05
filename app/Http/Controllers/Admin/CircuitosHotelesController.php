<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Categorias;
use DB;
use Auth;


class CircuitosHotelesController extends Controller
{
    //acciones hoteles
    public function indexHo(Request $req){
        $q = $req->input('q');
        $users = DB::table('circuitos_hoteles as h')
        ->join('circuitos_hoteles_categorias as hc','hc.id','=','h.CategoriaID')
        ->join('destinos as d','d.idDestino','=','h.DestinoID')
        ->where('hotel','LIKE','%'.$q.'%')
        ->select('h.*','hc.categoria','d.destino')
        ->get();

        foreach ($users as $key => $v) {$v->id = encrypt($v->id);}
        $data = ['users'=>$users,'q'=>$q];
        $categories = DB::table('circuitos_hoteles_categorias')->select('*')->get();

        return view('admin.circuitos.hoteles.index',$data,array("categorias"=>$categories));
    }
    public function actionHo(Request $req){
        if($req->ajax())
        {
          if($req->action!=='create'){
            try {
                $id = decrypt($req->arraydata['key']);
            } catch (DecryptException $e) {
                //
                return response()->json(['tipo' => 'error', 'mensaje' => $e]);
            }
          }
        switch ($req->action) {
          case 'create':
            DB::table('circuitos_hoteles')->insertGetId(['CategoriaID'=>$req->arraydata['cat'],'DestinoID'=>$req->arraydata['destinoid'],'hotel'=>$req->arraydata['hotel']]);
            return response()->json(['tipo'=>200]);
            break;

          case 'read':

            $users = DB::table('circuitos_hoteles')->where('hotel','LIKE','%'.$q.'%');
            foreach ($users as $key => $v) {$v->id = encrypt($v->id);}
            $data = ['users'=>$users];
            return response()->json(['tipo'=>200,'data'=>$data]);
            break;

          case 'update':
            DB::table('circuitos_hoteles')->where('id',$id)->update(['CategoriaID'=>$req->arraydata['cat'],'DestinoID'=>$req->arraydata['destinoid'],'hotel'=>$req->arraydata['hotel']]);
            return response()->json(['tipo'=>200]);
            break;

          case 'delete':
            DB::table('circuitos_hoteles')->where('id',$id)->delete();
            return response()->json(['tipo'=>200]);
        }
      }else{return response()->json(['tipo' => 500]); }
    }
    //acciones hoteles-categorias
    public function indexHoCat(Request $req){
        $q = $req->input('q');
        $users = DB::table('circuitos_hoteles_categorias')
        ->where('categoria','LIKE','%'.$q.'%')
        ->select('id','categoria')
        ->get();
        foreach ($users as $key => $v) {$v->id = encrypt($v->id);}
        $data = ['users'=>$users,'q'=>$q];
        return view('admin.circuitos.hoteles.hotelesCategorias.index',$data);
    }
    public function actionHoCat(Request $req){
        if($req->ajax())
        {
          if($req->action!=='create'){
            try {
                $id = decrypt($req->arraydata['key']);
            } catch (DecryptException $e) {
                //
                return response()->json(['tipo' => 'error', 'mensaje' => $e]);
            }
          }
        switch ($req->action) {
          case 'create':
            DB::table('circuitos_hoteles_categorias')->insertGetId(['categoria'=>$req->arraydata['cat']]);
            return response()->json(['tipo'=>200]);
            break;

          case 'read':
            $users = DB::table('circuitos_hoteles_categorias')->where('categoria','LIKE','%'.$q.'%');
            foreach ($users as $key => $v) {$v->id = encrypt($v->id);}
            $data = ['users'=>$users];
            return response()->json(['tipo'=>200,'data'=>$data]);
            break;

          case 'update':
            DB::table('circuitos_hoteles_categorias')->where('id',$id)->update(['categoria'=>$req->arraydata['cat']]);
            return response()->json(['tipo'=>200]);
            break;

          case 'delete':
            DB::table('circuitos_hoteles_categorias')->where('id',$id)->delete();
            return response()->json(['tipo'=>200]);
        }
      }else{return response()->json(['tipo' => 500]); }

    }

    //autocomplete
    public function hotelesSearch(Request $req)
    {
        $data=DB::table('circuitos_hoteles as h')
        ->join('destinos as d','d.idDestino','=','h.DestinoID')
        ->where('h.hotel','LIKE','%'.$req->q.'%')->get();
        return response()->json($data);
    }


}
