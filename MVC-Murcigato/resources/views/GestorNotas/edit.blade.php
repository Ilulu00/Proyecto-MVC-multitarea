@extends('layouts.app')
@section('content')
    <h1 class="mb-4">Editar nota</h1>

    <form method="POST" action="{{ route('gestorNotas.updateNota', $nota) }}">
        @csrf
        @method('PUT')
        @include('GestorNotas._form')
    </form>
@endsection
