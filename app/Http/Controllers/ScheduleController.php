<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Teacher;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class ScheduleController extends Controller
{
    public function index(Request $request)
    {
        Log::info('Schedule Data:', $request->all());

        // Prepare the query to fetch schedules
        $query = Schedule::with(['student', 'teacher']);

        // Check if there's a search query and apply it
        if ($request->has('search')) {
            $query->whereHas('student', function ($q) use ($request) {
                $q->where('student_name', 'LIKE', '%' . $request->search . '%');
            });
        }

        // Execute the query and get the results
        $schedules = $query->get();
        return view('schedules.index', compact('schedules'));
    }


    public function create()
    {
        $teachers = Teacher::all(); // Ambil semua guru
        $students = Student::all(); // Ambil semua siswa
        return view('schedules.create', compact('teachers', 'students'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'schedule_day' => 'required',
            'schedule_time' => 'required',
            'teacher_id' => 'required',
            'student_id' => 'required',
        ]);

        Schedule::create($request->all());
        return redirect()->route('schedules.index')->with('success', 'Schedule created successfully.');
    }

    public function edit($schedule_id)
{
    $schedule = Schedule::findOrFail($schedule_id);
    $teachers = Teacher::all();
    $students = Student::all();
    return view('schedules.edit', compact('schedule', 'teachers', 'students'));
}

public function update(Request $request, $schedule_id)
{
    $request->validate([
        'schedule_day' => 'required',
        'schedule_time' => 'required',
        'teacher_id' => 'required',
        'student_id' => 'required',
    ]);

    $schedule = Schedule::findOrFail($schedule_id);
    $schedule->update($request->all());
    return redirect()->route('schedules.index')->with('success', 'Schedule updated successfully.');
}

public function destroy($schedule_id)
{
    $schedule = Schedule::findOrFail($schedule_id);
    $schedule->delete();
    return redirect()->route('schedules.index')->with('success', 'Schedule deleted successfully.');
}
}