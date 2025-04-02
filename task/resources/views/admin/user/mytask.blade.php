<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Tasks</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- jQuery for AJAX -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap Icons (optional) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
</head>
<body class="bg-gray-900 text-white">

    <div class="container mx-auto p-6">
        <h2 class="text-2xl font-bold mb-4">My Tasks</h2>

        <!-- Button to Load Tasks -->
        <a href="#" id="myTasksBtn" class="flex items-center px-4 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 transition text-white">
            <i class="bi bi-list-task mr-2"></i> Load My Tasks
        </a>

        <!-- Task Table -->
        <div class="overflow-x-auto mt-4">
            <table class="w-full rounded-lg overflow-hidden shadow-md text-gray-300 border border-gray-600">
                <thead>
                    <tr class="bg-purple-500 text-white text-left text-sm border-b border-gray-400">
                        <th class="px-3 py-2 border border-gray-400">ID</th>
                        <th class="px-3 py-2 border border-gray-400">Task Title</th>
                        <th class="px-3 py-2 border border-gray-400">Description</th>
                        <th class="px-3 py-2 border border-gray-400">Status</th>
                        <th class="px-3 py-2 border border-gray-400">Start Date</th>
                        <th class="px-3 py-2 border border-gray-400">Deadline</th>
                        <th class="px-3 py-2 border border-gray-400">Total Days</th>
                        <th class="px-3 py-2 border border-gray-400">Remarks</th>
                    </tr>
                </thead>
                <tbody id="task-table-body">
                    <!-- Tasks will be dynamically inserted here -->
                </tbody>
            </table>
        </div>
    </div>

    <script>
    
        $(document).ready(function () {
            $("#myTasksBtn").on("click", function (event) {
                event.preventDefault(); // Prevent page reload
                LoadMyTask(); // Load tasks dynamically
            });
        });

        function LoadMyTask() {
    let url = $("#myTasksBtn").data("url"); // Get route from button attribute

    $.ajax({
        url: url, // Dynamic route
        type: "GET",
        dataType: "json",
        success: function (tasks) {
            console.log("✅ Tasks received:", tasks); // Debugging

            let rows = '';
            if (tasks.length > 0) {
                tasks.forEach(task => {
                    console.log("Adding task to table:", task); // Debugging
                    rows += `
                        <tr class="bg-gray-800 border-b border-gray-500 hover:bg-gray-700 transition">
                            <td class="px-3 py-2 border border-gray-400 text-gray-100">${task.id}</td>
                            <td class="px-3 py-2 border border-gray-400 text-gray-100">${task.task_title}</td>
                            <td class="px-3 py-2 border border-gray-400 text-gray-100">${task.description}</td>
                            <td class="px-3 py-2 border border-gray-400 text-gray-100">${task.status}</td>
                            <td class="px-3 py-2 border border-gray-400 text-gray-100">${task.task_start_date}</td>
                            <td class="px-3 py-2 border border-gray-400 text-gray-100">${task.computed_deadline}</td>
                            <td class="px-3 py-2 border border-gray-400 text-gray-100">${task.total_days}</td>
                            <td class="px-3 py-2 border border-gray-400 text-gray-100">${task.remarks}</td>
                        </tr>
                    `;
                });
            } else {
                console.warn("⚠️ No tasks found!");
                rows = `<tr><td colspan="8" class="text-center text-gray-400">No tasks found.</td></tr>`;
            }

            $("#task-table-body").html(rows); // Inject tasks into the table
            console.log("✅ Table updated!");
        },
        error: function (xhr, status, error) {
            console.error("❌ Error fetching tasks:", xhr.responseText);
            alert("Failed to load tasks. Check console for details.");
        }
    });
}
                
    </script>

</body>
</html>
