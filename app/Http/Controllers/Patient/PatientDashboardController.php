<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\ClinicalRecord;
use Illuminate\Support\Facades\Auth;

class PatientDashboardController extends Controller
{
    public function index()
    {
        $patientId = Auth::id();
        $upcomingAppointments = Appointment::where('patient_id', $patientId)
            ->where('appointment_date', '>=', today())
            ->orderBy('appointment_date')
            ->get();

        $pastAppointments = Appointment::where('patient_id', $patientId)
            ->where('appointment_date', '<', today())
            ->orderBy('appointment_date', 'desc')
            ->get();

        $latestRecord = ClinicalRecord::where('patient_id', $patientId)->latest()->first();

        return view('patient.dashboard', compact('upcomingAppointments', 'pastAppointments', 'latestRecord'));
    }
}