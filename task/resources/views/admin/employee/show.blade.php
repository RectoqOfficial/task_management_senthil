<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Details</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-200 p-6 font-sans">

<div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg p-6">
    <h2 class="text-2xl font-semibold text-gray-800">Employee Details</h2>

    <div class="mt-4">
        <p><strong>ID:</strong> {{ $employee->id }}</p>
        <p><strong>Name:</strong> {{ $employee->name }}</p>
        <p><strong>Email:</strong> {{ $employee->email }}</p>
        <p><strong>Contact:</strong> {{ $employee->contact }}</p>
        <p><strong>Gender:</strong> {{ $employee->gender }}</p>
        <p><strong>Department:</strong> {{ $employee->department }}</p>
        <p><strong>Role:</strong> {{ $employee->role->role }}</p>
        <p><strong>Joining Date:</strong> {{ $employee->joining_date }}</p>
    </div>

    <div class="mt-6">
        <a href="{{ route('admin.employee.index') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">Back to List</a>
    </div>
</div>

</body>
</html>
