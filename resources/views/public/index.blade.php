@extends('layouts.app')

@section('content')
<nav style="display: flex; justify-content: space-between; align-items: center; padding: 20px 40px; background-color: var(--card-bg); border-bottom: 1px solid var(--border-color);">
    <h1 style="color: var(--baltic-blue);">NutriClínica</h1>
    <div>
        <a href="{{ route('login') }}" class="btn btn-secondary">Iniciar Sesión</a>
        <a href="{{ route('register') }}" class="btn btn-primary">Registrarse</a>
    </div>
</nav>

<div style="max-width: 1000px; margin: 40px auto; padding: 0 20px;">
    <!-- Sección Perfil y Foto -->
    <div class="card" style="display: flex; gap: 30px; align-items: center; flex-wrap: wrap;">
        <div style="width: 160px; height: 160px; border-radius: 50%; background: var(--border-color); display: flex; align-items: center; justify-content: center; font-weight: bold; color: var(--text-muted);">
            FOTO DEL NUTRIÓLOGO
        </div>
        <div style="flex: 1;">
            <h2>{{ $contents['doctor_title']->title ?? 'Nutrióloga Varinia Santiago' }}</h2>
            <p style="color: var(--blue-bell); font-weight: 600; margin-bottom: 10px;">Consulta Nutricional Clínica</p>
            <p>{{ $contents['doctor_title']->content ?? 'Licenciada en Nutrición con cédula profesional, especializada en consulta nutricional clínica para el tratamiento y seguimiento de condiciones metabólicas.' }}</p>
        </div>
    </div>

    <!-- Nuestros Servicios -->
    <div class="card">
        <h3>{{ $contents['services']->title ?? 'Nuestros Servicios' }}</h3>
        <p style="margin-top: 10px; white-space: pre-line;">{{ $contents['services']->content ?? "- Control de Peso\n- Evaluación Antropométrica\n- Asesoría Alimentaria Personalizada" }}</p>
    </div>

    <!-- Mi Consulta Incluye -->
    <div class="card">
        <h3>{{ $contents['includes']->title ?? 'Mi Consulta Incluye' }}</h3>
        <p style="margin-top: 10px; white-space: pre-line;">{{ $contents['includes']->content ?? "- Historia clínica detallada\n- Diagnóstico nutricional\n- Plan alimenticio personalizado y notas digitales" }}</p>
    </div>

    <div style="text-align: center; margin-top: 30px;">
        <a href="{{ route('register') }}" class="btn btn-primary" style="padding: 15px 30px; font-size: 1.1rem;">¡Agenda tu Cita Ahora!</a>
    </div>
</div>
@endsection