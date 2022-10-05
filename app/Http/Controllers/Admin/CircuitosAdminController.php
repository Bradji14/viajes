<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Image;
use DB;
use Auth;


class CircuitosAdminController extends Controller
{
    //Mostrar tablas
    public function index(Request $req)
    {
      $proveedores = DB::table('proveedor_circuitos')->get();
      $comision = DB::table('circuitos_tarifas_comision')->get();
      $tag = DB::table('circuitos_tag')->get();
      $data = ['proveedores'=>$proveedores,'comision'=>$comision,'tag'=>$tag];
      return view('admin.circuitos.main',$data);
    }
    // Circuitos CRUD
    public function actionCT(Request $req)
    {
      $datos = json_decode($req->datos);
      $res;
      //
      if(isset($datos->id)){
        try {
            $id = decrypt($datos->id);
        } catch (DecryptException $e) {
            //
            return response()->json(['tipo' => 'error', 'mensaje' => $e]);
        }
      }
      switch ($datos->action) {
        case 'read':
          // code...
          $circuitos = DB::table('circuitos as c')
                      ->join('proveedor_circuitos as pc','pc.id','=','c.ProveedorID')
                      ->join('circuitos_tag as t','t.id','=','c.TagID')
                      ->where('c.circuito','LIKE','%'.$datos->q.'%')
                      ->orWhere('c.id','LIKE','%'.$datos->q.'%')
                      ->orWhere('t.tag','LIKE','%'.$datos->q.'%')
                      ->select('c.id','c.id as clave','c.circuito','pc.proveedor','t.tag','c.tipo')
                      ->limit($datos->limit)->get();
          foreach ($circuitos as $key => $v) {$v->id = encrypt($v->id);}
          $res = ['tipo'=>200,'circuitos'=>$circuitos];
          break;

        case 'view':
          // code...
          $data = DB::table('circuitos as c')->join('imagenes as i','i.id','=','c.FeaturedID')
          ->where('c.id',$id)->selecT('c.*','i.src')->first();
          $res = ['tipo'=>200,'data'=>$data];
          break;

        case 'create':
          //$file = $req->file('file');
          $CircuitosID = DB::table('circuitos')->insertGetid(['ProveedorID'=>$datos->arraydata->{'proveedor'},
          'ComisionID'=>$datos->arraydata->{'comision'},'FeaturedID'=>1,'TagID'=>$datos->arraydata->{'comision'},
          'circuito'=>$datos->arraydata->{'circuito'},'tipo'=>$datos->arraydata->{'tipo'},'dias'=>$datos->arraydata->{'dias'},
          'noches'=>$datos->arraydata->{'noches'},'vigencia'=>$datos->arraydata->{'vigencia'},'visitando'=>$datos->arraydata->{'visitando'},
          'incluye'=>$datos->arraydata->{'incluye'},'no_incluye'=>$datos->arraydata->{'noincluye'},
          'info_suplemento'=>$datos->arraydata->{'infosuplemento'},'info_salidas'=>$datos->arraydata->{'infosalidas'},'created_at'=>now()]);
          if($req->file('file')){
            $Y = date("Y");
            $M = date("m");
            $file = $req->file('file'); $img = Image::make($file);
            $path = '/images/'.$Y.'/'.$M.'/';
            $name = time().'.'.$file->getClientOriginalExtension();
            $img->resize(450, null, function ($constraint) {$constraint->aspectRatio();})->encode();
            $image = Storage::disk('upfiles')->put($path.$name, $img); // Save
            // DB
            $FeaturedID = DB::table('imagenes')->insertGetid(['uploadedBy'=>Auth::id(),'src'=>$path.$name,'created_at'=>now()]);
            DB::table('circuitos')->where('id',$CircuitosID)->update(['FeaturedID'=>$FeaturedID]);
          }

          $res = ['tipo'=>200];
          break;

        case 'update':
          DB::table('circuitos')->where('id',$id)->update(['ProveedorID'=>$datos->arraydata->{'proveedor'},
          'ComisionID'=>$datos->arraydata->{'comision'},'TagID'=>$datos->arraydata->{'comision'},
          'circuito'=>$datos->arraydata->{'circuito'},'tipo'=>$datos->arraydata->{'tipo'},'dias'=>$datos->arraydata->{'dias'},
          'noches'=>$datos->arraydata->{'noches'},'vigencia'=>$datos->arraydata->{'vigencia'},'visitando'=>$datos->arraydata->{'visitando'},
          'incluye'=>$datos->arraydata->{'incluye'},'no_incluye'=>$datos->arraydata->{'noincluye'},
          'info_suplemento'=>$datos->arraydata->{'infosuplemento'},'info_salidas'=>$datos->arraydata->{'infosalidas'},'updated_at'=>now()]);
          // if has image
          if($req->file('file')){
            $Y = date("Y");
            $M = date("m");
            $file = $req->file('file'); $img = Image::make($file);
            $path = '/images/'.$Y.'/'.$M.'/';
            $name = time().'.'.$file->getClientOriginalExtension();
            $img->resize(450, null, function ($constraint) {$constraint->aspectRatio();})->encode();
            $image = Storage::disk('upfiles')->put($path.$name, $img); // Save
            // DB
            $FeaturedID = DB::table('imagenes')->insertGetid(['uploadedBy'=>Auth::id(),'src'=>$path.$name,'created_at'=>now()]);
            DB::table('circuitos')->where('id',$id)->update(['FeaturedID'=>$FeaturedID]);
          }
          $res = ['tipo'=>200];
          break;


      }
      return response()->json($res);
    }
    // Itinerario CRUD
    public function itinerario(Request $req)
    {
      $res;
      try {
          $id = decrypt($req->id);
      } catch (DecryptException $e) {
          //
          return response()->json(['tipo' => 'error', 'mensaje' => $e]);
      }
      switch ($req->action) {
        case 'read':
          $itinerario = DB::table('circuitos_itinerario')->where('CircuitosID',$id)->first();
          if(isset($itinerario)){$itinerario->id = encrypt($itinerario->id);}
          $res = ['tipo'=>200,'itinerario'=>$itinerario];
          break;

        case 'create':
          $id = DB::table('circuitos_itinerario')->insertGetid(['CircuitosID'=>$id,'content'=>$req->arraydata['itinerario']]);
          $res = ['tipo'=>200,'itinerario'=>$id];
          break;

        case 'update':
          DB::table('circuitos_itinerario')->where('id',$id)->update(['content'=>$req->arraydata['itinerario']]);
          $res = ['tipo'=>200];
          break;

        }
        return response()->json($res);
    }
    // Galeria CRUD
    public function galeria(Request $req)
    {

    }
    // Hoteles CRUD
    public function hoteles(Request $req)
    {
        $res;
        try {
            $id = decrypt($req->id);
        } catch (DecryptException $e) {

            return response()->json(['tipo' => 'error', 'mensaje' => $e]);
        }
        switch ($req->action) {
          case 'read':
            $relacion = DB::table('circuitos_hoteles_relacional as hr')
            ->join('circuitos_hoteles as ch','ch.id','=','hr.HotelID')
            ->join('destinos as d','d.idDestino','=','ch.DestinoID')
            ->where('hr.CircuitosID',$id)
            ->select('hr.*','ch.hotel','d.destino','d.iataPais')
            ->get();
            // encryptar todos los id
            foreach ($relacion as $key => $v) {$v->id = encrypt($v->id);}
            $res = ['tipo'=>200,'relacion'=>$relacion];
            break;

          case 'create':

                // $dt=DB::table('circuitos_hoteles_relacional')->insertGetid(['CircuitosID'=>$i,'HotelID'=>$req->arraydata['idHotel']]);
                $hotel = DB::table('circuitos_hoteles_relacional')->where('CircuitosID', '=', $req->arraydata['idCircuito']);
                if($hotel==false){

                    $dt=DB::table('circuitos_hoteles_relacional')->insertGetid(['CircuitosID'=>decrypt($req->arraydata['idCircuito']),'HotelID'=>$req->arraydata['idHotel']]);
                    $res = ['tipo'=>200,'relacion'=>$dt];
                }
                else{
                    return response()->json(['tipo'=>300,'data'=>'hotel repetido']);
                }


            break;

          case 'delete':
            //id tabla relacion
            $deHr=DB::table('circuitos_hoteles_relacional')->where('id',$id)->delete();
            $res = ['tipo'=>200,'relacion'=>$deHr];
            break;
          }
          return response()->json($res);
    }













    // Salidas CRUD
    public function salidas(Request $req)
    {

    }
    // Tarifas CRUD
    public function tarifas(Request $req)
    {

    }
}
