@extends('layouts.app')

@section('content')
<div class="card">
    <h3>Configuración de Publicidad y Contenidos del Sitio Público</h3>

    @foreach($contents as $content)
    <div style="border: 1px solid var(--border-color); padding: 15px; border-radius: 8px; margin-top: 15px;">
        <form action="{{ route('admin.site.update', $content) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Título / Encabezado ({{ $content->key_name }})</label>
                <input type="text" name="title" class="form-control" value="{{ $content->title }}" required>
            </div>
            <div class="form-group">
                <label>Contenido</label>
                <textarea name="content" class="form-control" rows="4" required>{{ $content->content }}</textarea>
            </div>
            <button type="submit" class="btn btn-secondary">Actualizar Sección</button>
        </form>
    </div>
    @endforeach
</div>
@endsection