<!-- resources/views/studentfirst.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/adminfirst.css') }}"> <!-- Link ke file CSS -->
</head>
<body>
    <div class="sidebar">
        <h2>Student Menu</h2>
        <ul>
            <li><a href="{{ route('studentsusers.index') }}">My Biodata</a></li>
            <li><a href="{{ route('studentsusers.schedule') }}">My Schedules</a></li>
            <li><a href="{{ route('studentsusers.bill') }}">My Bills</a></li>
        </ul>
    </div>

    <div class="content">
        <h1>Student Dashboard</h1>
        <p>Welcome, Student!</p>

        <form action="{{ route('logout.perform') }}" method="POST">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </div>
</body>
</html>
