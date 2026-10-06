@extends('layouts.app')

@section('content')
<div class="card">
    <h3>Próximas Citas</h3>
    <div class="table-responsive" style="margin-top: 15px;">
        <table>
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Tipo</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @forelse($upcomingAppointments as $app)
                <tr>
                    <td>{{ $app->appointment_date->format('Y-m-d') }}</td>
                    <td>{{ $app->start_time }}</td>
                    <td>{{ $app->consultation_type }}</td>
                    <td><strong>{{ strtoupper($app->status) }}</strong></td>
                </tr>
                @empty
                <tr><td colspan="4" style="text-align: center;">No tienes citas próximas.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="card">
    <h3>Últimas Recomendaciones Clínicas</h3>
    @if($latestRecord)
        <p><strong>Fecha de Evaluación:</strong> {{ $latestRecord->created_at->format('Y-m-d') }}</p>
        <p><strong>IMC:</strong> {{ $latestRecord->bmi }}</p>
        <div style="margin-top: 10px; padding: 10px; background-color: var(--bg-primary); border-radius: 6px;">
            <p><strong>Indicaciones:</strong> {{ $latestRecord->recommendations }}</p>
        </div>
    @else
        <p style="color: var(--text-muted); margin-top: 10px;">Aún no cuentas con registros clínicos cargados por el nutriólogo.</p>
    @endif
</div>
@endsection