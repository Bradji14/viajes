<?php

namespace App\Http\Controllers\Agencias;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use DB;

class HotelesController extends Controller
{
    //
    public function index(Request $req)
    {
      return view('agencias.hoteles.index');
    }
}
