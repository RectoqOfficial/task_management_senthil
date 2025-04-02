<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome | Task Management App</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-gray-900 via-gray-800 to-gray-900 text-gray-300 h-screen flex items-center justify-center">
    
    <div class="text-center max-w-xl">
        <h1 class="text-4xl font-bold text-white mb-4">Welcome to Task Management App</h1>
        <p class="text-lg mb-6">Efficiently manage your tasks, track progress, and stay productive with our easy-to-use platform.</p>
        
        <a href="{{ route('admin.login') }}" class="bg-blue-500 text-white px-6 py-3 rounded-lg text-lg hover:bg-blue-600 transition">Login</a>
    </div>
    
</body>
</html>
