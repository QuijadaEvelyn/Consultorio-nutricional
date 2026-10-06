<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPatients = User::where('role', 'patient')->count();
        $pendingAppointments = Appointment::where('status', 'pending')->count();
        $todayAppointments = Appointment::whereDate('appointment_date', today())
            ->with('patient')
            ->orderBy('start_time')
            ->get();

        return view('admin.dashboard', compact('totalPatients', 'pendingAppointments', 'todayAppointments'));
    }
}