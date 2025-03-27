<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Employee</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

<div class="w-full max-w-lg bg-white shadow-lg rounded-lg p-6">
    <h2 class="text-2xl font-bold mb-6 text-gray-700 text-center">Add Employee</h2>

    <form action="/employees/store" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="block text-gray-700">Name:</label>
            <input type="text" name="name" class="w-full border border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-300" required>
        </div>

        <div>
            <label class="block text-gray-700">Email:</label>
            <input type="email" name="email" class="w-full border border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-300" required>
        </div>

        <div>
            <label class="block text-gray-700">Password:</label>
            <input type="password" name="password" class="w-full border border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-300" required>
        </div>

        <div>
            <label class="block text-gray-700">Contact:</label>
            <input type="text" name="contact" class="w-full border border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-300" required>
        </div>

        <div>
            <label class="block text-gray-700">Gender:</label>
            <select name="gender" class="w-full border border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-300" required>
                <option value="">Select Gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
        </div>

        <div>
            <label class="block text-gray-700">Department:</label>
            <select name="department" id="departmentSelect" class="w-full border border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-300" required>
                <option value="">Select Department</option>
                @foreach($departments as $department)
                    <option value="{{ $department }}">{{ $department }}</option>
                @endforeach
            </select>
        </div>

        <div>
    <label class="block text-gray-700">Role:</label>
    <select name="role_id" id="roleSelect" class="w-full border border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-300" required>
        <option value="">Select Role</option>
        @foreach($roles as $role)
            <option value="{{ $role->id }}" data-department="{{ $role->department }}">{{ $role->role }}</option>
        @endforeach
    </select>
</div>

        <div>
            <label class="block text-gray-700">Joining Date:</label>
            <input type="date" name="joining_date" class="w-full border border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-300" required>
        </div>

        <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition">Add Employee</button>
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
