@extends('layouts.app')
@section('content')
    <h1 class="mb-4">Nueva nota</h1>

    <form method="POST" action="{{ route('gestorNotas.storeNota') }}">
        @csrf
        @include('gestorNotas._form')
    </form>
@endsection
