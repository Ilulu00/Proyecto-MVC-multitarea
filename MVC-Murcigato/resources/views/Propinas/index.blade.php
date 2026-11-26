@extends('layouts.app')
@section('content')

<h1 class="text-center mb-4">Calculadora de Propinas</h1>

<form method="POST" action="{{ route('propinas.calcular') }}" class="mb-4">
    @csrf
    <div class="input-group">
        <input type="number" step="0.01" min="0" name="total" class="form-control"
               placeholder="Total de la cuenta" value="{{ request('total') }}" required>
        <select name="porcentaje" class="form-select">
            @foreach ([5, 10, 15, 20, 25] as $p)
                <option value="{{ $p }}" @selected(request('porcentaje', 10) == $p)>{{ $p }}%</option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-primary">Calcular</button>
    </div>
</form>

@isset($propina)
    <div class="card">
        <ul class="list-group list-group-flush">
            <li class="list-group-item d-flex justify-content-between">
                Cuenta <span>${{ number_format(request('total'), 2) }}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between">
                Propina ({{ request('porcentaje') }}%) <span>${{ number_format($propina, 2) }}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between fw-bold">
                Total a pagar <span>${{ number_format($total, 2) }}</span>
            </li>
        </ul>
    </div>
@endisset

@endsection
