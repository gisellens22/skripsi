@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h2>Edit Bill</h2>
    <form action="{{ route('bills.update', $bill->bill_id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group mb-3">
            <label>Student</label>
            <select name="student_id" class="form-control">
                @foreach($students as $student)
                    <option value="{{ $student->student_id }}" {{ $bill->student_id == $student->student_id ? 'selected' : '' }}>
                        {{ $student->student_name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group mb-3">
            <label>Price</label>
            <input type="number" name="bill_price" class="form-control" step="0.01" value="{{ $bill->bill_price }}" required>
        </div>
        <div class="form-group mb-3">
            <label>Month</label>
            <input type="month" name="bill_month" class="form-control" value="{{ $bill->bill_month }}" required>
        </div>
        <div class="form-group mb-3">
            <label>Status</label>
            <select name="bill_status" class="form-control">
                <option value="PAID" {{ $bill->bill_status == 'PAID' ? 'selected' : '' }}>PAID</option>
                <option value="UNPAID" {{ $bill->bill_status == 'UNPAID' ? 'selected' : '' }}>UNPAID</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('bills.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection