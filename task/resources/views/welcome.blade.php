<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome | Task Management App</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body class="bg-white text-gray-900 h-screen flex items-center justify-center">
    
<div class="bg-purple-800 backdrop-blur-lg p-10 rounded-2xl shadow-xl text-center max-w-xl border border-white/20 text-white">
        <h1 class="text-5xl font-extrabold text-white mb-4">Welcome!</h1>
        <p class="text-lg mb-6 bg-gradient-to-r from-green-300 via-purple-400 to-blue-300 text-transparent bg-clip-text font-semibold drop-shadow-lg">
    Effortlessly manage tasks, track progress, and boost productivity with ease.
</p>

        <div class="flex justify-center space-x-6 mt-6">
            <!-- Admin Login -->
            <a href="{{ route('admin.login') }}" class="flex items-center gap-3 bg-purple-500 text-white px-6 py-3 rounded-lg text-lg hover:bg-purple-600 transition-all shadow-md hover:shadow-lg hover:scale-105">
                <i class="fas fa-user-shield text-xl"></i> Admin Login
            </a>
            
            <!-- Employee Login -->
            <a href="{{ route('employee.login') }}" class="flex items-center gap-3 bg-green-500 text-white px-6 py-3 rounded-lg text-lg hover:bg-green-600 transition-all shadow-md hover:shadow-lg hover:scale-105">
                <i class="fas fa-user text-xl"></i> Employee Login
            </a>
        </div>
    </div>
    
</body>
</html>
