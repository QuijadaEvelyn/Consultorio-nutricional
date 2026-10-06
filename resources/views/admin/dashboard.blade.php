@extends('layouts.app')

@section('content')
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 30px;">
    <div class="card">
        <h4>Total Pacientes</h4>
        <p style="font-size: 2rem; font-weight: bold; color: var(--blue-bell);">{{ $totalPatients }}</p>
    </div>
    <div class="card">
        <h4>Citas Pendientes</h4>
        <p style="font-size: 2rem; font-weight: bold; color: var(--baltic-blue);">{{ $pendingAppointments }}</p>
    </div>
</div>

<div class="card">
    <h3>Citas de Hoy</h3>
    <div class="table-responsive" style="margin-top: 15px;">
        <table>
            <thead>
                <tr>
                    <th>Paciente</th>
                    <th>Horario</th>
                    <th>Tipo</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @forelse($todayAppointments as $app)
                <tr>
                    <td>{{ $app->patient->name }}</td>
                    <td>{{ $app->start_time }}</td>
                    <td>{{ $app->consultation_type }}</td>
                    <td><strong>{{ strtoupper($app->status) }}</strong></td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" style="text-align: center;">No hay citas programadas para hoy.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection