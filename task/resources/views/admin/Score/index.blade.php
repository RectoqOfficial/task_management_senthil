<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
    <h2>Task List</h2>
    <a href="{{ url('/score/create') }}" class="btn btn-primary mb-3">Create Task</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Task ID</th>
                <th>Employee ID</th>
                <th>Status</th>
                <th>Rework Count</th>
                <th>Overdue</th>
                <th>Remarks</th>
                <th>Score</th>
            </tr>
        </thead>
        <tbody>
            <!-- Table will be empty -->
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
