<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Task</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
    <h2>Create Task</h2>
    <form action="#" method="POST">
        <div class="mb-3">
            <label for="employee_id" class="form-label">Employee ID</label>
            <input type="number" class="form-control" name="employee_id" required>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-control" name="status">
                <option value="pending">Pending</option>
                <option value="in_progress">In Progress</option>
                <option value="completed">Completed</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="rework_count" class="form-label">Rework Count</label>
            <input type="number" class="form-control" name="rework_count" value="0">
        </div>

        <div class="mb-3">
            <label for="overdue" class="form-label">Overdue</label>
            <select class="form-control" name="overdue">
                <option value="0">No</option>
                <option value="1">Yes</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="remarks" class="form-label">Remarks</label>
            <textarea class="form-control" name="remarks"></textarea>
        </div>

        <div class="mb-3">
            <label for="score" class="form-label">Score</label>
            <input type="number" class="form-control" name="score" min="0" max="100">
        </div>

        <button type="submit" class="btn btn-success">Create Task</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
