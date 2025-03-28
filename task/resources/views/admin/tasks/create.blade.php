<!DOCTYPE html>
<html>
<head>
    <title>Create Task</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2>Create Task</h2>
        <form action="{{ route('admin.tasks.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="task_title">Task Title</label>
                <input type="text" name="task_title" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <label for="employee_id">Assign To</label>
                <select name="employee_id" class="form-control" required>
                    @foreach ($employees as $employee)
                        <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" class="form-control" required>
                    <option value="Pending">Pending</option>
                    <option value="Ongoing">Ongoing</option>
                    <option value="Completed">Completed</option>
                </select>
            </div>
            <div class="form-group">
                <label for="deadline">Deadline</label>
                <input type="date" name="deadline" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="task_start_date">Task Start Date</label>
                <input type="date" name="task_start_date" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="total_days">Total Days</label>
                <input type="number" name="total_days" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="remarks">Remarks</label>
                <textarea name="remarks" class="form-control"></textarea>
            </div>
            <button type="submit" class="btn btn-success">Create Task</button>
        </form>
    </div>
</body>
</html>