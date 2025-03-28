<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center h-screen bg-gradient-to-br from-blue-500 to-indigo-600">

    <div class="bg-white shadow-2xl rounded-xl p-8 w-full max-w-md">
        <h2 class="text-3xl font-bold text-center text-indigo-700 mb-6">Employee Login</h2>

        <form action="{{ route('employee.login.submit') }}" method="POST" class="space-y-4">
            @csrf
            
            <div>
                <label class="block text-gray-700 font-semibold">Email:</label>
                <input type="email" name="email" placeholder="Enter your email" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 transition"
                    required>
            </div>

            <div>
                <label class="block text-gray-700 font-semibold">Password:</label>
                <input type="password" name="password" placeholder="Enter your password" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 transition"
                    required>
            </div>

            <button type="submit" 
                class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg transition duration-300">
                Login
            </button>
        </form>
    </div>

</body>
</html>
