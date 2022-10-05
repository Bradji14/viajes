<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Destino;
use App\Models\Paises;
use App\Models\Estados;
use DB;
use Auth;

class DestinosController extends Controller
{
    public function destSearch(Request $req){
        $data=DB::table('destinos')->where('destino','LIKE','%'.$req->q.'%')->get();
        return response()->json($data);
    }
    public function paisesSearch(Request $request){

        $data=DB::table('paises')->where('id','LIKE','%'.$request->id.'%')->get();
        return response()->json($data);
    }
    //accciones destino
    public function indexDest(Request $req){
        // $users = DB::table('destinos')->where('destino','LIKE','%'.$q.'%')->select('id','destino','aeropuertoDestino','iataPais')->get();

        $q = $req->input('q');
        $users = DB::table('destinos')
        ->where('destino','LIKE','%'.$q.'%')->select('idDestino as id','destino','iataDestino','aeropuertoDestino','iataPais')
        ->get();
        foreach ($users as $key => $v) {$v->id = encrypt($v->id);}
        $data = ['users'=>$users,'q'=>$q];
        return view('admin.destinos.index',$data);
    }

    public function actionDest(Request $req){
        // if call via ajax
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
        // options CRUD
        switch ($req->action) {
          case 'create':
            $dest= new Destino;
            $dest->destino = $req->arraydata['dest'];
            $dest->iataDestino =$req->arraydata['iata'];
            $dest->aeropuertoDestino = $req->arraydata['aero'];
            $dest->iataPais= $req->arraydata['iataPais'];
            $dest->save();
            return response()->json(['tipo'=>200]);
            break;

          case 'read':
            $users = Destino::where('destino','LIKE','%'.$q.'%')->get();
            foreach ($users as $key => $v) {$v->id = encrypt($v->id);}
            $data = ['users'=>$users];
            return response()->json(['tipo'=>200,'data'=>$data]);
            break;

          case 'update':
            $dest=Destino::find($id);
            $dest->destino = $req->arraydata['dest'];
            $dest->iataDestino =$req->arraydata['iata'];
            $dest->aeropuertoDestino = $req->arraydata['aero'];
            $dest->iataPais= $req->arraydata['iataPais'];
            $dest->update();
            return response()->json(['tipo'=>200]);
            break;

            case 'delete':
            $agen=Destino::find($id)->delete();
            return response()->json(['tipo'=>200]);
        }
      }else{return response()->json(['tipo' => 500]); }
    }

    //acciones paises
    public function indexDP(Request $req){
        $q = $req->input('q');
        $users = DB::table('paises')
        ->where('pais','LIKE','%'.$q.'%')->select('id','pais','IATA')
        ->get();
        foreach ($users as $key => $v) {$v->id = encrypt($v->id);}
        $data = ['users'=>$users,'q'=>$q];

        return view('admin.destinos.paises.index',$data);
    }

    public function actionDP(Request $req){
        if($req->ajax())
        {
          if($req->action!=='create'){
            try {
                $idPais = decrypt($req->arraydata['key']);
            } catch (DecryptException $e) {
                //
                return response()->json(['tipo' => 'error', 'mensaje' => $e]);
            }
          }
        // options CRUD
        switch ($req->action) {
          case 'create':
            $country= new Paises;
            $country->pais = $req->arraydata['pais'];
            $country->IATA =$req->arraydata['iata'];
            $country->save();
            return response()->json(['tipo'=>200]);
            break;

          case 'read':
            $users = Paises::where('pais','LIKE','%'.$q.'%');
               foreach ($users as $key => $v) {$v->id = encrypt($v->id);}
               $data = ['users'=>$users];
               return response()->json(['tipo'=>200,'data'=>$data]);
               break;
            break;

          case 'update':
            $country=Paises::find($idPais);
            $country->pais = $req->arraydata['pais'];
            $country->IATA =$req->arraydata['iata'];
            $country->update();
            return response()->json(['tipo'=>200]);
            break;

            case 'delete':
            $country=Paises::find($idPais)->delete();
            return response()->json(['tipo'=>200]);
        }
      }else{return response()->json(['tipo' => 500]); }
    }

    //acciones estados
    public function indexDE(Request $req){
        $q = $req->input('q');
        $users = DB::table('estados as e')
        ->join('paises as p','p.id','=','e.paises_idPais')
        ->where('estado','LIKE','%'.$q.'%')->select('e.id','e.paises_idPais','e.estado','p.pais')
        ->get();
        foreach ($users as $key => $v) {$v->id = encrypt($v->id);}
        $data = ['users'=>$users,'q'=>$q];
        return view('admin.destinos.estados.index',$data);
    }

    public function actionDE(Request $req){
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
            DB::table('estados')->insertGetId(['paises_idPais'=>$req->arraydata['paisid'],'estado'=>$req->arraydata['estado']]);
            return response()->json(['tipo'=>200]);
            break;

          case 'read':

            $users = DB::table('estados')->where('estado','LIKE','%'.$q.'%');
            foreach ($users as $key => $v) {$v->id = encrypt($v->id);}
            $data = ['users'=>$users];
            return response()->json(['tipo'=>200,'data'=>$data]);
            break;

          case 'update':
            DB::table('estados')->where('id',$id)->update(['paises_idPais'=>$req->arraydata['paisid'],'estado'=>$req->arraydata['estado']]);
            return response()->json(['tipo'=>200]);
            break;

          case 'delete':
            DB::table('estados')->where('id',$id)->delete();
            return response()->json(['tipo'=>200]);
        }
      }else{return response()->json(['tipo' => 500]); }
    }

}
