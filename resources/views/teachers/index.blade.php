<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher List</title>
    <link href="{{ asset('images/icons/BCIL2.png') }}" rel="icon">
    <link href="{{ asset('images/icons/BCIL2.png') }}" rel="apple-touch-icon">
    <link rel="stylesheet" href="{{ asset('css/admin/student.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="sidebar">
        <h2>Admin Menu</h2>
        <ul>
            <li><a href="{{ route('schedules.index') }}">Manage Schedules</a></li>
            <li><a href="{{ route('bills.index') }}">Manage Bills</a></li>
            <li><a href="{{ route('students.index') }}">Manage Students Data</a></li>
            <li><a href="{{ route('teachers.index') }}">Manage Teachers Data</a></li>
            <li><a href="{{ route('users.index') }}">Manage User and Role</a></li>
            <li><a href="{{  route('adminfirst') }}">Back</a></li>
        </ul>
    </div>
        <button class="toggle-btn" onclick="toggleSidebar()">☰</button>
    <div class="content">
<div class="container">
    <h2>Teacher List</h2>

    <!-- Pesan sukses atau error -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form method="GET" action="{{ route('teachers.index') }}" class="mb-3">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name" class="form-control" />
            <button type="submit" class="btn btn-primary mt-2">Search</button>
        </form>

    <a href="{{ route('teachers.create') }}" class="btn btn-primary mb-3">Add New Teacher</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Date of Birth</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Address</th>
                <th>Subject</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($teachers as $teacher)
                <tr>
                    <td>{{ $teacher->teacher_id }}</td>
                    <td>{{ $teacher->teacher_name }}</td>
                    <td>{{ $teacher->teacher_dob }}</td>
                    <td>{{ $teacher->teacher_phone }}</td>
                    <td>{{ $teacher->teacher_email }}</td>
                    <td>{{ $teacher->teacher_address }}</td>
                    <td>@if($teacher->subjects->isNotEmpty())
                        @foreach($teacher->subjects as $subject)
                        {{ $subject->subject_name }}<br>
                        @endforeach
                        @else
                            N/A
                        @endif</td>

                    <td>
                        <a href="{{ route('teachers.edit', $teacher->teacher_id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('teachers.destroy', $teacher->teacher_id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            sidebar.classList.toggle('active');
        }
    </script>
</body>
</html>