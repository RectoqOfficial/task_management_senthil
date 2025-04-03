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
            max-width: 500px;
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
<div class="container">
    <h5 class="text-center text-primary fw-bold text-sm mb-1">Create Task</h5>
    <form id="task-form" action="{{ route('admin.tasks.store') }}" method="POST">
        @csrf

        <div class="space-y-1 text-sm">
            <div>
                <label for="task_title" class="text-xs">Task Title</label>
                <input type="text" name="task_title" class="form-control py-1 text-xs" required>
            </div>

            <div>
                <label for="description" class="text-xs">Description</label>
                <textarea name="description" class="form-control py-1 text-xs" rows="1" required></textarea>
            </div>

            <div>
                <label for="employee_id" class="text-xs">Assign To</label>
                <select name="employee_id" class="form-control py-1 text-xs" required>
                    <option value="">Select Employee</option>
                    @foreach ($employees as $employee)
                        <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="status" class="text-xs">Status</label>
                <select name="status" class="form-control py-1 text-xs" required>
                    <option value="Pending">Pending</option>
                    <option value="In Progress">In Progress</option>
                    <option value="Completed">Completed</option>
                </select>
            </div>

            <div class="row">
                <div class="col-6">
                    <label for="deadline" class="text-xs">Deadline</label>
                    <input type="date" name="deadline" class="form-control py-1 text-xs" required>
                </div>
                <div class="col-6">
                    <label for="task_start_date" class="text-xs">Start Date</label>
                    <input type="date" name="task_start_date" class="form-control py-1 text-xs" required>
                </div>
            </div>

            <div>
                <label for="total_days" class="text-xs">Total Days</label>
                <input type="number" name="total_days" class="form-control py-1 text-xs" required>
            </div>

            <div>
                <label for="remarks" class="text-xs">Remarks</label>
                <textarea name="remarks" class="form-control py-1 text-xs" rows="1"></textarea>
            </div>
        </div>

        <button type="submit" class="btn btn-success w-100 text-xs mt-1 py-1">Create Task</button>
    </form>
</div>
</body>
</html>

<!-- one -->