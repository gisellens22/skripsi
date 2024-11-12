@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Teacher</h2>

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

    <form action="{{ route('teachers.update', $teacher->teacher_id) }}" method="POST">
    @csrf
    @method('PUT')
        <div class="form-group">
            <label for="teacher_id">Teacher Id</label>
            <input type="text" class="form-control" id="teacher_id" name="teacher_id" value="{{ old('teacher_id', $teacher->teacher_id) }}" required>
        </div>
        <div class="form-group">
            <label for="teacher_name">Name</label>
            <input type="text" class="form-control" id="teacher_name" name="teacher_name" value="{{ old('teacher_name', $teacher->teacher_name) }}" required>
        </div>
        <div class="form-group">
            <label for="teacher_dob">Date of Birth</label>
            <input type="date" class="form-control" id="teacher_dob" name="teacher_dob" value="{{ old('teacher_dob', $teacher->teacher_dob) }}" required>
        </div>
        <div class="form-group">
            <label for="teacher_phone">Phone</label>
            <input type="text" class="form-control" id="teacher_phone" name="teacher_phone" value="{{ old('teacher_phone', $teacher->teacher_phone) }}" required>
        </div>
        <div class="form-group">
            <label for="teacher_email">Email</label>
            <input type="email" class="form-control" id="teacher_email" name="teacher_email" value="{{ old('teacher_email', $teacher->teacher_email) }}" required>
        </div>
        <div class="form-group">
            <label for="teacher_address">Address</label>
            <input type="text" class="form-control" id="teacher_address" name="teacher_address" value="{{ old('teacher_address', $teacher->teacher_address) }}" required>
        </div>
        <div class="form-group">
            <label for="teacher_education">Education</label>
            <input type="text" class="form-control" id="teacher_education" name="teacher_education" value="{{ old('teacher_education', $teacher->teacher_education) }}" required>
        </div>
        <div class="form-group">
            <label for="teacher_position">Position</label>
            <input type="text" class="form-control" id="teacher_position" name="teacher_position" value="{{ old('teacher_position', $teacher->teacher_position) }}" required>
        </div>
        <div class="form-group">
        <label for="subject_id">Subject</label>
        <select class="form-control" id="subject_id" name="subject_id" required>
            <option value="">Pilih Subject</option>
            @foreach($subjects as $subject)
                <option value="{{ $subject->subject_id }}" {{ $teacher->subject_id == $subject->subject_id ? 'selected' : '' }}>
                    {{ $subject->subject_name }}
                </option>
            @endforeach
             </select>
        </div>
        <div class="form-group">
        <label for="user_id">User</label>
        <select class="form-control" id="user_id" name="user_id" required>
            <option value="">Pilih User</option>
            @foreach($users as $user)
                <option value="{{ $user->id }}" {{ $teacher->user_id == $user->id ? 'selected' : '' }}>
                    {{ $user->name }}
                </option>
            @endforeach
        </select>
    </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
