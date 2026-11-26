@extends('layouts.app')
@section('content')
    <h1 class="text-center mb-4">Gestor de Notas</h1>

    <div class="d-flex justify-content-between mb-3">
        <a href="{{ route('gestorNotas.createNota') }}" class="btn btn-primary">Nueva nota</a>

        {{-- Buscador + filtro por categoría --}}
        <form method="GET" action="{{ route('gestorNotas.index') }}" class="d-flex gap-2">
            <input type="text" name="q" class="form-control" placeholder="Buscar..." value="{{ request('q') }}">
            <select name="categoria" class="form-select">
                <option value="">Todas</option>
                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria }}" @selected(request('categoria') === $categoria)>{{ $categoria }}</option>
                @endforeach
            </select>
            <button class="btn btn-outline-secondary">Buscar</button>
            @if (request()->hasAny(['q', 'categoria']))
                <a href="{{ route('gestorNotas.index') }}" class="btn btn-link">Limpiar</a>
            @endif
        </form>
    </div>

    <div class="row">
        @forelse ($notas as $nota)
            <div class="col-md-4 mb-3">
                <div class="card h-100">
                    <div class="card-body">
                        <span class="badge bg-secondary mb-2">{{ $nota->categoria }}</span>
                        <h5 class="card-title">{{ $nota->titulo }}</h5>
                        <p class="card-text">{{ Str::limit($nota->contenido, 120) }}</p>
                    </div>
                    <div class="card-footer d-flex justify-content-between align-items-center">
                        <small class="text-muted">{{ $nota->updated_at->diffForHumans() }}</small>
                        <div class="d-flex gap-1">
                            <a href="{{ route('gestorNotas.editNota', $nota) }}" class="btn btn-sm btn-warning">Editar</a>
                            <form method="POST" action="{{ route('gestorNotas.destroyNota', $nota) }}"
                                onsubmit="return confirm('¿Eliminar esta nota?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Eliminar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">No se encontraron notas.</div>
            </div>
        @endforelse
    </div>
@endsection
