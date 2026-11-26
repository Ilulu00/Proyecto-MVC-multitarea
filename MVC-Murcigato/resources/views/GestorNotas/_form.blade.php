<div class="mb-3">
    <label class="form-label">Título</label>
    <input type="text" name="titulo" class="form-control" value="{{ old('titulo', $nota->titulo ?? '') }}" required>
</div>

<div class="mb-3">
    <label class="form-label">Categoría</label>
    <input type="text" name="categoria" class="form-control" list="lista-categorias"
        value="{{ old('categoria', $nota->categoria ?? 'General') }}" required>
    <datalist id="lista-categorias">
        @foreach ($categorias ?? [] as $c)
            <option value="{{ $c }}">
        @endforeach
    </datalist>
</div>

<div class="mb-3">
    <label class="form-label">Contenido</label>
    <textarea name="contenido" rows="6" class="form-control" required>{{ old('contenido', $nota->contenido ?? '') }}</textarea>
</div>

<button type="submit" class="btn btn-success">Guardar</button>
<a href="{{ route('gestorNotas.index') }}" class="btn btn-link">Cancelar</a>
