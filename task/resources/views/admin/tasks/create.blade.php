<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Task</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to right, #6a11cb, #2575fc);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px;
            margin-left: 120px;
            
        } */
    </style>
</head>

<body>

    <!-- Task Form Container -->
    <div class="w-full max-w-lg bg-gray-900 text-white shadow-xl rounded-lg p-5">
        <h2 class="text-lg font-semibold mb-4 text-white text-center flex items-center justify-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                stroke="currentColor" class="w-5 h-5 text-blue-400">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M17 9V7a4 4 0 10-8 0v2M5 21h14a2 2 0 002-2v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2z" />
            </svg>
            Create Task
        </h2> 

        <form id="task-form" action="{{ route('admin.tasks.store') }}" method="POST" class="space-y-2 text-xs">
    @csrf

    <div>
        <label class="block text-[10px] font-medium text-gray-300 mb-0.5">Task Title:</label>
        <input type="text" name="task_title"
            class="w-full border border-gray-600 rounded-lg p-1.5 bg-gray-800 text-white focus:outline-none focus:ring-2 focus:ring-purple-500"
            required>
    </div>

    <div>
        <label class="block text-[10px] font-medium text-gray-300 mb-0.5">Description:</label>
        <textarea name="description"
            class="w-full border border-gray-600 rounded-lg p-1.5 bg-gray-800 text-white focus:outline-none focus:ring-2 focus:ring-purple-500"
            rows="2" required></textarea>
    </div>

    <div>
        <label class="block text-[10px] font-medium text-gray-300 mb-0.5">Assign To:</label>
        <select name="employee_id"
            class="w-full border border-gray-600 rounded-lg p-1.5 bg-gray-800 text-white focus:outline-none focus:ring-2 focus:ring-purple-500"
            required>
            <option value="">Select Employee</option>
            @foreach ($employees as $employee)
                <option value="{{ $employee->id }}">{{ $employee->name }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label class="block text-[10px] font-medium text-gray-300 mb-0.5">Total Days:</label>
        <input type="number" name="total_days"
            class="w-full border border-gray-600 rounded-lg p-1.5 bg-gray-800 text-white focus:outline-none focus:ring-2 focus:ring-purple-500"
            required>
    </div>

    <div>
        <label class="block text-[10px] font-medium text-gray-300 mb-0.5">Remarks:</label>
        <textarea name="remarks"
            class="w-full border border-gray-600 rounded-lg p-1.5 bg-gray-800 text-white focus:outline-none focus:ring-2 focus:ring-purple-500"
            rows="1"></textarea>
    </div>

    <button type="submit"
        class="w-full bg-purple-600 text-white py-1.5 text-xs rounded-lg hover:bg-purple-700 transition duration-200">
        Create Task
    </button>
</form>

    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#task-form').on('submit', function (e) {
                e.preventDefault();

                const form = $(this);
                const formData = form.serialize();
                const actionUrl = form.attr('action');

                $.ajax({
                    url: actionUrl,
                    method: 'POST',
                    data: formData,
                    success: function (response) {
                        const task = response.task;

                        // Append new task row to the table
                        $('#task-table-body').append(`
    <tr class="bg-gray-800 border-b min-w-full border-gray-500 hover:bg-gray-700 transition align-middle">
        <td class="px-3 py-2 border align-middle">${task.id}</td>
        <td class="px-3 py-2 border align-middle break-words truncate max-w-[150px]">${task.task_title}</td>
        <td class="px-3 py-2 border align-middle break-words truncate max-w-[200px]">${task.description}</td>
        <td class="px-3 py-2 border align-middle break-words truncate max-w-[200px]">
            ${task.employee_name}<br>
            <small class="text-gray-300">${task.employee_email}</small>
        </td>
        <td class="px-3 py-2 border align-middle text-center">
            <div class="flex flex-col items-center gap-1">
                <span class="text-xs font-semibold">${task.status}</span>
                <select
                    class="status-update-dropdown bg-gray-700 text-white border border-gray-400 px-2 py-1 rounded w-28 md:w-32 text-center"
                    data-task-id="${task.id}">
                    <option value="Pending" ${task.status === 'Pending' ? 'selected' : ''}>Pending</option>
                    <option value="Redo" ${task.status === 'Redo' ? 'selected' : ''}>Redo</option>
                    <option value="Overdue" ${task.status === 'Overdue' ? 'selected' : ''}>Overdue</option>
                    <option value="Completed" ${task.status === 'Completed' ? 'selected' : ''}>Completed</option>
                </select>
            </div>
        </td>
        <td class="px-3 py-2 border align-middle">${task.task_start_date}</td>
        <td class="px-3 py-2 border align-middle">${task.deadline}</td>
        <td class="px-3 py-2 border align-middle">${task.total_days}</td>
        <td class="px-3 py-2 border align-middle">${task.redo_count ?? 0}</td>
        <td class="px-3 py-2 border align-middle break-words truncate max-w-[150px]">${task.remarks ?? ''}</td>
        <td class="px-3 py-2 border align-middle text-center">
            <button class="delete-task bg-red-500 text-white px-2 py-1 rounded-lg hover:bg-red-600 transition" data-id="${task.id}">
                Delete
            </button>
        </td>
    </tr>
`);

                        // Reset form
                        form[0].reset();

                        // Show success message
                        $('#task-success')
                            .text('Task created successfully!')
                            .removeClass('hidden')
                            .hide()
                            .fadeIn()
                            .delay(2000)
                            .fadeOut();

                        // Close modal after short delay
                        setTimeout(() => {
                            $('#taskModal').addClass('hidden');
                        }, 800);
                    },
                    error: function (xhr) {
                        console.error(xhr.responseText);
                        const errorMsg = xhr.responseJSON?.message || 'An error occurred.';
                        alert('Error creating task:\n' + errorMsg);
                    }
                });
            });

            // Close modal
            $('#close-modal').on('click', function () {
                $('#taskModal').addClass('hidden');
            });
        });
    </script>



</body>

</html>