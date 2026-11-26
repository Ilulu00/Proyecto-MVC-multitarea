<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Reservas as Reserva;

class ReservasController extends Controller
{
    private const HORAS = ['09:00','10:00','11:00','14:00','15:00','16:00'];

    public function index() {
        return view('reservas.index', ['reservas' => Reserva::orderBy('fecha')->orderBy('hora')->get()]);
    }

    public function createReserva(Request $request) {
        $fecha = $request->input('fecha', now()->toDateString());
        $servicio = $request->input('servicio', 'Corte de cabello');
        //este de aqui sirve para digamos filtrar las reservas ya hechas.
        $ocupadas = Reserva::where('fecha', $fecha)->where('servicio', $servicio)
                           ->pluck('hora')->map(fn($h) => substr($h, 0, 5))->all();

        return view('reservas.create', [
            'fecha' => $fecha,
            'servicio' => $servicio,
            'disponibles' => array_diff(self::HORAS, $ocupadas),
        ]);
    }

    public function storeReserva(Request $request) {
        $datos = $request->validate([
            'nombre'   => 'required|string|max:100',
            'servicio' => 'required|string',
            'fecha'    => 'required|date|after_or_equal:today',
            'hora'     => ['required', Rule::in(self::HORAS)],
        ]);

        $horarioOcupado = Reserva::where('fecha', $datos['fecha'])
            ->where('servicio', $datos['servicio'])
            ->where('hora', $datos['hora'])
            ->exists();

        if ($horarioOcupado) {
            return back()->withErrors(['hora' => 'Ese horario ya fue reservado.'])->withInput();
        }

        Reserva::create($datos);
        return redirect()->route('reservas.index')->with('ok', 'Reserva confirmada');
    }

    public function destroyReserva(Reserva $reserva) {
        $reserva->delete();
        return back();
    }
}
