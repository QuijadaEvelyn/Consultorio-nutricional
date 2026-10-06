@extends('layouts.app')

@section('content')
<div class="card">
    <h3>Gestión de Horarios de Atención</h3>
    <p style="color: var(--text-muted); margin-bottom: 20px;">Establece tus horas de disponibilidad para agendamiento automático.</p>

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>Día</th>
                    <th>Hora Inicio</th>
                    <th>Hora Fin</th>
                    <th>Estado</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                @php $days = ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado']; @endphp
                @for($i = 0; $i < 7; $i++)
                @php $sch = $schedules->firstWhere('day_of_week', $i); @endphp
                <tr>
                    <form action="{{ route('admin.schedules.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="day_of_week" value="{{ $i }}">
                        <td><strong>{{ $days[$i] }}</strong></td>
                        <td><input type="time" name="start_time" class="form-control" value="{{ $sch->start_time ?? '09:00' }}" required></td>
                        <td><input type="time" name="end_time" class="form-control" value="{{ $sch->end_time ?? '17:00' }}" required></td>
                        <td>
                            <label><input type="checkbox" name="is_active" value="1" {{ ($sch->is_active ?? true) ? 'checked' : '' }}> Activo</label>
                        </td>
                        <td><button type="submit" class="btn btn-primary">Guardar</button></td>
                    </form>
                </tr>
                @endfor
            </tbody>
        </table>
    </div>
</div>
@endsection