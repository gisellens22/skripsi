<!-- resources/views/adminfirst.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Favicons -->
  <link href="{{ asset('images/icons/BCIL2.png') }}" rel="icon">
  <link href="{{ asset('images/icons/BCIL2.png') }}" rel="apple-touch-icon">

    <link rel="stylesheet" href="{{ asset('css/adminfirst.css') }}"> <!-- Link ke file CSS -->
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
        </ul>
    </div>

    <div class="content">
        <h1>Admin Dashboard</h1>
        <p>Welcome, Admin!</p>

        <form action="{{ route('logout.perform') }}" method="POST">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
