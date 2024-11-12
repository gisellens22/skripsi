@extends('layouts.app')

@section('content')
    <h1>Bill Detail</h1>
    <ul>
        <li>Student: {{ $bill->student->student_id }}</li>
        <li>Month: {{ $bill->bill_month }}</li>
        <li>Price: {{ $bill->bill_price }}</li>
        <li>Status: {{ $bill->bill_status }}</li>
    </ul>
    <a href="{{ route('bills.index') }}" class="btn btn-secondary">Back</a>
@endsection
