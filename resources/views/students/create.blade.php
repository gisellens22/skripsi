@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add New Student</h2>

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

    <form action="{{ route('students.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="student_name">Student Name</label>
            <input type="text" class="form-control" id="student_name" name="student_name" value="{{ old('student_name') }}" required>
        </div>
        <div class="form-group">
            <label for="student_grade">Grade</label>
            <input type="text" class="form-control" id="student_grade" name="student_grade" value="{{ old('student_grade') }}" required>
        </div>
        <div class="form-group">
            <label for="student_email">Email</label>
            <input type="email" class="form-control" id="student_email" name="student_email" value="{{ old('student_email') }}" required>
        </div>
        <div class="form-group">
            <label for="student_address">Address</label>
            <input type="text" class="form-control" id="student_address" name="student_address" value="{{ old('student_address') }}" required>
        </div>
        <div class="form-group">
            <label for="student_phone">Phone</label>
            <input type="text" class="form-control" id="student_phone" name="student_phone" value="{{ old('student_phone') }}" required>
        </div>
        <div class="form-group">
            <label for="student_level">Level</label>
            <input type="text" class="form-control" id="student_level" name="student_level" value="{{ old('student_level') }}" required>
        </div>
        <div class="form-group">
            <label for="student_status">Status</label>
            <input type="text" class="form-control" id="student_status" name="student_status" value="{{ old('student_status') }}" required>
        </div>
        <div class="form-group">
            <label for="student_dob">Date of Birth</label>
            <input type="date" class="form-control" id="student_dob" name="student_dob" value="{{ old('student_dob') }}" required>
        </div>
        <div class="form-group">
            <label for="student_regist_date">Registration Date</label>
            <input type="date" class="form-control" id="student_regist_date" name="student_regist_date" value="{{ old('student_regist_date') }}" required>
        </div>
        <div class="form-group">
            <label for="type_id">Type</label>
            <select class="form-control" id="type_id" name="type_id" required>
                <option value="">Select Type</option>
                @foreach($types as $type)
                    <option value="{{ $type->type_id }}" {{ old('type_id') == $type->type_id ? 'selected' : '' }}>
                        {{ $type->type_name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="school_id">School</label>
            <select class="form-control" id="school_id" name="school_id" required>
                <option value="">Select School</option>
                @foreach($schools as $school)
                    <option value="{{ $school->school_id }}" {{ old('school_id') == $school->school_id ? 'selected' : '' }}>
                        {{ $school->school_name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="user_id">User</label>
            <select class="form-control" id="user_id" name="user_id" required>
                <option value="">Select User</option>
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
