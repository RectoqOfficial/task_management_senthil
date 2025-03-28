<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Role Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <style>
        body {
            background: linear-gradient(to right, #4facfe, #00f2fe); /* Gradient Background */
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .container {
            max-width: 900px;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background: white;
            padding: 20px;
        }
        .table th, .table td {
            vertical-align: middle;
        }
        .btn {
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <h2 class="text-center text-primary"><i class="bi bi-person-badge"></i> Role Management</h2>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="d-flex justify-content-end">
                <a href="{{ route('admin.roles.create') }}" class="btn btn-success mb-3">
                    <i class="bi bi-plus-lg"></i> Create Role
                </a>
            </div>

            <table class="table table-hover table-bordered text-center bg-white">
                <thead class="table-dark">
                    <tr>
                        <th><i class="bi bi-hash"></i> ID</th>
                        <th><i class="bi bi-person"></i> Role Name</th>
                        <th><i class="bi bi-building"></i> Department</th>
                        <th><i class="bi bi-gear"></i> Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($roles as $role)
                        <tr>
                            <td>{{ $role->id }}</td>
                            <td>{{ $role->role }}</td>
                            <td>{{ $role->department }}</td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                            <i class="bi bi-trash"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
