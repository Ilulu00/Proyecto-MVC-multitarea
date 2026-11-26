<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservas extends Model
{
    protected $fillable = ['nombre', 'servicio', 'fecha', 'hora', 'estado'];
}
