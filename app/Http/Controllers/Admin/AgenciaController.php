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


class AgenciaController extends Controller
{

    public function indexAgencia(Request $req)
    {
      $q = $req->input('q');
      $users =DB::table('agencias')->where('nombreAgen','LIKE','%'.$q.'%')->where('type',0)->where('deleted_at',null)->paginate(25);;
      foreach ($users as $key => $v) {$v->id = encrypt($v->id);}
      $data = ['users'=>$users,'q'=>$q];
      return view('admin.agencias.index',$data);

    }

    public function actionAgencia(Request $req)
    {
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
                $agen= new Agencia;
                $agen->nombreAgen = $req->arraydata['agencia'];
                $agen->type =0;
                $agen->razon_social = $req->arraydata['social'];
                $agen->RFC= $req->arraydata['rfc'];
                $agen->DestinosID = $req->arraydata['destinos'];//?
                $agen->telefono = $req->arraydata['phone'];
                $agen->web = $req->arraydata['web'];
                $agen->email = $req->arraydata['email'];
                $agen->direccion = $req->arraydata['direc'];
                $agen->save();
               return response()->json(['tipo'=>200]);
               break;

            case 'read':
               $users = Agencia::where('nombreAgencia','LIKE','%'.$q.'%')->where('type',0)->paginate(25);
               foreach ($users as $key => $v) {$v->id = Crypt::encryptString($v->id);}
               $data = ['users'=>$users];
               return response()->json(['tipo'=>200,'data'=>$data]);
               break;

            case 'update':

              $agen=Agencia::find($id);
              $agen->nombreAgen = $req->arraydata['agencia'];
              $agen->type =0;
              $agen->razon_social = $req->arraydata['social'];
              $agen->RFC= $req->arraydata['rfc'];
              $agen->DestinosID = $req->arraydata['destinos'];//?
              $agen->telefono = $req->arraydata['phone'];
              $agen->web = $req->arraydata['web'];
              $agen->email = $req->arraydata['email'];
              $agen->direccion = $req->arraydata['direc'];
              $agen->update();
              return response()->json(['tipo'=>200]);
              break;

            case 'delete':

              Agencia::find($id)->delete();
              return response()->json(['tipo'=>200]);
              break;
        }
        }else{App::abort(404, 'message');}
    }

    public function actionAgeUs(Request $req){
      // if call via ajax
      if ($req->ajax()) {
        //
        try {
            $id = decrypt($req->AgenciaID);
        } catch (DecryptException $e) {
            //
            return response()->json(['tipo' => 'error', 'mensaje' => $e]);
        }
        // options CRUD
        switch ($req->action) {
          case 'create':
            // code...
            return response()->json(['tipo'=>200,'title'=>"El usuario ha sido creado correctamente"]);
            break;

          case 'read':
            // code...
            $users = DB::table('users as u')
                      ->join('agencias_usuarios as au','au.id_usuario','=','u.id')
                      ->where('au.id_agencia',$id)
                      ->select('u.id','u.name','u.email')->get();
            foreach ($users as $key => $v) {$v->id = decrypt($v->id);}
            $data = ['users'=>$users];
            return response()->json(['tipo'=>200,'data'=>$data]);
            break;

          case 'update':
            //code
            DB::table('users')->where('id',$id)->update(['name'=>$req->arraydata['name']]);
            if (isset($req->arraydata['password']) && $req->arraydata['password'] !== 12345678) {
              // code...
            }
            return response()->json(['tipo'=>200,'title'=>"El usuario ha sido actualizado correctamente"]);
            break;

          case 'delete':
            //code
            return response()->json(['tipo'=>200,'title'=>"El usuario ha sido eliminado correctamente"]);
            break;
        }
      }else{return response()->json(['tipo' => 500]); }

    }
}
