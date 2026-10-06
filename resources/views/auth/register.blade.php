@extends('layouts.app')

@section('content')
<div style="display: flex; min-height: 100vh; align-items: center; justify-content: center; padding: 20px;">
    <div class="card" style="width: 100%; max-width: 450px;">
        <h2 style="text-align: center; margin-bottom: 20px;">REGISTRO DE PACIENTE</h2>
        
        @if($errors->any())
            <div class="alert alert-error">
                <ul style="margin-left: 20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Nombre Completo</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
            </div>
            <div class="form-group">
                <label>Correo Electrónico</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
            </div>
            <div class="form-group">
                <label>Teléfono</label>
                <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" required>
            </div>
            <div class="form-group">
                <label>Contraseña</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Confirmar Contraseña</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary" style="width: 100%; justify-content: center;">Crear Cuenta</button>
        </form>
        <p style="text-align: center; margin-top: 15px; font-size: 0.9rem;">
            ¿Ya tienes cuenta? <a href="{{ route('login') }}" style="color: var(--blue-bell);">INICIA SESIÓN</a>
        </p>
    </div>
</div>
@endsection