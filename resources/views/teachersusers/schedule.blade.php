<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/teacherschedule.css') }}"> <!-- Link ke file CSS -->
    <link href="{{ asset('images/icons/BCIL2.png') }}" rel="icon">
    <link href="{{ asset('images/icons/BCIL2.png') }}" rel="apple-touch-icon">
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

<h2>Teacher's Schedule</h2>

@if($schedules->isEmpty())
    <p>Jadwal tidak ditemukan.</p>
@else
    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>Day</th>
                <th>Time</th>
                <th>Student</th>
            </tr>
        </thead>
        <tbody>
            @foreach($schedules as $schedule)
                <tr>
                    <td>{{ $schedule->schedule_day }}</td>
                    <td>{{ $schedule->schedule_time }}</td>
                    <td>{{ $schedule->student->student_name ?? 'N/A'}}</td>
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
