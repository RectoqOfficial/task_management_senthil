<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task List</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="bg-gradient-to-r from-gray-900 via-gray-800 to-gray-900 p-6 font-sans text-gray-300">

    <div class="max-w-6xl mx-auto bg-gray-800 shadow-lg rounded-lg p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-3xl font-semibold text-white flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-7 h-7 text-blue-400">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M17 9V7a4 4 0 10-8 0v2M5 21h14a2 2 0 002-2v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2z" />
                </svg>
                Task List
            </h2>
            <button id="load-create-task"
                class="bg-purple-500 text-white px-4 py-2 rounded-lg flex items-center gap-1 hover:bg-purple-600 transition">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Create Task
            </button>
        </div>

        <div class="max-w-6xl mx-auto bg-gray-800 shadow-lg rounded-lg p-6">
            <div class="overflow-x-auto">
                <table
                    class="max-w-4xl mx-auto rounded-lg overflow-hidden shadow-md text-gray-300 border border-gray-600">
                    <thead>
                        <tr class="bg-purple-500 text-white text-left text-sm border-b border-gray-400">
                            <th class="px-3 py-2 border border-gray-400">ID</th>
                            <th class="px-3 py-2 border border-gray-400">Task Title</th>
                            <th class="px-3 py-2 border border-gray-400">Description</th>
                            <th class="px-3 py-2 border border-gray-400">Assigned To (Email)</th>
                            <th class="px-3 py-2 border border-gray-400">Status</th>
                            <th class="px-3 py-2 border border-gray-400">Start Date</th>
                            <th class="px-3 py-2 border border-gray-400">Deadline</th>
                            <th class="px-3 py-2 border border-gray-400">Total Days</th>
                            <th class="px-3 py-2 border border-gray-400">Redo Count</th> <!-- New Column -->
                            <th class="px-3 py-2 border border-gray-400">Remarks</th>
                            <th class="px-3 py-2 border border-gray-400 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tasks as $task)
                            <tr id="task-row-{{ $task->id }}"
                                class="bg-gray-800 border-b border-gray-500 hover:bg-gray-700 transition">
                                <td class="px-3 py-2 border border-gray-400 text-gray-100">{{ $task->id }}</td>
                                <td class="px-3 py-2 border border-gray-400 text-gray-100">{{ $task->task_title }}</td>
                                <td class="px-3 py-2 border border-gray-400 text-gray-100">{{ $task->description }}</td>
                                <td class="px-3 py-2 border border-gray-400 text-gray-100">
                                    {{ $task->employee->name }} <br>
                                    <small class="text-gray-300">{{ $task->employee->email }}</small>
                                </td>
                                <td class="px-3 py-2 border border-gray-400 text-gray-100 text-center">
                                    <div class="flex flex-col items-center">
                                        <!-- View Current Status -->
                                        <span class="text-sm font-semibold text-white mb-1">{{ $task->status }}</span>

                                        <!-- Dropdown to Change Status (Auto-Submit) -->
                                        <select
                                            class="status-update-dropdown bg-gray-700 text-white border border-gray-400 px-2 py-1 rounded w-32 text-center"
                                            data-task-id="{{ $task->id }}">
                                           
                                        
                                            
                                            <option value="Redo" {{ $task->status == 'Redo' ? 'selected' : '' }}>Redo</option>
                                            <option value="Overdue" {{ $task->status == 'Overdue' ? 'selected' : '' }}>Overdue
                                            </option>
                                            <option value="Completed" {{ $task->status == 'Completed' ? 'selected' : '' }}>
                                                Completed</option>
                                        </select>
                                    </div>
                                </td>
                                <td class="px-3 py-2 border border-gray-400 text-gray-100">{{ $task->task_start_date }}</td>
                                <td class="px-3 py-2 border border-gray-400 text-gray-100">{{ $task->computed_deadline }}
                                </td>
                                <td class="px-3 py-2 border border-gray-400 text-gray-100">{{ $task->total_days }}</td>
                                <td class="px-3 py-2 border border-gray-400 text-gray-100 text-center">
                                    <div class="flex items-center space-x-2">
                                        <input type="number"
                                            class="redo-count-update bg-gray-700 text-white border border-gray-400 px-2 py-1 rounded w-16 text-center"
                                            value="{{ $task->redo_count }}" data-task-id="{{ $task->id }}">

                                        <button
                                            class="update-redo-btn bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded"
                                            data-task-id="{{ $task->id }}">
                                            <i class="bi bi-save"></i> <!-- Bootstrap save icon -->
                                        </button>
                                    </div>
                                </td>
                                <td class="px-3 py-2 border border-gray-400 text-gray-100">{{ $task->remarks }}</td>
                                <td class="px-3 py-2 border border-gray-400 text-center">
                                    <button
                                        class="delete-task bg-red-500 text-white px-2 py-1 rounded-lg hover:bg-red-600 transition"
                                        data-id="{{ $task->id }}">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>   
            </div>
        </div>

        <!-- Modal for Creating Task -->
        <div id="taskModal"
            class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center transition-opacity">
            <div class="bg-gray-900 text-white p-3 rounded-lg shadow-xl w-96 transform scale-95 transition-transform">
                <h3 class="text-sm font-bold mb-2 text-white">Create Task</h3>
                <div id="modal-body-content">
                    <p class="text-gray-300 text-xs">Loading...</p>
                </div>
                <button id="close-modal"
                    class="mt-2 bg-red-500 text-white px-2 py-1 text-xs rounded-lg hover:bg-red-600 transition">
                    Close
                </button>
            </div>
        </div>


        <script>
            
            // Model
            $(document).ready(function () {
                $("#load-create-task").click(function (e) {
                    e.preventDefault();
                    $("#taskModal").removeClass("hidden").addClass("opacity-100 scale-100");

                    $.ajax({
                        url: "{{ route('admin.tasks.create') }}",
                        type: "GET",
                        success: function (response) {
                            $("#modal-body-content").html(response);
                        },
                        error: function () {
                            $("#modal-body-content").html("<p class='text-red-400'>Failed to load Create Task form.</p>");
                        }
                    });
                });

                $("#close-modal").click(function () {
                    $("#taskModal").addClass("hidden").removeClass("opacity-100 scale-100");
                });
            });



            // delete

            $(document).ready(function () {
                $(".delete-task").click(function () {
                    let taskId = $(this).data("id");

                    if (!confirm("Are you sure you want to delete this task?")) {
                        return;
                    }

                    $.ajax({
                        url: "/admin/tasks/" + taskId,  // Laravel route to delete the task
                        type: "DELETE",
                        data: {
                            _token: "{{ csrf_token() }}"  // CSRF token for security
                        },
                        success: function (response) {
                            alert("Task deleted successfully!");
                            $("#task-row-" + taskId).fadeOut(500, function () { $(this).remove(); });
                        },
                        error: function () {
                            alert("Failed to delete the task.");
                        }
                    });
                });
            });

            // redo count

            $(document).on("click", ".update-redo-btn", function () {
                let taskId = $(this).data("task-id");
                let newRedoCount = $(this).closest("td").find(".redo-count-update").val(); // Get the updated redo_count
                let csrfToken = $('meta[name="csrf-token"]').attr("content"); // Get CSRF token from meta tag

                $.ajax({
                    url: `/tasks/update-redo/${taskId}`, // Your route for updating redo_count
                    type: "PUT",
                    data: {
                        redo_count: newRedoCount,
                        _token: csrfToken
                    },
                    success: function (response) {
                        console.log(response);
                        alert(response.success); // Show success message
                        LoadMyTask(); // Refresh task list
                    },
                    error: function (xhr) {
                        console.error(xhr.responseText);
                        alert("Failed to update redo count. Check console for details.");
                    }
                });
            });


            // auto sumbit

            $(document).on("change", ".status-update-dropdown", function () {
    let taskId = $(this).data("task-id");
    let newStatus = $(this).val();

    $.ajax({
        url: "{{ route('tasks.updateStatus') }}",
        type: "POST",
        data: {
            _token: "{{ csrf_token() }}",
            task_id: taskId,
            status: newStatus
        },
        success: function (response) {
            if (response.success) {
                alert("Status updated successfully!");
            } else {
                alert("Failed to update status.");
            }
        },
        error: function () {
            alert("Error updating status.");
        }
    });
});

        </script>

</body>

</html>