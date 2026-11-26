<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GestorGastos extends Model
{
    protected $fillable = ['descripcion', 'monto', 'categoria', 'fecha'];
}
