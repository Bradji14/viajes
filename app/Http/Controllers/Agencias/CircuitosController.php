<?php

namespace App\Http\Controllers\Agencias;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use DB;

class CircuitosController extends Controller
{
    //
    public function index(Request $req)
    {
      return view('agencias.circuitos.index');
    }
    public function destino(Request $req)
    {
      return view('agencias.circuitos.resultados');
    }
    // get request of Destino
    public function getItems(Request $req)
    {
      // select from circuitos when IATA or ID Destino equals --> circuitos join destino where IATA = ?
      if (isset($req->slug)) {
        // code...
        $data = ['items'=>'items'];
        return response()->json(['tipo'=>200,'data'=>$data]);
      }else{return response()->json(['tipo'=>500]); }
    }
    public function DetallesCicuito(Request $req)
    {
      return view('agencias.circuitos.resultados');
    }
}
