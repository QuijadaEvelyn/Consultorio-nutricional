@extends('layouts.app')

@section('content')
<div class="card" style="max-width: 500px;">
    <h3>Agendar Cita Médica</h3>
    <form action="{{ route('patient.appointments.store') }}" method="POST" style="margin-top: 20px;">
        @csrf
        <div class="form-group">
            <label>Fecha deseada</label>
            <input type="date" name="appointment_date" class="form-control" min="{{ date('Y-m-d') }}" required>
        </div>

        <div class="form-group">
            <label>Horario Disponible</label>
            <select name="start_time" class="form-control" required>
                <option value="09:00:00">09:00 AM</option>
                <option value="10:00:00">10:00 AM</option>
                <option value="11:00:00">11:00 AM</option>
                <option value="12:00:00">12:00 PM</option>
                <option value="16:00:00">04:00 PM</option>
                <option value="17:00:00">05:00 PM</option>
            </select>
        </div>

        <div class="form-group">
            <label>Tipo de Consulta</label>
            <input type="text" name="consultation_type" class="form-control" value="Consulta Nutricional Clínica" required>
        </div>

        <div class="form-group">
            <label>Notas adicionales</label>
            <textarea name="notes" class="form-control" rows="2"></textarea>
        </div>

        <button type="submit" class="btn btn-primary" style="width: 100%; justify-content: center;">Confirmar Solicitud de Cita</button>
    </form>
</div>
@endsection