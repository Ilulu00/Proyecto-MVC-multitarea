<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ListaTareas;

class ListaTareasController extends Controller
{
    public function index() {
        return view('listaTareas.index', ['listaTareas' => ListaTareas::Latest()->get()]);
    }

    public function storeTarea(Request $request) {
        $request->validate([
            'titulo' => 'required|string|max:255',
        ]);

        ListaTareas::create([
            'titulo' => $request->input('titulo'),
            'completada' => false,
        ]);

        return redirect()->route('listaTareas.index');
    }

    public function completar(ListaTareas $tarea) {
        $tarea->completada = !$tarea->completada;
        $tarea->save();

        return redirect()->route('listaTareas.index');
    }

    public function destroyTarea(ListaTareas $tarea) {
        $tarea->delete();
        return redirect()->route('listaTareas.index');
    }
}
