<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Task</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to right, #6a11cb, #2575fc);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px;
            
        }
        
        .container {
            background: white;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
          
            width: 100%;
        }
        .form-group label {
            font-weight: 600;
            font-size: 14px;
            color: #333;
            margin-bottom: 2px;
        }
        .form-control {
            border-radius: 6px;
            padding: 6px;
            font-size: 14px;
        }
        .btn-success {
            background: #28a745;
            border-radius: 6px;
            padding: 8px;
            font-size: 14px;
            border: none;
        }
        .btn-success:hover {
            background: #218838;
        }
    </style>
</head>
<body>

<!-- Task Form -->
<div class="w-full max-w-lg bg-gray-900 text-white shadow-xl rounded-lg p-3">
    <h2 class="text-sm font-bold mb-2 text-white text-center flex items-center justify-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-blue-400">
            <path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a4 4 0 10-8 0v2M5 21h14a2 2 0 002-2v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2z" />
        </svg>
        Create Task
    </h2>

    <form id="task-form" action="{{ route('admin.tasks.store') }}" method="POST" class="space-y-1">
        @csrf

        <div>
            <label class="block text-xs font-medium text-gray-300 mb-1">Task Title:</label>
            <input type="text" name="task_title" class="w-full border border-gray-500 rounded-lg p-1 bg-gray-700 text-white focus:ring focus:ring-blue-400" required>
        </div>

        <div>
            <label class="block text-xs font-medium text-gray-300 mb-1">Description:</label>
            <textarea name="description" class="w-full border border-gray-500 rounded-lg p-1 bg-gray-700 text-white focus:ring focus:ring-blue-400" rows="1" required></textarea>
        </div>

        <div>
            <label class="block text-xs font-medium text-gray-300 mb-1">Assign To:</label>
            <select name="employee_id" class="w-full border border-gray-500 rounded-lg p-1 bg-gray-700 text-white focus:ring focus:ring-blue-400" required>
                <option value="">Select Employee</option>
                @foreach ($employees as $employee)
                    <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                @endforeach
            </select>
        </div>


        <div>
            <label class="block text-xs font-medium text-gray-300 mb-1">Total Days:</label>
            <input type="number" name="total_days" class="w-full border border-gray-500 rounded-lg p-1 bg-gray-700 text-white focus:ring focus:ring-blue-400" required>
        </div>

        <div>
            <label class="block text-xs font-medium text-gray-300 mb-1">Remarks:</label>
            <textarea name="remarks" class="w-full border border-gray-500 rounded-lg p-1 bg-gray-700 text-white focus:ring focus:ring-blue-400" rows="1"></textarea>
        </div>

        <button type="submit" class="w-full bg-purple-500 text-white w-full py-2 rounded hover:bg-purple-600 transition">
            Create Task
        </button>


    </form>
<!-- ADD SUCCESS MESSAGE HERE -->
<div id="task-success" class="hidden bg-green-600 text-white text-sm rounded p-2 my-2 text-center">
    Task created successfully!
</div>

</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('#task-form').on('submit', function (e) {
            e.preventDefault(); // 🚫 Prevent page reload

            let form = $(this);
            let formData = form.serialize();
            let actionUrl = form.attr('action');

            $.ajax({
                url: actionUrl,
                method: 'POST',
                data: formData,
                success: function (response) {
                    // ✅ Show success message
                    $('#task-success').removeClass('hidden').text('Task created successfully!');

                    // ✅ Reset form fields
                    $('#task-form')[0].reset();

                    // ✅ Optional: Auto-hide message after 3 seconds
                    setTimeout(function () {
                        $('#task-success').addClass('hidden');
                    }, 3000);

                    // ✅ Add new task to the top of task list dynamically
                    $('#task-list tbody').prepend(`
                        <tr class="bg-gray-800 border-b border-gray-500 hover:bg-gray-700 transition">
                            <td class="px-3 py-2 border border-gray-400 text-gray-100">${response.task.id}</td>
                            <td class="px-3 py-2 border border-gray-400 text-gray-100">${response.task.task_title}</td>
                            <td class="px-3 py-2 border border-gray-400 text-gray-100">${response.task.description}</td>
                            <td class="px-3 py-2 border border-gray-400 text-gray-100">
                                ${response.task.employee_name}<br>
                                <small>${response.task.employee_email}</small>
                            </td>
                            <td class="px-3 py-2 border border-gray-400 text-gray-100">${response.task.status}</td>
                            <td class="px-3 py-2 border border-gray-400 text-gray-100">${response.task.task_start_date}</td>
                            <td class="px-3 py-2 border border-gray-400 text-gray-100">${response.task.deadline}</td>
                            <td class="px-3 py-2 border border-gray-400 text-gray-100">${response.task.total_days}</td>
                            <td class="px-3 py-2 border border-gray-400 text-gray-100">${response.task.redo_count ?? 0}</td>
                            <td class="px-3 py-2 border border-gray-400 text-gray-100">${response.task.remarks ?? ''}</td>
                            <td class="px-3 py-2 border border-gray-400 text-center">
                                <button class="delete-task bg-red-500 text-white px-2 py-1 rounded-lg hover:bg-red-600 transition" data-id="${response.task.id}">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    `);
                },
                error: function (xhr) {
                    alert('Task creation failed.');
                }
            });
        });
    });
</script>



</body>
</html>

<!-- one -->