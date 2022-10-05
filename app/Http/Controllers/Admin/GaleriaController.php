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


class GaleriaController extends Controller
{
  public function action(Request $req)
  {
    dd($req);
  }
}
