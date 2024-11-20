<!-- resources/views/bills/index.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bills Management</title>
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
            <li><a href="{{ route('adminfirst') }}">Back</a></li>
        </ul>
    </div>

    <button class="toggle-btn" onclick="toggleSidebar()">☰</button>

    <div class="container-fluid d-flex">
        <div class="content">
            <h2>Bills Management</h2>
            

            <!-- Search Form -->
            <form method="GET" action="{{ route('bills.index') }}" class="mb-3">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by student name" class="form-control" />
                <button type="submit" class="btn btn-primary mt-2">Search</button>
            </form>

            <a href="{{ route('bills.create') }}" class="btn btn-primary mb-3">Create New Bill</a>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Student Name</th>
                            <th>Month</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bills as $index => $bill)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $bill->student_name }}</td>
                            <td>{{ $bill->bill_month }}</td>
                            <td>Rp {{ number_format($bill->bill_price, 0, ',', '.') }}</td>
                            <td>{{ $bill->bill_status }}</td>
                            <td>
                                <a href="{{ route('bills.edit', $bill->bill_id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('bills.destroy', $bill->bill_id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            sidebar.classList.toggle('active');
        }
    </script>
</body>
</html>
