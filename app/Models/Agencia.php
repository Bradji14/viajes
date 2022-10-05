<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use  Illuminate\Database\Eloquent\SoftDeletes;

class Agencia extends Model

{

    use SoftDeletes;
    protected $dates=['deleted_at'];

    public $timestamps = true;

    use HasFactory;

    public $fillable=
    [
    'nombreAgen',
    'type',
    'razon_social',
    'RFC',
    'id_destino',
    'telefono',
    'web',
    'email',
    'direccion'
    ];



}
