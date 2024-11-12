<!-- resources/views/students/index.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student List</title>
    <link rel="stylesheet" href="{{ asset('css/admin/student.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="sidebar">
        <h2>Admin Menu</h2>
        <ul>
            <li><a href="{{ route('schedules.index') }}">Manage Schedules</a></li>
            <li><a href="{{ route('bills.index') }}">Manage Bills</a></li>
            <li><a href="{{ route('students.index') }}">Manage Student Data</a></li>
            <li><a href="{{ route('teachers.index') }}">Manage Teachers Data</a></li>
            <li><a href="{{ route('users.index') }}">Manage User and Role</a></li>
            <li><a href="{{ route('adminfirst') }}">Back</a></li>
        </ul>
    </div>
    <button class="toggle-btn" onclick="toggleSidebar()">☰</button>
    <div class="content">
        <h2>Student List</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <!-- Search Form -->
        <form method="GET" action="{{ route('students.index') }}" class="mb-3">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name" class="form-control" />
            <button type="submit" class="btn btn-primary mt-2">Search</button>
        </form>

        <a href="{{ route('students.create') }}" class="btn btn-primary mb-3">Add New Student</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Student Name</th>
                    <th>Grade</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $student)
                    <tr>
                        <td>{{ $student->student_id }}</td>
                        <td>{{ $student->student_name }}</td>
                        <td>{{ $student->student_grade }}</td>
                        <td>{{ $student->student_email }}</td>
                        <td>{{ $student->student_phone }}</td>
                        <td>
                            <a href="{{ route('students.edit', $student->student_id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('students.destroy', $student->student_id) }}" method="POST" style="display:inline;">
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
