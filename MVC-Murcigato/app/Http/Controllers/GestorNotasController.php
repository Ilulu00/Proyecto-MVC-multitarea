<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GestorNotas as Nota;

class GestorNotasController extends Controller
{
    public function index(Request $request) {
        //Esto aqui es para el filtro, pues al crear una nota, se crea con categoria, y eso se puede filtrar. Tambien sirve para buscar por texto.
        $notas = Nota::query()
            ->when($request->q, fn($q, $b) => $q->where(fn($w) =>
                $w->where('titulo', 'like', "%$b%")->orWhere('contenido', 'like', "%$b%")))
            ->when($request->categoria, fn($q, $c) => $q->where('categoria', $c))
            ->latest()->get();

        return view('gestorNotas.index', [
            'notas' => $notas,
            'categorias' => Nota::select('categoria')->distinct()->pluck('categoria'),
        ]);
    }

    public function createNota() { return view('gestorNotas.create'); }

    public function storeNota(Request $request) {
        Nota::create($request->validate([
            'titulo' => 'required|max:255',
            'contenido' => 'required',
            'categoria' => 'required|max:100',
        ]));
        return redirect()->route('gestorNotas.index');
    }

    public function editNota(Nota $nota) {
        return view('gestorNotas.edit', compact('nota'));
        }

    public function updateNota(Request $request, Nota $nota) {
        $nota->update($request->validate([
            'titulo' => 'required|max:255',
            'contenido' => 'required',
            'categoria' => 'required|max:100',
        ]));
        return redirect()->route('gestorNotas.index');
    }

    public function destroyNota(Nota $nota) {
        $nota->delete();
        return redirect()->route('gestorNotas.index');
    }
}
