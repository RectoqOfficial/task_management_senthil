<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task List</title>
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
            padding: 20px;
        }
        .container {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            width: 90%;
            max-width: 900px;
        }
        .table-container {
            max-height: 400px;
            overflow-y: auto;
        }
        thead {
            background-color: #343a40;
            color: white;
        }
        .status-badge {
            font-size: 14px;
            padding: 5px 10px;
            border-radius: 5px;
        }
        .status-pending { background-color: #ffc107; color: #212529; }
        .status-inprogress { background-color: #17a2b8; color: white; }
        .status-completed { background-color: #28a745; color: white; }
    </style>
</head>
<body>

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0 text-primary fw-bold">Task List</h2>
        <button id="load-create-task" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#taskModal">+ Create Task</button>
    </div>

    <div class="table-container">
        <table class="table table-bordered table-hover text-center">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Task Title</th>
                    <th>Description</th>
                    <th>Assigned To</th>
                    <th>Status</th>
                    <th>Deadline</th>
                    <th>Total Days</th>

                    <th>Remarks</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                    <tr>
                        <td>{{ $task->id }}</td>
                        <td>{{ $task->task_title }}</td>
                        <td>{{ $task->description }}</td>
                        <td>{{ $task->employee->name }}</td>
                        <td>
                            <span class="status-badge 
                                {{ $task->status == 'Pending' ? 'status-pending' : 
                                ($task->status == 'In Progress' ? 'status-inprogress' : 
                                'status-completed') }}">
                                {{ $task->status }}
                            </span>
                        </td>
                        <td>{{ $task->deadline }}</td>
                        <td>{{ $task->total_days }}</td>

                        <td>{{ $task->remarks }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Bootstrap Modal for Create Task Form -->
<div class="modal fade" id="taskModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Create Task</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body" id="modal-body-content">
        <!-- Form will be loaded here via AJAX -->
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function () {
        $("#load-create-task").click(function (e) {
            e.preventDefault();

            $.ajax({
                url: "{{ route('admin.tasks.create') }}", 
                type: "GET",
                success: function (response) {
                    $("#modal-body-content").html(response);
                },
                error: function () {
                    alert("Failed to load Create Task form.");
                }
            });
        });

        // Handle Task Form Submission via AJAX
        $(document).on("submit", "#task-form", function (e) {
            e.preventDefault();

            let formData = $(this).serialize();

            $.ajax({
                url: "{{ route('admin.tasks.store') }}",
                type: "POST",
                data: formData,
                success: function (response) {
                    alert("Task Created Successfully!");
                    $("#taskModal").modal("hide");
                    location.reload();
                },
                error: function () {
                    alert("Error creating task.");
                }
            });
        });
    });
</script>

</body>
</html>
