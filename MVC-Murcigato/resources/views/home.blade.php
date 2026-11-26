@extends('layouts.app')
@section('content')
    <h1 class="text-center mb-2 titulo-inicio">Proyecto MVC con Laravel</h1>
    <p class="text-center text-muted mb-5">Elige un módulo para empezar</p>

    <div class="row">
        @foreach ([['listaTareas.index', 'Lista de Tareas', 'Agrega, elimina y marca tareas como completadas.'], ['propinas.index', 'Calculadora de Propinas', 'Calcula la propina según el total de la cuenta.'], ['passwords.index', 'Generador de Contraseñas', 'Crea contraseñas seguras y ajustables.'], ['gestorGastos.index', 'Gestor de Gastos', 'Registra tus gastos y mira el resumen mensual.'], ['reservas.index', 'Sistema de Reservas', 'Reserva citas viendo la disponibilidad.'], ['gestorNotas.index', 'Gestor de Notas', 'Escribe, organiza y busca tus notas.'], ['cronometro.index', 'Cronometro', 'Una forma de medir tu tiempo.']] as [$ruta, $titulo, $descripcion])
            <div class="col-md-4 mb-4">
                <div class="card h-100 text-center">
                    <div class="card-body">
                        <h5 class="card-title">{{ $titulo }}</h5>
                        <p class="card-text">{{ $descripcion }}</p>
                    </div>
                    <div class="card-footer bg-transparent border-0 pb-3">
                        <a href="{{ route($ruta) }}" class="btn btn-primary">Abrir</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
