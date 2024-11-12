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
<h2>My Schedule</h2>

@if($schedules->isEmpty())
    <p>Jadwal tidak ditemukan.</p>
@else
    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>Day</th>
                <th>Time</th>
                <th>Teacher</th>
            </tr>
        </thead>
        <tbody>
            @foreach($schedules as $schedule)
                <tr>
                    <td>{{ $schedule->schedule_day }}</td>
                    <td>{{ $schedule->schedule_time }}</td>
                    <td>{{ $schedule->teacher->teacher_name ?? 'N/A'}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @endif

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
