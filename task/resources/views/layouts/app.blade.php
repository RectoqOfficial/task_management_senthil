<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #e9ecef;
        }
        .sidebar {
            width: 260px;
            height: 100vh;
            position: fixed;
            background: linear-gradient(180deg, #004d99, #00264d);
            padding-top: 20px;
            color: white;
            box-shadow: 4px 0 10px rgba(0, 0, 0, 0.2);
        }
        .sidebar a {
            color: white;
            padding: 15px;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 16px;
            font-family: 'Poppins', sans-serif;
            transition: 0.3s;
        }
        .sidebar a:hover {
            background: rgba(255, 255, 255, 0.1);
            border-left: 5px solid #17a2b8;
            padding-left: 10px;
            border-radius: 5px;
        }
        .sidebar .profile {
            text-align: center;
            padding: 20px;
            border-bottom: 2px solid #0056b3;
            background: rgba(255, 255, 255, 0.1);
        }
        .sidebar .profile h5 {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            font-size: 20px;
            letter-spacing: 1px;
            color: #f8f9fa;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }
        .sidebar .profile img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            margin-bottom: 10px;
            border: 3px solid white;
        }
        .logout {
            position: absolute;
            bottom: 20px;
            width: 100%;
        }
        .content {
            margin-left: 270px;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            font-family: 'Poppins', sans-serif;
        }
        h1, h2, h3, h4, h5, h6, p, a, button, label, input, textarea {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <div class="profile">
        <h5>Welcome, Admin</h5>
    </div>
    <a href="{{ route('admin.dashboard') }}"><i class="bi bi-speedometer2"></i> Dashboard</a>
    <a href="{{ route('admin.employee.index') }}"><i class="bi bi-people"></i> Employee Details</a>
    <a href="{{ route('admin.tasks.index') }}"><i class="bi bi-list-task"></i> Task Details</a>
    <a href="#"><i class="bi bi-trophy"></i> Score Board</a>
    <a href="{{ route('admin.roles.index') }}"><i class="bi bi-person-badge"></i> Role Details</a>
    <a href="{{ route('admin.logout') }}" class="text-danger logout" 
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="bi bi-box-arrow-right"></i> Logout
    </a>
    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
        @csrf
    </form>
</div>

<!-- Main Content -->
<div class="content">
    @yield('content')
</div>

</body>
</html>
