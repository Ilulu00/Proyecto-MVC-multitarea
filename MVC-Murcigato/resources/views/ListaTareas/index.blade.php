@extends('layouts.app')
@section('content')
    <h1 class="text-center mb-4">Lista de Tareas</h1>

    <form method="POST" action="{{ route('listaTareas.storeTarea') }}" class="mb-4">
        @csrf
        <div class="input-group">
            <input type="text" name="titulo" class="form-control" placeholder="Nueva tarea" required>
            <button type="submit" class="btn btn-primary">Agregar</button>
        </div>
    </form>

    <ul>
        @foreach ($listaTareas as $listaTarea)
            <li class="d-flex justify-content-between align-items-center mb-2">
                <span class="{{ $listaTarea->completada ? 'text-decoration-line-through' : '' }}">
                    {{ $listaTarea->titulo }}
                </span>
                <div>
                    <form method="POST" action="{{ route('listaTareas.completar', $listaTarea->id) }}" class="d-inline">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-sm btn-secondary">
                            {{ $listaTarea->completada ? 'Marcar como pendiente' : 'Marcar como completada' }}
                        </button>
                    </form>
                    <form method="POST" action="{{ route('listaTareas.destroyTarea', $listaTarea->id) }}" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                    </form>
                </div>
            </li>
        @endforeach
    @endsection
