<!-- resources/views/schedules/index.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule List</title>
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
            <li><a href="{{ route('students.index') }}">Manage Student Data</a></li>
            <li><a href="{{ route('teachers.index') }}">Manage Teachers Data</a></li>
            <li><a href="{{ route('users.index') }}">Manage User and Role</a></li>
            <li><a href="{{ route('adminfirst') }}">Back</a></li>
        </ul>
    </div>
    <button class="toggle-btn" onclick="toggleSidebar()">☰</button>

    <div class="content">
        <h1>Schedule List</h1>

        <!-- Search Form -->
        <form method="GET" action="{{ route('schedules.index') }}" class="mb-3">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by student name" class="form-control" />
            <button type="submit" class="btn btn-primary mt-2">Search</button>
        </form>

        <a href="{{ route('schedules.create') }}" class="btn btn-primary mb-3">Add New Schedule</a>

        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Schedule Day</th>
                    <th>Schedule Time</th>
                    <th>Teacher</th>
                    <th>Student</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($schedules as $schedule)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $schedule->schedule_day }}</td>
                    <td>{{ $schedule->schedule_time }}</td>
                    <td>{{ $schedule->teacher ? $schedule->teacher->teacher_name : 'N/A' }}</td>
                    <td>{{ $schedule->student ? $schedule->student->student_name : 'N/A' }}</td>
                    <td>
                        <a href="{{ route('schedules.edit', ['schedule' => $schedule->schedule_id]) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('schedules.destroy', ['schedule' => $schedule->schedule_id]) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
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
