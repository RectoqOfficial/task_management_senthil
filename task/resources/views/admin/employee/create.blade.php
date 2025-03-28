<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Employee</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="bg-gradient-to-r from-green-500 to-indigo-600 flex items-center justify-center min-h-screen p-4">

<div class="w-full max-w-2xl bg-white shadow-xl rounded-lg p-6">
    <h2 class="text-2xl font-bold mb-4 text-gray-800 text-center flex items-center justify-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-7 h-7 text-blue-600">
            <path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a4 4 0 10-8 0v2M5 21h14a2 2 0 002-2v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2z" />
        </svg>
        Add Employee
    </h2>

    <form action="/employees/store" method="POST" class="space-y-4">
        @csrf

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Name:</label>
                <input type="text" name="name" class="w-full border border-gray-300 rounded-lg p-2 bg-gray-50 focus:ring focus:ring-blue-300" placeholder="Full Name" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email:</label>
                <input type="email" name="email" class="w-full border border-gray-300 rounded-lg p-2 bg-gray-50 focus:ring focus:ring-blue-300" placeholder="Email Address" required>
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Password:</label>
            <input type="password" name="password" class="w-full border border-gray-300 rounded-lg p-2 bg-gray-50 focus:ring focus:ring-blue-300" placeholder="Password" required>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Contact:</label>
                <input type="text" name="contact" class="w-full border border-gray-300 rounded-lg p-2 bg-gray-50 focus:ring focus:ring-blue-300" placeholder="Contact Number" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Gender:</label>
                <select name="gender" class="w-full border border-gray-300 rounded-lg p-2 bg-gray-50 focus:ring focus:ring-blue-300" required>
                    <option value="">Select</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Department:</label>
                <select name="department" id="departmentSelect" class="w-full border border-gray-300 rounded-lg p-2 bg-gray-50 focus:ring focus:ring-blue-300" required>
                    <option value="">Select</option>
                    @foreach($departments as $department)
                        <option value="{{ $department }}">{{ $department }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Role:</label>
                <select name="role_id" id="roleSelect" class="w-full border border-gray-300 rounded-lg p-2 bg-gray-50 focus:ring focus:ring-blue-300" required>
                    <option value="">Select</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}" data-department="{{ $role->department }}">{{ $role->role }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Joining Date:</label>
            <input type="date" name="joining_date" class="w-full border border-gray-300 rounded-lg p-2 bg-gray-50 focus:ring focus:ring-blue-300" required>
        </div>

        <button type="submit" class="w-full bg-gradient-to-r from-blue-500 to-indigo-600 text-white py-2 rounded-lg hover:shadow-lg transition duration-300">
            Add Employee
        </button>
    </form>
</div>

<script>
    $('#departmentSelect').on('change', function() {
        var dept = $(this).val();
        $('#roleSelect').empty();
        $('#roleSelect').append('<option value="">Select Role</option>');
        @foreach($roles as $role)
            if ('{{ $role->department }}' == dept) {
                $('#roleSelect').append('<option value="{{ $role->id }}">{{ $role->role }}</option>');
            }
        @endforeach
    });
</script>

</body>
</html>
