<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::where('user_id', Auth::id())->orderBy('day_of_week')->get();
        return view('admin.schedules.index', compact('schedules'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'day_of_week' => 'required|integer|between:0,6',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
        ]);

        Schedule::updateOrCreate(
            ['user_id' => Auth::id(), 'day_of_week' => $request->day_of_week],
            [
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
                'is_active' => $request->has('is_active'),
            ]
        );

        return back()->with('success', 'Horario de atención actualizado correctamente.');
    }
}