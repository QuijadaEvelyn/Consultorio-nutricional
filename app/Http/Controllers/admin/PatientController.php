<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PatientController extends Controller
{
    public function index()
    {
        $patients = User::where('role', 'patient')->orderBy('name')->get();
        return view('admin.patients.index', compact('patients'));
    }

    public function create()
    {
        return view('admin.patients.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'phone' => 'required|string|max:20',
            'birth_date' => 'nullable|date',
            'gender' => 'nullable|in:masculino,femenino,otro',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'birth_date' => $request->birth_date,
            'gender' => $request->gender,
            'password' => Hash::make($request->password),
            'role' => 'patient',
            'is_active' => true,
        ]);

        return redirect()->route('admin.patients.index')->with('success', 'Paciente registrado correctamente.');
    }

    public function toggleActive(User $patient)
    {
        $patient->update(['is_active' => !$patient->is_active]);
        return back()->with('success', 'Estado del paciente modificado.');
    }
}