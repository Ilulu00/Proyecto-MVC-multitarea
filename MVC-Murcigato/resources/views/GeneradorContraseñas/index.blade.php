@extends('layouts.app')
@section('content')
    <h1 class="text-center mb-4">Generador de contraseñas</h1>
    <p class="text-center text-muted mb-4">Elige la longitud y los tipos de caracteres que quieres incluir.</p>

    <form method="POST" action="{{ route('passwords.generar') }}" class="card">
        @csrf
        <div class="card-body">
            <div class="mb-4">
                <label for="longitud" class="form-label">Longitud</label>
                <input type="number" id="longitud" name="longitud" class="form-control"
                    value="{{ old('longitud', $longitud) }}" min="6" max="29" required>
                <div class="form-text">Elige un valor entre 6 y 29 caracteres.</div>
            </div>

            <fieldset class="mb-4">
                <legend class="fs-6">Tipos de caracteres</legend>
                <div class="form-check">
                    <input type="hidden" name="minusculas" value="0">
                    <input type="checkbox" id="minusculas" name="minusculas" value="1" class="form-check-input"
                        @checked(old('minusculas', $opciones['minusculas']))>
                    <label for="minusculas" class="form-check-label">Letras minúsculas (a-z)</label>
                </div>
                <div class="form-check">
                    <input type="hidden" name="mayusculas" value="0">
                    <input type="checkbox" id="mayusculas" name="mayusculas" value="1" class="form-check-input"
                        @checked(old('mayusculas', $opciones['mayusculas']))>
                    <label for="mayusculas" class="form-check-label">Letras mayúsculas (A-Z)</label>
                </div>
                <div class="form-check">
                    <input type="hidden" name="numeros" value="0">
                    <input type="checkbox" id="numeros" name="numeros" value="1" class="form-check-input"
                        @checked(old('numeros', $opciones['numeros']))>
                    <label for="numeros" class="form-check-label">Números (0-9)</label>
                </div>
                <div class="form-check">
                    <input type="hidden" name="especiales" value="0">
                    <input type="checkbox" id="especiales" name="especiales" value="1" class="form-check-input"
                        @checked(old('especiales', $opciones['especiales']))>
                    <label for="especiales" class="form-check-label">Caracteres especiales</label>
                </div>
            </fieldset>

            <button type="submit" class="btn btn-primary">
                <i class="bi bi-shield-lock me-1" aria-hidden="true"></i>Generar contraseña
            </button>
        </div>
    </form>

    @isset($password)
        <section class="card mt-4" aria-labelledby="passwordResultHeading">
            <div class="card-header" id="passwordResultHeading">Tu contraseña</div>
            <div class="card-body">
                <p class="mb-0 font-monospace fs-5 user-select-all" aria-label="Contraseña generada">{{ $password }}</p>
                <div class="form-text mt-2">Guárdala en un lugar seguro :D!; no se almacenará en la aplicación.</div>
            </div>
        </section>
    @endisset
@endsection
