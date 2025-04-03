<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Dashboard</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- jQuery for AJAX -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-gray-100 flex">

    <!-- Sidebar -->
    <div class="w-64 min-h-screen bg-gradient-to-b from-blue-800 to-blue-900 text-white p-5 shadow-lg">
        <div class="text-center mb-6">
            <h2 class="text-lg font-semibold">Employee Dashboard</h2>
        </div>
        <nav class="space-y-2">
            <!-- My Profile Button -->
            <button id="myProfileBtn" class="flex items-center px-4 py-2 bg-blue-500 rounded-lg hover:bg-blue-700 transition">
                <i class="bi bi-person mr-2"></i> My Profile
            </button>

            <!-- My Tasks Button -->
            <a href="#" id="myTasksBtn" data-url="{{ route('user.mytask.view') }}" 
                class="flex items-center px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                <i class="bi bi-list-task mr-2"></i> My Tasks
            </a>

            <a href="#" class="flex items-center px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                <i class="bi bi-trophy mr-2"></i> My Score Board
            </a>

            <!-- Logout Form -->
            <form action="{{ route('employee.logout') }}" method="POST" class="mt-6">
                @csrf
                <button type="submit" class="w-full flex items-center px-4 py-2 rounded-lg bg-red-600 hover:bg-red-700 transition">
                    <i class="bi bi-box-arrow-right mr-2"></i> Logout
                </button>
            </form>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="flex-1 p-10">
        <div class="bg-white shadow-lg rounded-lg p-6">
            <h2 class="text-2xl font-bold text-gray-700 text-center">Welcome, {{ Auth::guard('employee')->user()->name }}!</h2>
            <p class="text-gray-600 text-center mt-2">Manage your tasks and performance here.</p>

            <!-- Profile Container -->
            <div id="profileContainer" class="mt-4"></div>

            <!-- Task Container -->
            <div id="taskContainer"></div>
        </div>
    </div>

    <!-- JavaScript for AJAX -->
    <script>
        $(document).ready(function () {
            // Load Profile
            $("#myProfileBtn").on("click", function () {
                fetch("{{ route('employee.profile') }}", {
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    },
                    credentials: 'include'
                })
                .then(response => response.json())
                .then(employee => {
                    if (employee.error) {
                        alert("Error: " + employee.error);
                        return;
                    }

                    const profileHTML = `
                        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                            <div class="bg-gradient-to-r from-blue-500 to-purple-500 p-6 text-white text-center">
                                <h2 class="text-2xl font-bold">${employee.name}</h2>
                                <p class="text-sm opacity-90">${employee.role ?? 'Employee'}</p>
                            </div>
                            <div class="p-6 text-gray-700">
                                <p><strong>ID:</strong> ${employee.id}</p>
                                <p><strong>Email:</strong> ${employee.email}</p>
                                <p><strong>Contact:</strong> ${employee.contact ?? 'N/A'}</p>
                                <p><strong>Department:</strong> ${employee.department ?? 'N/A'}</p>
                                <p><strong>Joining Date:</strong> ${employee.joining_date ?? 'N/A'}</p>
                            </div>
                        </div>
                    `;

                    $("#profileContainer").html(profileHTML);
                })
                .catch(error => console.error('Error fetching profile:', error));
            });

            // Load Tasks
            $("#myTasksBtn").on("click", function (event) {
                event.preventDefault();
                LoadMyTask();
            });
        });

        function LoadMyTask() {
            let url = $("#myTasksBtn").data("url");

            $.ajax({
                url: url,
                type: "GET",
                dataType: "json",
                success: function (tasks) {
                    let rows = '';

                    if (tasks.length > 0) {
                        tasks.forEach(task => {
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
                        rows = `<tr><td colspan="8" class="text-center text-gray-400">No tasks found.</td></tr>`;
                    }

                    $("#taskContainer").html(`
                        <div class="mt-6">
                            <h3 class="text-xl font-semibold text-gray-700">My Tasks</h3>
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
                                    <tbody>${rows}</tbody>
                                </table>
                            </div>
                        </div>
                    `);
                },
                error: function () {
                    alert("Failed to load tasks.");
                }
            });
        }
    </script>

</body>
</html>
