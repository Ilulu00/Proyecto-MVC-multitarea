@extends('layouts.app')
@section('content')
    <h1 class="text-center mb-4">Gestor de Gastos</h1>
    <form method="POST" action="{{ route('gestorGastos.storeGasto') }}" class="mb-4">
        @csrf
        <div class="input-group mb-2">
            <input type="text" name="descripcion" class="form-control" placeholder="Descripción del gasto" required>
            <input type="number" step="0.01" name="monto" class="form-control" placeholder="Monto" required>
            <input type="text" name="categoria" class="form-control" placeholder="Categoría" required>
            <input type="date" name="fecha" class="form-control" required>
            <button type="submit" class="btn btn-primary">Agregar Gasto</button>
        </div>
    </form>

    <form method="GET" action="{{ route('gestorGastos.index') }}" class="mb-4">
        <div class="input-group w-auto">
            <input type="month" name="mes" class="form-control" value="{{ $mes === 'todos' ? '' : $mes }}">
            <button class="btn btn-outline-secondary">Filtrar</button>
            <a href="{{ route('gestorGastos.index', ['mes' => 'todos']) }}" class="btn btn-outline-secondary">Todos los meses</a>
        </div>
        @if ($mes === 'todos')
            <small class="d-block mt-2">Mostrando gastos de todos los meses.</small>
        @endif
    </form>

    <div class="row">
        <div class="col-md-8">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Descripción</th>
                        <th>Categoría</th>
                        <th class="text-end">Monto</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($gastos as $gestorGasto)
                        <tr>
                            <td>{{ $gestorGasto->fecha }}</td>
                            <td>{{ $gestorGasto->descripcion }}</td>
                            <td>{{ $gestorGasto->categoria }}</td>
                            <td class="text-end">${{ number_format($gestorGasto->monto, 2) }}</td>
                            <td>
                                <form method="POST" action="{{ route('gestorGastos.destroyGasto', $gestorGasto) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">
                                {{ $mes === 'todos' ? 'No hay gastos registrados.' : 'No hay gastos en este mes.' }}
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">{{ $mes === 'todos' ? 'Resumen de todos los meses' : 'Resumen del mes' }}</div>
                <ul class="list-group list-group-flush">
                    @foreach ($resumen as $categoria => $subtotal)
                        <li class="list-group-item d-flex justify-content-between">
                            {{ $categoria }}
                            <span>${{ number_format($subtotal, 2) }}</span>
                        </li>
                    @endforeach
                    <li class="list-group-item d-flex justify-content-between fw-bold">
                        Total <span>${{ number_format($total, 2) }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection
