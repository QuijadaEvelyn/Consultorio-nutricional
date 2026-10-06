@extends('layouts.app')

@section('content')
<div class="card" style="display: flex; justify-content: space-between; align-items: center;">
    <h3>Listado de Pacientes</h3>
    <a href="{{ route('admin.patients.create') }}" class="btn btn-primary">Nuevo Paciente</a>
</div>

<div class="card">
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>Estatus</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($patients as $patient)
                <tr>
                    <td>{{ $patient->name }}</td>
                    <td>{{ $patient->email }}</td>
                    <td>{{ $patient->phone }}</td>
                    <td>{{ $patient->is_active ? 'Activo' : 'Inactivo' }}</td>
                    <td style="display: flex; gap: 10px;">
                        <a href="{{ route('admin.records.create', $patient) }}" class="btn btn-secondary">Crear Expediente</a>
                        <form action="{{ route('admin.patients.toggleActive', $patient) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-danger">{{ $patient->is_active ? 'Desactivar' : 'Activar' }}</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" style="text-align: center;">No hay pacientes registrados.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection