<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vuelta;

class CronometroController extends Controller
{
    public function index(){
        return view('cronometro.index', ['vueltas' => Vuelta::orderBy('id')->get()]);
    }

    public function storeVuelta(Request $request){
        $datos = $request->validate([
            'parcial_ms' => 'required|integer|min:0',
            'total_ms' => 'required|integer|min:0',
        ]);
        return response()->json(Vuelta::create($datos), 201);
    }

    public function limpiar() {
        Vuelta::query()->delete();
        return response()->noContent();

    }
}
