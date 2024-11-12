<!-- File: D:\xampp\htdocs\bcilcourse\resources\views\teachersusers\index.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/studentfirst.css') }}"> <!-- Link ke file CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="sidebar">
        <h2>Student Menu</h2>
        <ul>
            <li><a href="{{ route('studentsusers.index') }}">My Biodata</a></li>
            <li><a href="{{ route('studentsusers.schedule') }}">My Schedules</a></li>
            <li><a href="{{ route('studentsusers.bill') }}">My Bills</a></li>
            <li><a href="{{ route('studentfirst') }}">Back</a></li>
        </ul>
    </div>

    <div class="content">
    <div class="container">
        <h1>Your Profile</h1>

        <table class="table table-bordered">
            <tr>
                <th>Name</th>
                <td>{{ $student->student_name }}</td>
            </tr>
            <tr>
                <th>Grade</th>
                <td>{{ $student->student_grade }}</td>
            </tr>
            <tr>
                <th>Level</th>
                <td>{{ $student->student_level }}</td>
            </tr>
            <tr>
                <th>Date of Birth</th>
                <td>{{ $student->student_dob }}</td>
            </tr>
            <tr>
                <th>Phone</th>
                <td>{{ $student->student_phone }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $student->student_email }}</td>
            </tr>
            <tr>
                <th>Address</th>
                <td>{{ $student->student_address }}</td>
            </tr>
            <tr>
                <th>School</th>
                <td>{{ $student->school_id }}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>{{ $student->student_status }}</td>
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

