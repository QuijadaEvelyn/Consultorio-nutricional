@extends('layouts.app')

@section('content')
<div class="card">
    <h3>Expedientes Clínicos Digitales</h3>
    <div class="table-responsive" style="margin-top: 15px;">
        <table>
            <thead>
                <tr>
                    <th>Fecha Registro</th>
                    <th>Paciente</th>
                    <th>Peso (kg)</th>
                    <th>Talla (cm)</th>
                    <th>IMC</th>
                    <th>Recomendaciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($records as $rec)
                <tr>
                    <td>{{ $rec->created_at->format('Y-m-d H:i') }}</td>
                    <td>{{ $rec->patient->name }}</td>
                    <td>{{ $rec->weight_kg }}</td>
                    <td>{{ $rec->height_cm }}</td>
                    <td><strong>{{ $rec->bmi }}</strong></td>
                    <td>{{ Str::limit($rec->recommendations, 50) }}</td>
                </tr>
                @empty
                <tr><td colspan="6" style="text-align: center;">No hay expedientes médicos.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection