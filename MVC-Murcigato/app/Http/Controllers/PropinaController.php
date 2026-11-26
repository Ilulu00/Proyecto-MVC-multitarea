<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PropinaController extends Controller
{
    public function index()
    {
        return view('propinas.index');
    }

    public function calcular(Request $request)
    {
        $datos = $request->validate([
            'total' => 'required|numeric|min:0',
            'porcentaje' => 'required|numeric|min:0|max:100',
        ]);

        $total = $datos['total'];
        $porcentaje = $datos['porcentaje'];

        $propina = ($total * $porcentaje) / 100;

        return view('propinas.index', ['propina' => $propina, 'total' => $datos['total'] + $propina, 'porcentaje' => $porcentaje]);
    }
}
