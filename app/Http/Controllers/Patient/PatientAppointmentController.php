<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatientAppointmentController extends Controller
{
    public function create()
    {
        $schedules = Schedule::where('is_active', true)->get();
        return view('patient.appointments.create', compact('schedules'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'appointment_date' => 'required|date|after_or_equal:today',
            'start_time' => 'required',
            'consultation_type' => 'required|string',
        ]);

        $startTime = $request->start_time;
        $endTime = date('H:i:s', strtotime($startTime) + 3600); // Duración de 1 hora

        $conflict = Appointment::where('appointment_date', $request->appointment_date)
            ->where('start_time', $startTime)
            ->whereIn('status', ['pending', 'confirmed'])
            ->exists();

        if ($conflict) {
            return back()->with('error', 'Aviso: Ya existe una cita agendada en ese mismo día y horario. Por favor selecciona otro horario para agendar.');
        }

        Appointment::create([
            'patient_id' => Auth::id(),
            'appointment_date' => $request->appointment_date,
            'start_time' => $startTime,
            'end_time' => $endTime,
            'consultation_type' => $request->consultation_type,
            'status' => 'pending',
            'notes' => $request->notes,
        ]);

        return redirect()->route('patient.dashboard')->with('success', 'Cita agendada correctamente. En espera de confirmación.');
    }
}