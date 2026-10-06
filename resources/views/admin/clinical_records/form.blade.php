@extends('layouts.app')

@section('content')
<div class="card" style="max-width: 700px;">
    <h3>Formulario Clínico / Expediente Digital - {{ $patient->name }}</h3>
    <form action="{{ route('admin.records.store', $patient) }}" method="POST" style="margin-top: 20px;">
        @csrf
        <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 15px;">
            <div class="form-group">
                <label>Peso (kg)</label>
                <input type="number" step="0.1" name="weight_kg" id="weight_kg" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Talla (cm)</label>
                <input type="number" step="0.1" name="height_cm" id="height_cm" class="form-control" required>
            </div>
            <div class="form-group">
                <label>IMC (Calculado)</label>
                <input type="text" name="bmi" id="bmi" class="form-control" readonly>
            </div>
        </div>

        <div class="form-group">
            <label>Antecedentes Médicos</label>
            <textarea name="medical_history" class="form-control" rows="3"></textarea>
        </div>

        <div class="form-group">
            <label>Hábitos Alimenticios</label>
            <textarea name="eating_habits" class="form-control" rows="3"></textarea>
        </div>

        <div class="form-group">
            <label>Recomendaciones / Indicaciones Clínicas</label>
            <textarea name="recommendations" class="form-control" rows="3"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Guardar Expediente Clínico</button>
    </form>
</div>
@endsection