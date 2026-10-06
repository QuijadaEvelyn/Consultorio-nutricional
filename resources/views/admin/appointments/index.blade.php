@extends('layouts.app')

@section('content')
<div class="card">
    <h3>Gestión de Citas</h3>
    <div class="table-responsive" style="margin-top: 15px;">
        <table>
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Paciente</th>
                    <th>Contacto</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($appointments as $app)
                <tr>
                    <td>{{ $app->appointment_date->format('Y-m-d') }}</td>
                    <td>{{ $app->start_time }}</td>
                    <td>{{ $app->patient->name }}</td>
                    <td>{{ $app->patient->phone }}</td>
                    <td><strong>{{ strtoupper($app->status) }}</strong></td>
                    <td>
                        <form action="{{ route('admin.appointments.updateStatus', $app) }}" method="POST" style="display: flex; gap: 5px;">
                            @csrf
                            @method('PATCH')
                            <select name="status" class="form-control" style="width: auto;">
                                <option value="pending" {{ $app->status == 'pending' ? 'selected' : '' }}>Pendiente</option>
                                <option value="confirmed" {{ $app->status == 'confirmed' ? 'selected' : '' }}>Confirmar</option>
                                <option value="cancelled" {{ $app->status == 'cancelled' ? 'selected' : '' }}>Cancelar</option>
                                <option value="completed" {{ $app->status == 'completed' ? 'selected' : '' }}>Completada</option>
                            </select>
                            <button type="submit" class="btn btn-secondary">Actualizar</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" style="text-align: center;">No hay citas registradas.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection