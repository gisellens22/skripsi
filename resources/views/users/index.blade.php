<!-- resources/views/student-list.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
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
            <li><a href="{{  route('adminfirst') }}">Back</a></li>
        </ul>
    </div>
        <button class="toggle-btn" onclick="toggleSidebar()">☰</button>
    <div class="container">
        <h1>Users</h1>
        

        <form method="GET" action="{{ route('users.index') }}" class="mb-3">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name or username" class="form-control" />
            <button type="submit" class="btn btn-primary mt-2">Search</button>
        </form>

        <a href="{{ route('users.create') }}" class="btn btn-primary">Add New User</a>
        @if (session('success'))
            <div class="alert alert-success mt-2">{{ session('success') }}</div>
        @endif

        <table class="table table-striped mt-4">
            <thead>
                <tr>
                    <th>UserId</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->role->name }}</td>
                        <td>
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline-block;">
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
