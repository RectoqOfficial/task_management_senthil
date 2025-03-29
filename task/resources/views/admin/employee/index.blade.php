<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee List</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="bg-gradient-to-r from-gray-900 via-gray-800 to-gray-900 p-6 font-sans text-gray-300">

<div class="max-w-6xl mx-auto bg-gray-800 shadow-lg rounded-lg p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-semibold text-white flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7 text-blue-400">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a4 4 0 10-8 0v2M5 21h14a2 2 0 002-2v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2z" />
            </svg>
            Employee List
        </h2>
        <button id="open-create-modal" class="bg-blue-500 text-white px-4 py-2 rounded-lg flex items-center gap-1 hover:bg-blue-600 transition">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            Create Employee
        </button>
    </div>

    <!-- Employee Table -->
    <div class="overflow-x-auto">
        <table class="w-full rounded-lg overflow-hidden shadow-md text-gray-300">
            <thead>
                <tr class="bg-blue-500 text-white text-left text-sm">
                    <th class="px-3 py-2">ID</th>
                    <th class="px-3 py-2">Name</th>
                    <th class="px-3 py-2">Email</th>
                    <th class="px-3 py-2">Contact</th>
                    <th class="px-3 py-2">Gender</th>
                    <th class="px-3 py-2">Department</th>
                    <th class="px-3 py-2">Role</th>
                    <th class="px-3 py-2">Joining Date</th>
                    <th class="px-3 py-2">Action</th>
                </tr>
            </thead>
            <tbody class="text-gray-400 text-sm">
                @foreach($employees as $employee)
                <tr class="bg-gray-700 border-b border-gray-600 hover:bg-gray-600 transition">
                    <td class="px-3 py-2">{{ $employee->id }}</td>
                    <td class="px-3 py-2">{{ $employee->name }}</td>
                    <td class="px-3 py-2">{{ $employee->email }}</td>
                    <td class="px-3 py-2">{{ $employee->contact }}</td>
                    <td class="px-3 py-2">{{ $employee->gender }}</td>
                    <td class="px-3 py-2">{{ $employee->department }}</td>
                    <td class="px-3 py-2">{{ $employee->role->role }}</td>
                    <td class="px-3 py-2 text-center">{{ $employee->joining_date }}</td>
                    <td class="px-3 py-2">
                        <a href="{{ route('admin.employee.show', $employee->id) }}" class="bg-blue-400 text-white px-3 py-1 rounded-lg text-sm hover:bg-blue-500 transition">
                            Show
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal for Creating Employee -->
<div id="createEmployeeModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center transition-opacity">
    <div class="bg-gray-900 text-gray-300 p-6 rounded-lg shadow-xl w-96 transform scale-95 transition-transform">
        <h3 class="text-lg font-bold mb-4 text-white">Add Employee</h3>
        <div id="modal-content">
            <p>Loading...</p>
        </div>
        <button id="close-modal" class="mt-4 bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition">Close</button>
    </div>
</div>

<script>
    $(document).ready(function () {
        $("#open-create-modal").click(function (e) {
            e.preventDefault();
            $("#createEmployeeModal").removeClass("hidden").addClass("opacity-100 scale-100");

            $.ajax({
                url: "{{ route('admin.employee.create') }}", 
                type: "GET",
                success: function (response) {
                    $("#modal-content").html(response);
                },
                error: function () {
                    $("#modal-content").html("<p class='text-red-400'>Failed to load Create Employee form.</p>");
                }
            });
        });

        $("#close-modal").click(function () {
            $("#createEmployeeModal").addClass("hidden").removeClass("opacity-100 scale-100");
        });
    });
</script>

</body>
</html>
