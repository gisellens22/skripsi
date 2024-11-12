<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\Subject;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    /**
     * Menampilkan daftar guru.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Fetch the search query
        $search = $request->input('search');

        // Fetch teachers with optional search functionality
        $teachers = Teacher::when($search, function ($query, $search) {
            return $query->where('teacher_name', 'like', "%{$search}%");
        })->get();

        return view('teachers.index', compact('teachers', 'search'));
    }

    public function teachersUsersIndex()
    {
    // Ambil user yang sedang login
    $user = Auth::user();

    // Ambil data Teacher berdasarkan user_id yang sedang login
    $teacher = Teacher::where('user_id', $user->id)->first();

    // Jika teacher ditemukan, tampilkan view dengan data teacher, jika tidak redirect dengan error
    if ($teacher) {
        return view('teachersusers.index', compact('teacher'));
    } else {
        return redirect()->back()->with('error', 'Data teacher tidak ditemukan.');
    }
    }



    public function teacherSchedules()
    {
    // Ambil user yang sedang login
    $user = Auth::user();

    // Ambil teacher berdasarkan user yang login
    $teacher = Teacher::where('user_id', $user->id)->first();

    // Pastikan teacher ditemukan, lalu ambil jadwalnya
    if ($teacher) {
        $schedules = $teacher->schedules; // Ambil jadwal yang terkait dengan teacher ini
        return view('teachersusers.schedule', compact('schedules'));
    } else {
        return redirect()->back()->with('error', 'Data jadwal tidak ditemukan untuk pengguna ini.');
    }
    }




    /**
     * Menampilkan form untuk menambah guru baru.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $users = User::all();  // Ambil semua user
        $subjects = Subject::all();  // Ambil semua subject
        return view('teachers.create', compact('users', 'subjects'));
    }

    /**
     * Menyimpan data guru baru.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'teacher_name' => 'required|string|max:255',
            'teacher_dob' => 'required|date',
            'teacher_phone' => 'required|string|max:20',
            'teacher_email' => 'required|email|max:255',
            'teacher_address' => 'required|string|max:255',
            'teacher_education' => 'required|string|max:255',
            'teacher_position' => 'required|string|max:255',
            'subject_id' => 'required|string|max:255',
            'user_id' => 'required|string|max:255',
        ]);
        
        try {
            $teacher = new Teacher();
            $teacher->teacher_name = $request->input('teacher_name');
            $teacher->teacher_dob = $request->input('teacher_dob');
            $teacher->teacher_phone = $request->input('teacher_phone');
            $teacher->teacher_email = $request->input('teacher_email');
            $teacher->teacher_address = $request->input('teacher_address');
            $teacher->teacher_education = $request->input('teacher_education');
            $teacher->teacher_position = $request->input('teacher_position');
            $teacher->subject_id = $request->input('subject_id');
            $teacher->user_id = $request->input('user_id');
            $teacher->save();

            Log::info('Teacher created successfully: ', ['teacher_id' => $teacher->teacher_id]);

            return redirect()->route('teachers.index')->with('success', 'Teacher created successfully.');
        } catch (\Exception $e) {
            Log::error('Error creating teacher: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to create teacher.');
        }
    }

    /**
     * Menampilkan form untuk mengedit data guru.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $teacher = Teacher::findOrFail($id);
        $users = User::all();
        $subjects = Subject::all();
        return view('teachers.edit', compact('teacher', 'users', 'subjects'));
    }

    /**
     * Mengupdate data guru.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
    $request->validate([
        'teacher_name' => 'required|string|max:255',
        'teacher_dob' => 'required|date',
        'teacher_phone' => 'required|string|max:20',
        'teacher_email' => 'required|email|max:255',
        'teacher_address' => 'required|string|max:255',
        'teacher_education' => 'required|string|max:255',
        'teacher_position' => 'required|string|max:255',
        'user_id' => 'required|exists:users,id', // Validasi user_id dari tabel users
        'subject_id' => 'required|exists:subjects,subject_id', // Validasi subject_id dari tabel subjects
    ]);

    try {
        $teacher = Teacher::findOrFail($id);
        $teacher->teacher_name = $request->input('teacher_name');
        $teacher->teacher_dob = $request->input('teacher_dob');
        $teacher->teacher_phone = $request->input('teacher_phone');
        $teacher->teacher_email = $request->input('teacher_email');
        $teacher->teacher_address = $request->input('teacher_address');
        $teacher->teacher_education = $request->input('teacher_education');
        $teacher->teacher_position = $request->input('teacher_position');
        $teacher->user_id = $request->input('user_id');  // Pilihan user_id dari dropdown
        $teacher->subject_id = $request->input('subject_id');  // Pilihan subject_id dari dropdown
        $teacher->save();

        Log::info('Teacher updated successfully: ', ['teacher_id' => $teacher->teacher_id]);

        return redirect()->route('teachers.index')->with('success', 'Teacher updated successfully.');
    } catch (\Exception $e) {
        Log::error('Error updating teacher: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Failed to update teacher.');
    }   
    }

    /**
     * Menghapus data guru.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        try {
            $teacher = Teacher::findOrFail($id);
            $teacher->delete();

            Log::info('Teacher deleted successfully: ', ['teacher_id' => $teacher->teacher_id]);

            return redirect()->route('teachers.index')->with('success', 'Teacher deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Error deleting teacher: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to delete teacher.');
        }
    }
    public function updateUserIds()
    {
        $teachers = Teacher::all();

        foreach ($teachers as $teacher) {
            $user = User::where('username', $teacher->username)->first();
            if ($user) {
                $teacher->user_id = $user->id;
                $teacher->save();
            }
        }

        return "User IDs for teachers have been updated.";
    }


    public function updateSubjectIds()
    {
        $teachers = Teacher::all();

        foreach ($teachers as $teacher) {
            $subject = Subject::where('subject_id', $teacher->subject_id)->first();
            if ($subject) {
                $teacher->subject_id = $subject->subject_id;
                $teacher->save();
            }
        }

        return "User IDs for teachers have been updated.";
    }
}
