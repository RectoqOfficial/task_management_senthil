<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Scoreboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>
<body class="bg-black text-white p-4 sm:p-6">
<div class="max-w-6xl mx-auto bg-gray-800 shadow-lg rounded-lg p-6">
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 mb-6">
        <h2 class="text-2xl sm:text-3xl font-semibold text-white">Employee Details</h2>
        <button id="open-create-modal" class="bg-purple-500 text-white px-4 py-2 rounded-lg text-sm sm:text-base flex items-center gap-1 hover:bg-purple-600 transition">
            Create Employee
        </button>
    </div>
<!-- nice -->
    <div class="overflow-x-auto w-full">
    <table class="min-w-[600px] w-full border border-gray-600 text-white text-sm sm:text-base text-center">

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
                <tbody id="employeeTableBody">
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
    <form class="delete-employee-form" data-url="{{ route('admin.employee.destroy', $employee->id) }}">
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
<div id="createEmployeeModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4">
    <div class="bg-gray-800 text-gray-100 p-4 sm:p-6 rounded-lg shadow-xl w-full max-w-md mx-auto">

        <h3 class="text-lg font-bold mb-2 text-white">Add Employee</h3>
        <div id="modal-content">
            <p class="text-gray-200">Loading...</p>
        </div>
        <button id="close-modal" class="mt-2 bg-red-500 text-white px-3 py-1 rounded-lg hover:bg-red-600 transition">
            Close
        </button>
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



        // delete
        $(document).on('submit', '.delete-employee-form', function (e) {
    e.preventDefault();

    var form = $(this);
    var url = form.data('url');
    var row = form.closest('tr');

    if (confirm("Are you sure you want to delete this employee?")) {
        $.ajax({
            url: url,
            type: "DELETE",
            headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
            success: function (response) {
                console.log(response); // Debug success response
                
                if (response.success) {
                    row.fadeOut(300, function () { $(this).remove(); });
                } else {
                    alert("Failed to delete employee: " + response.message);
                }
            },
            error: function (xhr) {
                console.log(xhr.responseText); // Debugging error response
                
                try {
                    var errorResponse = JSON.parse(xhr.responseText);
                    alert("Error: " + errorResponse.message);
                } catch (e) {
                    alert("An unknown error occurred.");
                }
            }
        });
    }
});
    </script>
</body>
</html>
