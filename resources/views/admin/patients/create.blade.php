@extends('layouts.app')

@section('content')
<div class="card" style="max-width: 600px;">
    <h3>Dar de Alta Nuevo Paciente</h3>
    <form action="{{ route('admin.patients.store') }}" method="POST" style="margin-top: 15px;">
        @csrf
        <div class="form-group">
            <label>Nombre Completo</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Correo Electrónico</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Teléfono</label>
            <input type="text" name="phone" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Fecha de Nacimiento</label>
            <input type="date" name="birth_date" class="form-control">
        </div>
        <div class="form-group">
            <label>Género</label>
            <select name="gender" class="form-control">
                <option value="masculino">Masculino</option>
                <option value="femenino">Femenino</option>
                <option value="otro">Otro</option>
            </select>
        </div>
        <div class="form-group">
            <label>Contraseña Temporal</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar Paciente</button>
    </form>
</div>
@endsection