<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::with('patient')->orderBy('appointment_date', 'desc')->get();
        return view('admin.appointments.index', compact('appointments'));
    }

    public function updateStatus(Request $request, Appointment $appointment)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled,completed',
        ]);

        if ($request->status === 'confirmed') {
            $conflict = Appointment::where('appointment_date', $appointment->appointment_date)
                ->where('start_time', $appointment->start_time)
                ->where('id', '!=', $appointment->id)
                ->where('status', 'confirmed')
                ->exists();

            if ($conflict) {
                return back()->with('error', 'Aviso: Ya existe una cita confirmada el mismo día y en el mismo horario. Solicite reagendar al paciente.');
            }
        }

        $appointment->update(['status' => $request->status]);

        return back()->with('success', 'Estado de la cita actualizado con éxito y notificación de correo enviada.');
    }
}