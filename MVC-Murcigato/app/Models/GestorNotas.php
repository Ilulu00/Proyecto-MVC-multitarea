<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GestorNotas extends Model
{
    protected $fillable = ['titulo', 'contenido', 'categoria'];
}
