<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClinicalRecord;
use App\Models\User;
use Illuminate\Http\Request;

class ClinicalRecordController extends Controller
{
    public function index()
    {
        $records = ClinicalRecord::with('patient')->latest()->get();
        return view('admin.clinical_records.index', compact('records'));
    }

    public function create(User $patient = null)
    {
        $patients = User::where('role', 'patient')->get();
        return view('admin.clinical_records.create', compact('patients', 'patient'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:users,id',
            'weight_kg' => 'required|numeric|min:1',
            'height_cm' => 'required|numeric|min:1',
            'bmi' => 'required|numeric',
            'medical_history' => 'nullable|string',
            'eating_habits' => 'nullable|string',
            'recommendations' => 'nullable|string',
        ]);

        $validated['nutritionist_id'] = auth()->id();

        ClinicalRecord::create($validated);

        return redirect()->route('admin.records.index')
            ->with('success', 'Expediente clínico registrado con éxito.');
    }
}