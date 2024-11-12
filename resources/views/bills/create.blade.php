@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h2>Create New Bill</h2>
    <form action="{{ route('bills.store') }}" method="POST">
        @csrf
        <div class="form-group mb-3">
            <label>Student</label>
            <select name="student_id" class="form-control">
                @foreach($students as $student)
                    <option value="{{ $student->student_id }}">{{ $student->student_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group mb-3">
            <label>Price</label>
            <input type="number" name="bill_price" class="form-control" step="0.01" required>
        </div>
        <div class="form-group mb-3">
            <label>Month</label>
            <input type="month" name="bill_month" class="form-control" required>
        </div>
        <div class="form-group mb-3">
            <label>Status</label>
            <select name="bill_status" class="form-control">
                <option value="PAID">PAID</option>
                <option value="UNPAID">UNPAID</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="{{ route('bills.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection