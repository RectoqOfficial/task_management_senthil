<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee List</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-blue-500 via-purple-500 to-indigo-600 p-6 font-sans">

<div class="max-w-6xl mx-auto bg-gray-100 shadow-lg rounded-lg p-6">
    <!-- Header Section -->
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-semibold text-gray-800 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7 text-blue-600">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a4 4 0 10-8 0v2M5 21h14a2 2 0 002-2v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2z" />
            </svg>
            Employee List
        </h2>
        <a href="{{ route('admin.employee.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg flex items-center gap-1 hover:bg-blue-700 transition">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            Create Employee
        </a>
    </div>

    <!-- Employee Table -->
    <div class="overflow-x-auto">
        <table class="w-full border-collapse rounded-lg overflow-hidden shadow-md">
            <thead>
                <tr class="bg-blue-600 text-white text-left">
                    <th class="px-4 py-3">ID</th>
                    <th class="px-4 py-3">Name</th>
                    <th class="px-4 py-3">Email</th>
                    <th class="px-4 py-3">Contact</th>
                    <th class="px-4 py-3">Gender</th>
                    <th class="px-4 py-3">Department</th>
                    <th class="px-4 py-3">Role</th>
                    <th class="px-4 py-3">Joining Date</th>
                    <th class="px-4 py-3">Action</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @foreach($employees as $employee)
                <tr class="bg-white border-b hover:bg-gray-100 transition">
                    <td class="px-4 py-3">{{ $employee->id }}</td>
                    <td class="px-4 py-3">{{ $employee->name }}</td>
                    <td class="px-4 py-3">{{ $employee->email }}</td>
                    <td class="px-4 py-3">{{ $employee->contact }}</td>
                    <td class="px-4 py-3">{{ $employee->gender }}</td>
                    <td class="px-4 py-3">{{ $employee->department }}</td>
                    <td class="px-4 py-3">{{ $employee->role->role }}</td>
                    <td class="px-4 py-3 text-center">{{ $employee->joining_date }}</td>
                    <td class="px-4 py-3">
                        <a href="{{ route('admin.employee.show', $employee->id) }}" class="bg-blue-500 text-white px-3 py-2 rounded-lg hover:bg-blue-700 transition">
                            Show
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

</body>
</html>

<!-- nice -->