@extends('layouts.app')

@section('content')
    <h1>Schedule Detail</h1>
    <ul>
        <li>Day: {{ $schedule->schedule_day }}</li>
        <li>Time: {{ $schedule->schedule_time }}</li>
        <li>Teacher: {{ $schedule->teacher->teacher_name }}</li>
        <li>Student: {{ $schedule->student->student_name }}</li>
    </ul>
    <a href="{{ route('schedules.index') }}" class="btn btn-secondary">Back</a>
@endsection
