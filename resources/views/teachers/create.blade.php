@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add New Teacher</h2>

    <!-- Tampilkan pesan error -->
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('teachers.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="teacher_name">Id</label>
            <input type="text" class="form-control" id="teacher_id" name="teacher_id" value="{{ old('teacher_id') }}" required>
        </div>
        <div class="form-group">
            <label for="teacher_name">Name</label>
            <input type="text" class="form-control" id="teacher_name" name="teacher_name" value="{{ old('teacher_name') }}" required>
        </div>
        <div class="form-group">
            <label for="teacher_dob">Date of Birth</label>
            <input type="date" class="form-control" id="teacher_dob" name="teacher_dob" value="{{ old('teacher_dob') }}" required>
        </div>
        <div class="form-group">
            <label for="teacher_phone">Phone</label>
            <input type="text" class="form-control" id="teacher_phone" name="teacher_phone" value="{{ old('teacher_phone') }}" required>
        </div>
        <div class="form-group">
            <label for="teacher_email">Email</label>
            <input type="email" class="form-control" id="teacher_email" name="teacher_email" value="{{ old('teacher_email') }}" required>
        </div>
        <div class="form-group">
            <label for="teacher_address">Address</label>
            <input type="text" class="form-control" id="teacher_address" name="teacher_address" value="{{ old('teacher_address') }}" required>
        </div>
        <div class="form-group">
            <label for="teacher_education">Education</label>
            <input type="text" class="form-control" id="teacher_education" name="teacher_education" value="{{ old('teacher_education') }}" required>
        </div>
        <div class="form-group">
            <label for="teacher_position">Position</label>
            <input type="text" class="form-control" id="teacher_position" name="teacher_position" value="{{ old('teacher_position') }}" required>
        </div>
        <div class="form-group">
            <label for="subject_id">Select Subject</label>
            <select name="subject_id" class="form-control" id="subject_id" required>
                <option value="">Select a Subject</option>
                @foreach($subjects as $subject)
                    <option value="{{ $subject->subject_id }}" {{ old('subject_id') == $subject->subject_id ? 'selected' : '' }}>
                        {{ $subject->subject_name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="user_id">Select User</label>
            <select name="user_id" class="form-control" id="user_id" required>
                <option value="">Select a User</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
