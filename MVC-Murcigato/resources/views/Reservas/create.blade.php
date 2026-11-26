@extends('layouts.app')
@section('content')

    @php
        $servicios = ['Corte de cabello', 'Manicure', 'Masaje', 'Consulta general'];
    @endphp

    <h1 class="text-center mb-4">Nueva reserva</h1>

    <form method="GET" action="{{ route('reservas.createReserva') }}" class="mb-4">
        <div class="input-group">
            <select name="servicio" class="form-select">
                @foreach ($servicios as $s)
                    <option value="{{ $s }}" @selected($s === $servicio)>{{ $s }}</option>
                @endforeach
            </select>
            <input type="date" name="fecha" class="form-control" value="{{ $fecha }}"
                min="{{ now()->toDateString() }}">
            <button class="btn btn-outline-secondary">Ver disponibilidad</button>
        </div>
    </form>

    @if (count($disponibles) > 0)
        <form method="POST" action="{{ route('reservas.storeReserva') }}">
            @csrf
            <input type="hidden" name="servicio" value="{{ $servicio }}">
            <input type="hidden" name="fecha" value="{{ $fecha }}">

            <div class="mb-3">
                <label class="form-label">Horarios disponibles para {{ $servicio }} el {{ $fecha }}</label>
                <div>
                    @foreach ($disponibles as $hora)
                        <input type="radio" class="btn-check" name="hora" id="hora{{ $loop->index }}"
                            value="{{ $hora }}" required>
                        <label class="btn btn-outline-primary me-1 mb-1"
                            for="hora{{ $loop->index }}">{{ $hora }}</label>
                    @endforeach
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Tu nombre</label>
                <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" required>
            </div>

            <button type="submit" class="btn btn-success">Confirmar reserva</button>
            <a href="{{ route('reservas.index') }}" class="btn btn-link">Volver</a>
        </form>
    @else
        <div class="alert alert-warning">No hay horarios disponibles ese día. Prueba con otra fecha.</div>
    @endif

@endsection
