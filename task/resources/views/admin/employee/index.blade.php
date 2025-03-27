<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee List</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">

<div class="max-w-6xl mx-auto bg-white shadow-md rounded-lg p-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold text-gray-700">Employee List</h2>
        <a href="{{ route('admin.employee.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
            + Create Employee
        </a>
    </div>

    <table class="w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-200">
                <th class="border border-gray-300 px-4 py-2">ID</th>
                <th class="border border-gray-300 px-4 py-2">Name</th>
                <th class="border border-gray-300 px-4 py-2">Email</th>
                <th class="border border-gray-300 px-4 py-2">Contact</th>
                <th class="border border-gray-300 px-4 py-2">Gender</th>
                <th class="border border-gray-300 px-4 py-2">Department</th>
                <th class="border border-gray-300 px-4 py-2">Role</th>
                <th class="border border-gray-300 px-4 py-2">Joining Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($employees as $employee)
            <tr class="bg-white hover:bg-gray-100 text-gray-700">
                <td class="border border-gray-300 px-4 py-2 text-center">{{ $employee->id }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $employee->name }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $employee->email }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $employee->contact }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $employee->gender }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $employee->department }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $employee->role->role }}</td>
                <td class="border border-gray-300 px-4 py-2 text-center">{{ $employee->joining_date }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

</body>
</html>
