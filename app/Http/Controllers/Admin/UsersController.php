<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Agencia;
use DB;
use Auth;


class UsersController extends Controller
{
    //Mostrar tablas
    public function index(Request $req)
    {
      $q = $req->input('q');
      $users = DB::table('users')->where('name','LIKE','%'.$q.'%')->where('type',1)->paginate(25);
      foreach ($users as $key => $v) {$v->id = encrypt($v->id);}
      $data = ['users'=>$users,'q'=>$q];
      return view('admin.users.index',$data);
    }

    public function indexEjecutivo(Request $req)
    {
      $q = $req->input('q');
      $users = DB::table('users as u')
      ->join('ejecutivos as e','e.idUser','=','u.id')
      ->where('u.name','LIKE','%'.$q.'%')
      ->where('u.type',2)->paginate(25);
      foreach ($users as $key => $v) {$v->id = encrypt($v->id);}
      $data = ['users'=>$users,'q'=>$q];
      return view('admin.ejecutivos.users.index',$data);
    }
    // ACCION CRUD EJEC
    public function actionEjec(Request $req)
    {
      if($req->ajax())
      {
        // decrypt // create don't need it
        if($req->action!=='create'){

          try {
              $id = decrypt($req->arraydata['key']);
          } catch (DecryptException $e) {
              //
              return response()->json(['tipo' => 'error', 'mensaje' => $e]);
          }
        }
        // options
        switch ($req->action) {

            case 'create':
                $email = DB::table('users')->where('email', '=', $req->arraydata['email'])->first();
                //validar si existe email
                if(!$email)
                {
                    $idUser = DB::table('users')->insertGetId(['name'=>$req->arraydata['name'],'email'=>$req->arraydata['email'],
                    'password'=>Hash::make($req->arraydata['password']),'type'=>2,'created_at'=>now()]);
                    $data = DB::table('ejecutivos')->insertGetId(['idUser'=>$idUser,'nombres'=>$req->arraydata['name'],
                    'apellidos'=>$req->arraydata['apellidos'], 'telefono'=>$req->arraydata['telefono']]);
                    return response()->json(['tipo'=>200,'data'=>$data]);
                }
                else{
                    return response()->json(['tipo'=>300,'data'=>'Email existente, agregue otro correo']);
                }
                // $id=DB::table('users')->where('idUser','=',$req->arraydata=$idUser)->first();
            break;

            case 'read':
                $users = DB::table('users')->where('name','LIKE','%'.$q.'%')->where('type',2)->paginate(25);
                foreach ($users as $key => $v) {$v->id = Crypt::encryptString($v->id);}
                $data = ['users'=>$users];
                return response()->json(['tipo'=>200,'data'=>$data]);

            case 'update':
                DB::table('ejecutivos as e')->join('users as u','e.idUser','=','u.id')->where('e.id',$id)->update(['e.nombres'=>$req->arraydata['name'],
                'e.apellidos'=>$req->arraydata['apellidos'],'e.telefono'=>$req->arraydata['telefono'],'u.email'=>$req->arraydata['email'],
                'u.password'=>$req->arraydata['password'],'e.updated_at'=>now(),'u.updated_at'=>now()]);
                if($req->arraydata['password']!=="12345678")
                {
                    //encrypt password
                    $contraseña=Hash::make($req->arraydata['password']);
                    DB::table('ejecutivos as e')->join('users as u','e.idUser','=','u.id')->where('e.id',$id)->update(['u.password'=>$contraseña]);
                }
                    return response()->json(['tipo'=>200]);
                    break;

            case 'delete':
                DB::table('users as u')->join('ejecutivos as e','u.id','=','e.idUser')->where('e.id',$id)->delete();
                return response()->json(['tipo'=>200]);
                break;
        }
      }else{App::abort(404, 'message');}
    }

    // actions CRUD ADMIN
    public function action(Request $req)
    {
      if($req->ajax())
      {
        // decrypt // create don't need it
        if($req->action!=='create'){
          try {
              $id = decrypt($req->arraydata['key']);
          } catch (DecryptException $e) {
              //
              return response()->json(['tipo' => 'error', 'mensaje' => $e]);
          }
        }

        // options
        switch ($req->action) {

            case 'create':
            $data = DB::table('users')->insertGetId(['name'=>$req->arraydata['name'],'email'=>$req->arraydata['email'],
            'password'=>Hash::make($req->arraydata['password']),'type'=>1,'created_at'=>now()]);
            return response()->json(['tipo'=>200,'data'=>$data]);
            break;

            case 'read':
            $users = DB::table('users')->where('name','LIKE','%'.$q.'%')->where('type',1)->paginate(25);
            foreach ($users as $key => $v) {$v->id = Crypt::encryptString($v->id);}
            $data = ['users'=>$users];
            return response()->json(['tipo'=>200,'data'=>$data]);

            case 'update':
            // code...
            DB::table('users')->where('id',$id)->update(['name'=>$req->arraydata['name'],'email'=>$req->arraydata['email']
            ,'updated_at'=>now()]);
            if($req->arraydata['password']!==""){
                DB::table('users')->where('id',$id)->update(['password'=>Hash::make($req->arraydata['password'])]);
            }
            return response()->json(['tipo'=>200]);
            break;

          case 'delete':
            // code...
            DB::table('users')->where('id',$id)->delete();
            return response()->json(['tipo'=>200]);
            break;
        }
      }else{App::abort(404, 'message');}
    }

}
