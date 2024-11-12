<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/teacherfirst.css') }}"> <!-- Link ke file CSS -->
</head>
<body>
    <div class="sidebar">
        <h2>Teacher Menu</h2>
        <ul>
            <li><a href="{{ route('teachersusers.index') }}">View My Data</a></li>
            <li><a href="{{ route('teachersusers.schedule') }}">View My Schedule</a></li>
            <li><a href="{{ route('teacherfirst') }}">Back</a></li>
        </ul>
    </div>

    <div class="container">
        <h1>Your Teacher Profile</h1>

        <table class="table table-bordered">
            <tr>
                <th>Name</th>
                <td>{{ $teacher->teacher_name }}</td>
            </tr>
            <tr>
                <th>Date of Birth</th>
                <td>{{ $teacher->teacher_dob }}</td>
            </tr>
            <tr>
                <th>Phone</th>
                <td>{{ $teacher->teacher_phone }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $teacher->teacher_email }}</td>
            </tr>
            <tr>
                <th>Address</th>
                <td>{{ $teacher->teacher_address }}</td>
            </tr>
            <tr>
                <th>Education</th>
                <td>{{ $teacher->teacher_education }}</td>
            </tr>
            <tr>
                <th>Position</th>
                <td>{{ $teacher->teacher_position }}</td>
            </tr>
        </table>
    </div>

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
