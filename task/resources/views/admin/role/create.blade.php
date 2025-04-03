<!-- <!DOCTYPE html>
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
            width: 420px;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
            background: white;
            text-align: center;
        }
        h2 {
            font-weight: 700;
            color: #222; /* Darker text for contrast */
            letter-spacing: 1px;
        }
        label {
            font-weight: 500;
            color: #333; /* Brighter label text */
        }
        .form-control {
            font-size: 16px;
        }
        .btn-success {
            width: 100%;
            font-size: 16px;
            font-weight: 700;
            padding: 12px;
            transition: 0.3s;
            background: linear-gradient(to right, #28a745, #1e7e34);
            border: none;
            color: white;
        }
        .btn-success:hover {
            background: #1e7e34;
            transform: scale(1.03);
        }
        .alert {
            font-size: 15px;
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
        
        <form id="create-role-form" action="{{ route('admin.roles.store') }}" method="POST">
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
        </form> -->

        <!-- Success Message (Initially Hidden) -->
        <!-- <div id="success-message" class="alert alert-success mt-3" style="display: none;">
            Role created successfully!
        </div>
    </div>
</body>
</html> -->
