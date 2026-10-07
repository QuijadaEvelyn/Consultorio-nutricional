@extends('layouts.app')

@section('content')
<div class="card">
    <h2>Nuevo Expediente Clínico</h2>
    <hr style="margin: 15px 0; border: none; border-top: 1px solid var(--border-color);">

    {{-- Mostrar errores globales si la validación falla --}}
    @if ($errors->any())
        <div style="color: red; margin-bottom: 15px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.records.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="patient_id">Seleccionar Paciente:</label>
            <select name="patient_id" id="patient_id" class="form-control" required>
                <option value="">-- Seleccione un paciente --</option>
                @foreach($patients as $item)
                    <option value="{{ $item->id }}" {{ (old('patient_id', $patient->id ?? '') == $item->id) ? 'selected' : '' }}>
                        {{ $item->name }} ({{ $item->email }})
                    </option>
                @endforeach
            </select>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 15px;">
            <div class="form-group">
                <label for="weight_kg">Peso (kg):</label>
                <input type="number" step="0.1" name="weight_kg" id="weight_kg" class="form-control" placeholder="Ej. 70.5" value="{{ old('weight_kg') }}" required>
            </div>

            <div class="form-group">
                <label for="height_cm">Estatura (cm):</label>
                <input type="number" step="0.1" name="height_cm" id="height_cm" class="form-control" placeholder="Ej. 170" value="{{ old('height_cm') }}" required>
            </div>

            <div class="form-group">
                <label for="bmi">IMC (Autocalculado):</label>
                <input type="number" step="0.01" name="bmi" id="bmi" class="form-control" value="{{ old('bmi') }}" readonly required>
            </div>
        </div>

        <div class="form-group">
            <label for="medical_history">Historial Médico / Antecedentes:</label>
            <textarea name="medical_history" id="medical_history" rows="3" class="form-control" placeholder="Alergias, enfermedades previas, etc.">{{ old('medical_history') }}</textarea>
        </div>

        <div class="form-group">
            <label for="eating_habits">Hábitos Alimenticios:</label>
            <textarea name="eating_habits" id="eating_habits" rows="3" class="form-control" placeholder="Comidas al día, consumo de agua, gustos/disgustos.">{{ old('eating_habits') }}</textarea>
        </div>

        <div class="form-group">
            <label for="recommendations">Plan / Recomendaciones Nutricionales:</label>
            <textarea name="recommendations" id="recommendations" rows="4" class="form-control" placeholder="Indicaciones de la dieta, suplementos, etc.">{{ old('recommendations') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Guardar Expediente</button>
        <a href="{{ route('admin.records.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

{{-- Script para calcular el IMC automáticamente --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const weightInput = document.getElementById('weight_kg');
        const heightInput = document.getElementById('height_cm');
        const bmiInput = document.getElementById('bmi');

        function calculateBMI() {
            const weight = parseFloat(weightInput.value);
            const heightCm = parseFloat(heightInput.value);

            if (weight > 0 && heightCm > 0) {
                const heightM = heightCm / 100;
                const bmi = (weight / (heightM * heightM)).toFixed(2);
                bmiInput.value = bmi;
            } else {
                bmiInput.value = '';
            }
        }

        weightInput.addEventListener('input', calculateBMI);
        heightInput.addEventListener('input', calculateBMI);
    });
</script>
@endsection