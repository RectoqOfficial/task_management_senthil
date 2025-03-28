<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Role</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to right, #4facfe, #00f2fe); /* Gradient Background */
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
        }
        .card {
            width: 400px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            background: white;
        }
        h2 {
            text-align: center;
            font-weight: 600;
            color: #333;
        }
        .btn-success {
            width: 100%;
            font-weight: 600;
            transition: 0.3s;
            background: linear-gradient(to right, #28a745, #218838);
            border: none;
        }
        .btn-success:hover {
            background: #218838;
        }
    </style>
</head>
<body>
    <div class="card">
        <h2>Create Role</h2>
        
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form action="{{ route('admin.roles.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="role" class="form-label">Role Name</label>
                <input type="text" class="form-control" id="role" name="role" required>
            </div>
            <div class="mb-3">
                <label for="department" class="form-label">Department</label>
                <input type="text" class="form-control" id="department" name="department" required>
            </div>
            <button type="submit" class="btn btn-success">Create Role</button>
        </form>
    </div>
</body>
</html>
