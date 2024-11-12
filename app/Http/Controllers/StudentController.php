<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use App\Models\School;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;


class StudentController extends Controller
{
    /**
     * Menampilkan daftar siswa.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Fetch the search query
        $search = $request->input('search');

        // Fetch students with optional search functionality
        $students = Student::when($search, function ($query, $search) {
            return $query->where('student_name', 'like', "%{$search}%");
        })->get();

        return view('students.index', compact('students', 'search'));
    }

    public function studentsUsersIndex()
    {
    // Ambil user yang sedang login
    $user = Auth::user();

    // Ambil data Student berdasarkan user_id yang sedang login
    $student = Student::where('user_id', $user->id)->first();

    if ($student) {
        return view('studentsusers.index', compact('student'));
    } else {
        return redirect()->route('students.index')->with('error', 'Data Student tidak ditemukan.');
    }
    }

    public function search(Request $request)
    {
    $searchTerm = $request->input('search');
    $students = Student::where('student_name', 'LIKE', '%' . $searchTerm . '%')->get();

    return view('student-list', compact('students'));
    }

    public function show($student)
    {
        $student = Student::findOrFail($student);
        return view('students.show', compact('student'));
    }

    public function studentSchedules()
    {
        // Ambil user yang sedang login
        $user = Auth::user();

        // Ambil student berdasarkan user yang login
        $student = Student::where('user_id', $user->id)->first();

        // Pastikan student ditemukan, lalu ambil jadwalnya
        if ($student) {
            $schedules = $student->schedules; // Ambil jadwal yang terkait dengan student ini
            return view('studentsusers.schedule', compact('schedules'));
        } else {
            return redirect()->route('students.index')->with('error', 'Data jadwal tidak ditemukan untuk pengguna ini.');
        }
    }
    public function studentBills()
    {
        // Ambil user yang sedang login
        $user = Auth::user();

        // Ambil student berdasarkan user yang login
        $student = Student::where('user_id', $user->id)->first();

        // Pastikan student ditemukan, lalu ambil tagihan terkait
        if ($student) {
            $bills = $student->bills; // Ambil tagihan yang terkait dengan student ini
            return view('studentsusers.bill', compact('bills'));
        } else {
            return redirect()->back()->with('error', 'Data tagihan tidak ditemukan untuk pengguna ini.');
        }
    }



    /**
     * Menampilkan form untuk menambah siswa baru.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $schools = School::all();
        $types = Type::all();
        $users = User::all();

        return view('students.create', compact('schools', 'types', 'users'));
    }

    /**
     * Menyimpan data siswa baru.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'student_name' => 'required|string|max:255',
            'student_grade' => 'required|string|max:255',
            'student_email' => 'required|email|max:255',
            'student_address' => 'required|string|max:255',
            'student_phone' => 'required|string|max:20',
            'student_level' => 'required|string|max:255',
            'student_status' => 'required|string|max:255',
            'student_dob' => 'required|date',
            'student_regist_date' => 'required|date',
            'type_id' => 'required|exists:types,type_id',
            'school_id' => 'required|exists:schools,school_id',
            'user_id' => 'required|string|max:255',
        ]);

        try {
            $student = new Student();
            $student->student_name = $request->input('student_name');
            $student->student_grade = $request->input('student_grade');
            $student->student_email = $request->input('student_email');
            $student->student_address = $request->input('student_address');
            $student->student_phone = $request->input('student_phone');
            $student->student_level = $request->input('student_level');
            $student->student_status = $request->input('student_status');
            $student->student_dob = $request->input('student_dob');
            $student->student_regist_date = $request->input('student_regist_date');
            $student->type_id = $request->input('type_id');
            $student->school_id = $request->input('school_id');
            $student->user_id = $request->input('user_id');
            $student->save();

            Log::info('Student created successfully: ', ['student_id' => $student->student_id]);

            return redirect()->route('students.index')->with('success', 'Student created successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to create student: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to create student.');
        }
    }

    /**
     * Menampilkan form untuk mengedit siswa.
     *
     * @param  Student  $student
     * @return \Illuminate\View\View
     */
    public function edit(Student $student)
    {
        $schools = School::all();
        $types = Type::all();
        $users = User::all();

        return view('students.edit', compact('student', 'schools', 'types', 'users'));
    }

    /**
     * Mengupdate data siswa.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Student  $student
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Student $student)
    {
        $request->validate([
            'student_name' => 'required|string|max:255',
            'student_grade' => 'required|string|max:255',
            'student_email' => 'required|email|max:255',
            'student_address' => 'required|string|max:255',
            'student_phone' => 'required|string|max:20',
            'student_level' => 'required|string|max:255',
            'student_status' => 'required|string|max:255',
            'student_dob' => 'required|date',
            'student_regist_date' => 'required|date',
            'type_id' => 'required|exists:types,type_id',
            'school_id' => 'required|exists:schools,school_id',
            'user_id' => 'required|string|max:255',
        ]);

        try {
            $student->student_name = $request->input('student_name');
            $student->student_grade = $request->input('student_grade');
            $student->student_email = $request->input('student_email');
            $student->student_address = $request->input('student_address');
            $student->student_phone = $request->input('student_phone');
            $student->student_level = $request->input('student_level');
            $student->student_status = $request->input('student_status');
            $student->student_dob = $request->input('student_dob');
            $student->student_regist_date = $request->input('student_regist_date');
            $student->type_id = $request->input('type_id');
            $student->school_id = $request->input('school_id');
            $student->user_id = $request->input('user_id');
            $student->save();

            Log::info('Student updated successfully: ', ['student_id' => $student->student_id]);

            return redirect()->route('students.index')->with('success', 'Student updated successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to update student: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to update student.');
        }
    }

    /**
     * Menghapus siswa.
     *
     * @param  Student  $student
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Student $student)
    {
        try {
            $student->delete();
            Log::info('Student deleted successfully: ', ['student_id' => $student->student_id]);

            return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to delete student: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to delete student.');
        }
    }

    public function updateUserIds()
    {
        $students = Student::all();

        foreach ($students as $student) {
            $user = User::where('username', $student->username)->first();
            if ($user) {
                $student->user_id = $user->id;
                $student->save();
            }
        }

        return "User IDs for students have been updated.";
    }

}
