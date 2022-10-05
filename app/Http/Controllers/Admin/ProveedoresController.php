<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use App\Models\Agencia;
use DB;
use Auth;

class ProveedoresController extends Controller
{
    public function indexProv(Request $req){
        $q = $req->input('q');
        $users = DB::table('proveedor_circuitos')
        ->where('proveedor','LIKE','%'.$q.'%')->select('id','proveedor','telefono','email')
        ->get();
        foreach ($users as $key => $v) {$v->id = encrypt($v->id);}
        $data = ['users'=>$users,'q'=>$q];
        return view('admin.circuitos.proveedores.index',$data);
    }

    public function actionProv(Request $req){

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
            DB::table('proveedor_circuitos')->insertGetId(['proveedor'=>$req->arraydata['prov'],'telefono'=>$req->arraydata['tel'],'email'=>$req->arraydata['email']]);
            return response()->json(['tipo'=>200]);
            break;

          case 'read':

            $users = DB::table('proveedor_circuitos')->where('hotel','LIKE','%'.$q.'%');
            foreach ($users as $key => $v) {$v->id = encrypt($v->id);}
            $data = ['users'=>$users];
            return response()->json(['tipo'=>200,'data'=>$data]);
            break;

          case 'update':
            // dd($id);
            DB::table('proveedor_circuitos')->where('id',$id)->update(['proveedor'=>$req->arraydata['prov'],'telefono'=>$req->arraydata['tel'],'email'=>$req->arraydata['email']]);
            return response()->json(['tipo'=>200]);
            break;

          case 'delete':
            DB::table('proveedor_circuitos')->where('id',$id)->delete();
            return response()->json(['tipo'=>200]);
        }
      }else{return response()->json(['tipo' => 500]); }
    }

}
