@extends('layouts.app')
@section('content')
    <h1 class="text-center mb-4">Sistema de Reservas</h1>

    <div class="mb-3">
        <a href="{{ route('reservas.createReserva') }}" class="btn btn-primary">Nueva reserva</a>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Servicio</th>
                <th>Nombre</th>
                <th>Estado</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($reservas as $reserva)
                <tr>
                    <td>{{ $reserva->fecha }}</td>
                    <td>{{ substr($reserva->hora, 0, 5) }}</td>
                    <td>{{ $reserva->servicio }}</td>
                    <td>{{ $reserva->nombre }}</td>
                    <td><span class="badge bg-success">{{ ucfirst($reserva->estado) }}</span></td>
                    <td>
                        <form method="POST" action="{{ route('reservas.destroyReserva', $reserva) }}"
                            onsubmit="return confirm('¿Cancelar esta reserva?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Cancelar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">No hay reservas todavía.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
