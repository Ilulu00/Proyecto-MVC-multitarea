<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GestorGastos as Gasto;

class GestorGastosController extends Controller
{
    public function index(Request $request) {
        $mes = $request->input('mes', now()->format('Y-m'));
        //este if es para el filtro, tipo que se pueda filtrar aglun mes en especifico, o todos en general.
        if (blank($mes) || $mes === 'todos') {
            $mes = 'todos';
            $gastos = Gasto::orderByDesc('fecha')->get();
        } else {
            [$anio, $numMes] = explode('-', $mes);
            $gastos = Gasto::whereYear('fecha', $anio)->whereMonth('fecha', $numMes)
                           ->orderByDesc('fecha')->get();
        }

        $resumen = $gastos->groupBy('categoria')->map->sum('monto');

        return view('gestorGastos.index', [
            'gastos'  => $gastos,
            'resumen' => $resumen,
            'total'   => $gastos->sum('monto'),
            'mes'     => $mes,
        ]);
    }

    public function storeGasto(Request $request) {
        Gasto::create($request->validate([
            'descripcion' => 'required|string|max:255',
            'monto'       => 'required|numeric|min:0.01',
            'categoria'   => 'required|string|max:100',
            'fecha'       => 'required|date',
        ]));
        return back();
    }

    public function destroyGasto(Gasto $gasto) {
        $gasto->delete();
        return back();
    }
}
