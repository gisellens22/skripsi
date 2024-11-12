<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BillController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        // Prepare the query to fetch bills
        $query = Bill::join('students', 'bills.student_id', '=', 'students.student_id')
            ->select('bills.*', 'students.student_name');

        // Check if there's a search query and apply it
        if ($request->has('search')) {
            $query->where('students.student_name', 'LIKE', '%' . $request->search . '%');
        }

        // Execute the query and get the results
        $bills = $query->get();
        return view('bills.index', compact('bills'));
    }

    public function studentBills()
    {
    // Ambil user yang sedang login
    $user = Auth::user();

    // Ambil student berdasarkan user yang login
    $student = Student::where('user_id', $user->id)->first();

    // Pastikan student ditemukan, lalu ambil jadwalnya
    if ($student) {
        $bills = $student->bills; // Ambil jadwal yang terkait dengan student ini
        return view('studentsusers.bill', compact('bills'));
    } else {
        return redirect()->back()->with('error', 'Data jadwal tidak ditemukan untuk pengguna ini.');
    }
    }

    public function create()
    {
        $students = Student::all();
        return view('bills.create', compact('students'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,student_id',
            'bill_price' => 'required|numeric',
            'bill_month' => 'required',
            'bill_status' => 'required|in:PAID,UNPAID'
        ]);

        Bill::create($request->all());
        return redirect()->route('bills.index')->with('success', 'Bill created successfully');
    }

    public function edit($id)
    {
        $bill = Bill::findOrFail($id);
        $students = Student::all();
        return view('bills.edit', compact('bill', 'students'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'student_id' => 'required|exists:students,student_id',
            'bill_price' => 'required|numeric',
            'bill_month' => 'required',
            'bill_status' => 'required|in:PAID,UNPAID'
        ]);

        $bill = Bill::findOrFail($id);
        $bill->update($request->all());
        return redirect()->route('bills.index')->with('success', 'Bill updated successfully');
    }

    public function destroy($id)
    {
        $bill = Bill::findOrFail($id);
        $bill->delete();
        return redirect()->route('bills.index')->with('success', 'Bill deleted successfully');
    }
}