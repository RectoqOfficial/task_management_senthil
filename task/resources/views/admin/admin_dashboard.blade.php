<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

    <!-- jQuery & Bootstrap Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Custom Styles -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

        /* 🎨 4-Color Gradient Background */
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #ff7eb3, #6a11cb, #2575fc, #00c9a7);
            min-height: 100vh;
            margin: 0;
            display: flex;
        }

        /* 🚀 Sidebar - Glassmorphism & Smooth Hover Effects */
        .sidebar {
            width: 260px;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(12px);
            padding-top: 20px;
            color: white;
            box-shadow: 4px 0 15px rgba(0, 0, 0, 0.2);
            overflow-y: auto;
            transition: 0.3s;
        }

        /* Sidebar Links */
        .sidebar a {
            color: white;
            padding: 12px 20px;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 16px;
            transition: 0.3s;
        }

        .sidebar a:hover {
            background: rgba(255, 255, 255, 0.2);
            border-left: 5px solid #ffcc00;
            padding-left: 15px;
            border-radius: 5px;
        }

        /* Active Page Highlight */
        .sidebar a.active {
            background: rgba(255, 255, 255, 0.3);
            border-left: 5px solid #00c9a7;
            font-weight: bold;
        }

        /* Profile Section */
        .sidebar .profile {
            text-align: center;
            padding: 20px;
            border-bottom: 2px solid rgba(255, 255, 255, 0.3);
        }

        /* 🌟 Content Styling */
        .content {
            margin-left: 260px;
            padding: 20px;
            width: calc(100% - 260px);
            min-height: 100vh;
            background: rgba(255, 255, 255, 0.9);
            overflow-y: auto;
            border-radius: 15px;
        }

        /* 🏆 Dashboard Card */
        .card {
            background: linear-gradient(135deg, #ffffff, #f8f9fa);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        /* 🎯 Buttons */
        .btn-custom {
            padding: 10px 15px;
            font-size: 14px;
            font-weight: bold;
            border-radius: 8px;
            transition: 0.3s;
        }

        .btn-custom:hover {
            transform: scale(1.05);
        }

    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="profile">
            <h5>Welcome, Admin</h5>
        </div>
        <a href="#" id="load-dashboard" class="active"><i class="bi bi-speedometer2"></i> Dashboard</a>
        <a href="#" id="load-employees"><i class="bi bi-people"></i> Employee Details</a>
        <a href="#" id="load-tasks"><i class="bi bi-list-task"></i> Task Details</a>
        <a href="{{ url('/score/create') }}"><i class="bi bi-trophy"></i> Score Board</a>
        <a href="javascript:void(0);" id="load-roles"><i class="bi bi-person-badge"></i> Role Details</a>

        <a href="{{ route('admin.logout') }}" class="text-danger" 
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="bi bi-box-arrow-right"></i> Logout
        </a>
        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>

    <!-- Content Section -->
    <div class="content">
        <div id="dynamic-content" class="container mt-5">
            <div class="card text-center">
                <h2 class="fw-bold text-primary">Welcome, Admin!</h2>
                <p class="text-muted">Manage users, tasks, and settings from here.</p>
                <div class="d-flex justify-content-center mt-4">
                    <a href="#" id="load-employees" class="btn btn-info btn-custom mx-2">
                        <i class="bi bi-people"></i> Manage Employees
                    </a>
                    <a href="{{ route('admin.tasks.index') }}" class="btn btn-success btn-custom mx-2">
                        <i class="bi bi-list-task"></i> Manage Tasks
                    </a>
                    <a href="{{ route('admin.roles.index') }}" class="btn btn-warning btn-custom mx-2">
                        <i class="bi bi-person-badge"></i> Manage Roles
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- AJAX Scripts -->
    <script>
        $(document).ready(function () {
            // Load Employee List
            $("#load-employees").click(function (e) {
                e.preventDefault();
                $.ajax({
                    url: "{{ route('admin.employee.index') }}",
                    type: "GET",
                    success: function (response) {
                        $("#dynamic-content").html(response);
                    },
                    error: function () {
                        alert("Failed to load Employee Details.");
                    }
                });
            });

            // Load Task List
            $("#load-tasks").click(function (e) {
                e.preventDefault();
                $.ajax({
                    url: "{{ route('admin.tasks.index') }}",
                    type: "GET",
                    success: function (response) {
                        $("#dynamic-content").html(response);
                    },
                    error: function () {
                        alert("Failed to load Task Details.");
                    }
                });
            });

            // Load Role List
            $("#load-roles").click(function (e) {
                e.preventDefault();
                $.ajax({
                    url: "{{ route('admin.roles.index') }}",
                    type: "GET",
                    success: function (response) {
                        $("#dynamic-content").html(response);
                    },
                    error: function () {
                        alert("Failed to load Role Details.");
                    }
                });
            });
        });
    </script>

</body>
</html>
