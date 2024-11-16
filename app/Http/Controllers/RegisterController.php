<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\School;
use App\Models\Type;

class RegisterController extends Controller
{
    public function create()
    {
        // Ambil semua data sekolah dan tipe untuk ditampilkan di form
        $schools = School::all();
        $types = Type::all();
        return view('register', compact('schools', 'types'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'student_name' => 'required|string|max:255',
            'student_grade' => 'required|string|max:50',
            'school_id' => 'required|exists:schools,school_id',
            'type_id' => 'required|exists:types,type_id',
            'student_address' => 'required|string|max:500',
            'student_phone' => 'required|string|max:15',
            'student_email' => 'required|email|unique:students,student_email',
            'student_dob' => 'required|date',
            'student_regist_date' => 'required|date',
        ]);

        // Simpan data ke tabel students
        Student::create([
            'student_name' => $request->student_name,
            'student_grade' => $request->student_grade,
            'school_id' => $request->school_id,
            'type_id' => $request->type_id,
            'student_address' => $request->student_address,
            'student_phone' => $request->student_phone,
            'student_email' => $request->student_email,
            'student_dob' => $request->student_dob,
            'student_regist_date' => $request->student_regist_date,
        ]);

        // Redirect ke halaman registrasi dengan pesan sukses
        return redirect()->route('register.create')->with('success', 'Registrasi berhasil!');
        
    }
}
