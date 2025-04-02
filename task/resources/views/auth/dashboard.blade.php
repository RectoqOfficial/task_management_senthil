<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-gray-100 flex">

    <!-- Sidebar -->
    <div class="w-64 min-h-screen bg-gradient-to-b from-blue-800 to-blue-900 text-white p-5 shadow-lg">
        <div class="text-center mb-6">
            <h2 class="text-lg font-semibold">Employee Dashboard</h2>
        </div>
        <nav class="space-y-2">
            <a href="#" class="flex items-center px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                <i class="bi bi-person mr-2"></i> My Profile
            </a>
            <a href="#" class="flex items-center px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                <i class="bi bi-list-task mr-2"></i> My Tasks
            </a>
            <a href="#" class="flex items-center px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                <i class="bi bi-trophy mr-2"></i> My Score Board
            </a>
            <form action="{{ route('employee.logout') }}" method="POST" class="mt-6">
                @csrf
                <button type="submit" class="w-full flex items-center px-4 py-2 rounded-lg bg-red-600 hover:bg-red-700 transition">
                    <i class="bi bi-box-arrow-right mr-2"></i> Logout
                </button>
            </form>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="flex-1 p-10">
        <div class="bg-white shadow-lg rounded-lg p-6">
            <h2 class="text-2xl font-bold text-gray-700 text-center">Welcome, Employee!</h2>
            <p class="text-gray-600 text-center mt-2">Manage your tasks and performance here.</p>
        </div>
    </div>

</body>
</html>
