<!-- resources/views/teacherfirst.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/adminfirst.css') }}"> <!-- Link ke file CSS -->
</head>
<body>
    <div class="sidebar">
        <h2>Teacher Menu</h2>
        <ul>
            <li><a href="{{ route('teachersusers.index') }}">View My Data</a></li>
            <li><a href="{{ route('teachersusers.schedule') }}">View My Schedule</a></li>
        </ul>
    </div>

    <div class="content">
        <h1>Teacher Dashboard</h1>
        <p>Welcome, Teacher!</p>

        <form action="{{ route('logout.perform') }}" method="POST">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </div>
</body>
</html>
