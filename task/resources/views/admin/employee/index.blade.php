<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Scoreboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="bg-black text-white p-6">
    <div class="max-w-6xl mx-auto bg-gray-800 shadow-lg rounded-lg p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-3xl font-semibold text-white">Employee Scoreboard</h2>
            <button id="open-create-modal" class="bg-purple-500 text-white px-4 py-2 rounded-lg flex items-center gap-1 hover:bg-purple-600 transition">
                Create Employee
            </button>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full border border-gray-600 text-white text-center">
                <thead>
                    <tr class="bg-purple-600 text-white text-sm">
                        <th class="border border-gray-600 p-2">ID</th>
                        <th class="border border-gray-600 p-2">Name</th>
                        <th class="border border-gray-600 p-2">Email</th>
                        <th class="border border-gray-600 p-2">Contact</th>
                        <th class="border border-gray-600 p-2">Department</th>
                        <th class="border border-gray-600 p-2">Role</th>
                        <th class="border border-gray-600 p-2">Joining Date</th>
                        <th class="border border-gray-600 p-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($employees as $employee)
                    <tr class="bg-gray-900 hover:bg-gray-700">
                        <td class="border border-gray-600 p-2">{{ $employee->id }}</td>
                        <td class="border border-gray-600 p-2">{{ $employee->name }}</td>
                        <td class="border border-gray-600 p-2">{{ $employee->email }}</td>
                        <td class="border border-gray-600 p-2">{{ $employee->contact }}</td>
                        <td class="border border-gray-600 p-2">{{ $employee->department }}</td>
                        <td class="border border-gray-600 p-2">{{ $employee->role->role }}</td>
                        <td class="border border-gray-600 p-2">{{ $employee->joining_date }}</td>
                        <td class="border border-gray-600 p-2">
                            <form action="{{ route('admin.employee.destroy', $employee->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded-lg hover:bg-red-600 transition">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


<!-- Modal for Creating Employee -->
<div id="createEmployeeModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-gray-900 text-gray-300 p-4 rounded-lg shadow-xl w-80 max-h-48 flex flex-col justify-center items-center">
        <h3 class="text-lg font-bold mb-2">Add Employee</h3>
        <div id="modal-content">
            <p>Loading...</p>
        </div>
        <button id="close-modal" class="mt-2 bg-red-500 text-white px-3 py-1 rounded-lg hover:bg-red-600 transition">Close</button>
    </div>
</div>



    <script>
        $(document).ready(function () {
            $("#open-create-modal").click(function (e) {
                e.preventDefault();
                $("#createEmployeeModal").removeClass("hidden");
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
                $("#createEmployeeModal").addClass("hidden");
            });

            $(document).on('submit', '#createEmployeeForm', function (e) {
                e.preventDefault();
                var formData = $(this).serialize();
                $.ajax({
                    url: "{{ route('admin.employee.store') }}",
                    type: "POST",
                    data: formData,
                    success: function (response) {
                        if (response.success) {
                            alert(response.message);
                            $('#createEmployeeForm')[0].reset();
                            $("#createEmployeeModal").addClass("hidden");
                        } else {
                            alert('There was an issue creating the employee.');
                        }
                    },
                    error: function (xhr) {
                        var errors = xhr.responseJSON.errors;
                        var errorMessages = '';
                        $.each(errors, function (key, value) {
                            errorMessages += '<p class="text-red-400">' + value + '</p>';
                        });
                        $("#modal-content").html(errorMessages);
                    }
                });
            });
        });
    </script>
</body>
</html>
