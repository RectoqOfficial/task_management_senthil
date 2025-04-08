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
        <div class="overflow-x-auto w-full">
            <div id="task-list" class="max-w-6xl mx-auto bg-gray-800 shadow-lg rounded-lg p-4 md:p-6">
                <div class="min-w-full">
                    <table class="min-w-full table-fixed text-sm text-gray-300 border border-gray-600">
                        <thead>
                            <tr class="bg-purple-500 text-white text-left border-b border-gray-400">
                                <th class="px-3 py-2 border">ID</th>
                                <th class="px-3 py-2 border">Task Title</th>
                                <th class="px-3 py-2 border">Description</th>
                                <th class="px-3 py-2 border">Assigned To (Email)</th>
                                <th class="px-3 py-2 border">Status</th>
                                <th class="px-3 py-2 border">Start Date</th>
                                <th class="px-3 py-2 border">Deadline</th>
                                <th class="px-3 py-2 border">Total Days</th>
                                <th class="px-3 py-2 border">Redo Count</th>
                                <th class="px-3 py-2 border">Remarks</th>
                                <th class="px-3 py-2 border text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody id="task-table-body">
                            @foreach ($tasks as $task)
                                <tr id="task-row-{{ $task->id }}"
                                    class="bg-gray-800 border-b border-gray-500 hover:bg-gray-700 transition">
                                    <td class="px-3 py-2 border align-middle">{{ $task->id }}</td>
                                    <td class="px-3 py-2 border align-middle break-words truncate max-w-[150px]">
                                        {{ $task->task_title }}
                                    </td>
                                    <td class="px-3 py-2 border align-middle break-words truncate max-w-[200px]">
                                        {{ $task->description }}
                                    </td>
                                    <td class="px-3 py-2 border align-middle break-words truncate max-w-[200px]">
                                        {{ $task->employee->name }}<br>
                                        <small class="text-gray-300">{{ $task->employee->email }}</small>
                                    </td>
                                    <td class="px-3 py-2 border align-middle text-center">
                                        <div class="flex flex-col items-center gap-1">
                                            <span class="text-xs font-semibold">{{ $task->status }}</span>
                                            <select
                                                class="status-update-dropdown bg-gray-700 text-white border border-gray-400 px-2 py-1 rounded w-28 md:w-32 text-center"
                                                data-task-id="{{ $task->id }}">
                                                <option value="Pending" {{ $task->status == 'Pending' ? 'selected' : '' }}>
                                                    Pending</option>
                                                <option value="Redo" {{ $task->status == 'Redo' ? 'selected' : '' }}>Redo
                                                </option>
                                                <option value="Overdue" {{ $task->status == 'Overdue' ? 'selected' : '' }}>
                                                    Overdue</option>
                                                <option value="Completed" {{ $task->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td class="px-3 py-2 border align-middle">{{ $task->task_start_date }}</td>
                                    <td class="px-3 py-2 border align-middle">{{ $task->computed_deadline }}</td>
                                    <td class="px-3 py-2 border align-middle">{{ $task->total_days }}</td>
                                    <td class="px-3 py-2 border align-middle">{{ $task->redo_count }}</td>
                                    <td class="px-3 py-2 border align-middle break-words truncate max-w-[150px]">
                                        {{ $task->remarks }}
                                    </td>
                                    <td class="px-3 py-2 border align-middle text-center">
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
        </div>

        <!-- Modal for Creating Task -->
        <div id="taskModal"
            class="hidden fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center px-4">
            <div
                class="relative bg-gray-900 text-white p-4 rounded-xl shadow-xl w-full max-w-md mx-auto transition-transform transform scale-100">
                <h3 class="text-lg font-semibold mb-3">Create Task</h3>

                <div id="modal-body-content" class="text-sm">
                    <p class="text-gray-300 text-xs">Loading...</p>
                </div>

                <div id="task-success" class="hidden bg-green-600 text-white text-sm rounded p-2 my-2"></div>

                <button id="close-modal"
                    class="mt-4 bg-red-500 text-white px-3 py-1 text-sm rounded-lg hover:bg-red-600 transition">
                    Close
                </button>
            </div>
        </div>


        <!-- ✅ Toast placed here OUTSIDE the modal -->
        <div id="toast-success"
            class="fixed top-4 right-4 z-50 hidden bg-green-500 text-white px-4 py-2 rounded shadow-lg transition-opacity duration-300">
            Task created successfully!
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



        // auto sumbit

        // Check if the handler has already been initialized
        if (!window.statusUpdateEventAttached) {
            window.statusUpdateEventAttached = true; // ✅ Mark it as initialized

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
                            alert("Status updated successfully!"); // ✅ Show once per change
                        } else {
                            alert("Failed to update status.");
                        }
                    },
                    error: function () {
                        alert("Error updating status.");
                    }
                });
            });
        }







        $(document).on('change', '.status-update-dropdown', function () {
            const taskId = $(this).data('task-id');
            const newStatus = $(this).val();

            $.ajax({
                url: `/tasks/${taskId}/update-status`, // make sure this route exists
                type: 'POST',
                data: {
                    status: newStatus,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function (res) {
                    alert('Status updated');
                }
            });
        });

    </script>

</body>

</html>