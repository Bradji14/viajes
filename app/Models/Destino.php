<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destino extends Model
{
    public $timestamps = false;

    use HasFactory;

    public $fillable=
    [
      'destino',
      'iataDestino',
      'aeropuertoDestino',
      'iataPais'
    ];
}
