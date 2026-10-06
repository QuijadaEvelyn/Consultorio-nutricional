<!DOCTYPE html>
<html lang="es">
<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultorio Nutricional Digital</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&family=Roboto+Slab:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    @auth
    <div class="app-container">
        <aside class="sidebar">
            <div class="sidebar-header">
                <svg class="svg-icon" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                <span>NutriControl</span>
            </div>
            <ul class="sidebar-menu">
                @if(Auth::user()->isAdmin())
                    <li><a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">Dashboard</a></li>
                    <li><a href="{{ route('admin.schedules.index') }}" class="{{ request()->routeIs('admin.schedules*') ? 'active' : '' }}">Horarios</a></li>
                    <li><a href="{{ route('admin.appointments.index') }}" class="{{ request()->routeIs('admin.appointments*') ? 'active' : '' }}">Citas</a></li>
                    <li><a href="{{ route('admin.patients.index') }}" class="{{ request()->routeIs('admin.patients*') ? 'active' : '' }}">Pacientes</a></li>
                    <li><a href="{{ route('admin.records.index') }}" class="{{ request()->routeIs('admin.records*') ? 'active' : '' }}">Expedientes</a></li>
                    <li><a href="{{ route('admin.site.index') }}" class="{{ request()->routeIs('admin.site*') ? 'active' : '' }}">Sitio Web</a></li>
                @else
                    <li><a href="{{ route('patient.dashboard') }}" class="{{ request()->routeIs('patient.dashboard') ? 'active' : '' }}">Mi Dashboard</a></li>
                    <li><a href="{{ route('patient.appointments.create') }}" class="{{ request()->routeIs('patient.appointments*') ? 'active' : '' }}">Agendar Cita</a></li>
                @endif
            </ul>
            <form action="{{ route('logout') }}" method="POST" style="margin-top: auto;">
                @csrf
                <button type="submit" class="btn btn-danger" style="width: 100%;">Cerrar Sesión</button>
            </form>
        </aside>
        <main class="main-content">
            <div class="top-bar">
                <h2>Hola, {{ Auth::user()->name }}</h2>
                <button id="theme-toggle" class="btn btn-secondary">Modo Oscuro/Claro</button>
            </div>
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-error">{{ session('error') }}</div>
            @endif
            @yield('content')
        </main>
    </div>
    @else
    <main>
        @yield('content')
    </main>
    @endauth
    
</body>
</html>