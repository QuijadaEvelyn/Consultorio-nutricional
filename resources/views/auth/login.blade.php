@extends('layouts.app')

@section('content')
<div style="display: flex; min-height: 100vh; align-items: center; justify-content: center; padding: 20px;">
    <div class="card" style="width: 100%; max-width: 400px;">
        <h2 style="text-align: center; margin-bottom: 20px;">INICIO DE SESIÓN</h2>
        
        @if($errors->any())
            <div class="alert alert-error">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Correo Electrónico</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
            </div>
            <div class="form-group">
                <label>Contraseña</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary" style="width: 100%; justify-content: center;">Ingresar</button>
        </form>
        <p style="text-align: center; margin-top: 15px; font-size: 0.9rem;">
            ¿No tienes cuenta? <a href="{{ route('register') }}" style="color: var(--blue-bell);">REGÍSTRATE AQUÍ</a>
        </p>
    </div>
</div>
@endsection