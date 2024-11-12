@extends('layouts.app')

@section('content')
    <h1>Add New Schedule</h1>

    <form action="{{ route('schedules.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="schedule_day">Schedule Day</label>
            <input type="text" name="schedule_day" class="form-control" id="schedule_day" required>
        </div>

        <div class="form-group">
            <label for="schedule_time">Schedule Time</label>
            <input type="time" name="schedule_time" class="form-control" id="schedule_time" required>
        </div>

        <div class="form-group">
            <label for="teacher_id">Select Teacher</label>
            <select name="teacher_id" class="form-control" id="teacher_id" required>
                @foreach($teachers as $teacher)
                    <option value="{{ $teacher->teacher_id }}">{{ $teacher->teacher_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="student_id">Select Student</label>
            <select name="student_id" class="form-control" id="student_id" required>
                @foreach($students as $student)
                    <option value="{{ $student->student_id }}">{{ $student->student_name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Create Schedule</button>
    </form>
@endsection
