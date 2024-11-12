<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;

class SubjectController extends Controller
{
    // Menampilkan daftar semua mata pelajaran
    public function index()
    {
        $subjects = Subject::all();
        return view('subjects.index', compact('subjects'));
    }

    // Menampilkan form untuk membuat mata pelajaran baru
    public function create()
    {
        return view('subjects.create');
    }

    // Menyimpan mata pelajaran baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'subject_name' => 'required|string|max:255',
            'teacher_id' => 'nullable|exists:teachers,id',
        ]);

        Subject::create([
            'subject_name' => $request->subject_name,
            'teacher_id' => $request->teacher_id,
        ]);

        return redirect()->route('subjects.index')->with('success', 'Subject created successfully.');
    }

    // Menampilkan detail mata pelajaran berdasarkan ID
    public function show($id)
    {
        $subject = Subject::findOrFail($id);
        return view('subjects.show', compact('subject'));
    }

    // Menampilkan form untuk mengedit mata pelajaran
    public function edit($id)
    {
        $subject = Subject::findOrFail($id);
        return view('subjects.edit', compact('subject'));
    }

    // Mengupdate data mata pelajaran di database
    public function update(Request $request, $id)
    {
        $request->validate([
            'subject_name' => 'required|string|max:255',
            'teacher_id' => 'nullable|exists:teachers,id',
        ]);

        $subject = Subject::findOrFail($id);
        $subject->update([
            'subject_name' => $request->subject_name,
            'teacher_id' => $request->teacher_id,
        ]);

        return redirect()->route('subjects.index')->with('success', 'Subject updated successfully.');
    }

    // Menghapus mata pelajaran dari database
    public function destroy($id)
    {
        $subject = Subject::findOrFail($id);
        $subject->delete();

        return redirect()->route('subjects.index')->with('success', 'Subject deleted successfully.');
    }
}
