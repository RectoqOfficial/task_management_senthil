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

        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body class="bg-white flex">

    <!-- Toggle Button (Mobile Only) -->
    <div class="lg:hidden fixed top-4 left-4 z-50">
        <button id="menuToggle" class="text-white bg-purple-700 p-2 rounded-md shadow-md">
            <i class="bi bi-list text-2xl"></i>
        </button>
    </div>


    <!-- Responsive Sidebar -->
    <div id="sidebar" class="fixed top-0 left-0 w-64 min-h-screen lg:h-screen bg-gradient-to-b from-purple-800 to-purple-900 text-white p-5 shadow-lg z-50 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out lg:static lg:transform-none">

        <div class="text-center mb-6">
            <h2 class="text-lg font-semibold">Employee Dashboard</h2>
        </div>

        <nav class="space-y-2">
            <!-- My Profile Button -->
            <button id="myProfileBtn" class="flex items-center gap-3 px-6 py-3 rounded-lg bg-white/1 hover:bg-gradient-to-r hover:from-purple-700 hover:to-purple-500 
        hover:text-white hover:shadow-xl hover:scale-105 transition-all duration-300 ease-in-out group w-full">
                <i class="bi bi-person text-lg"></i>
                <span>My Profile</span>
            </button>

            <!-- My Tasks Button -->
            <a href="#" id="myTasksBtn" data-url="{{ route('user.mytask.view') }}" class="flex items-center gap-3 px-6 py-3 rounded-lg bg-white/1 hover:bg-gradient-to-r hover:from-purple-700 hover:to-purple-500 
        hover:text-white hover:shadow-xl hover:scale-105 transition-all duration-300 ease-in-out group w-full">
                <i class="bi bi-list-task text-lg"></i>
                <span>My Tasks</span>
            </a>

            <!-- My Score Board Button -->
            <a href="#" id="myScoreBtn" data-url="{{ route('employee.myscore.view') }}" class="flex items-center gap-3 px-6 py-3 rounded-lg bg-white/1 hover:bg-gradient-to-r hover:from-purple-700 hover:to-purple-500 
        hover:text-white hover:shadow-xl hover:scale-105 transition-all duration-300 ease-in-out group w-full">
                <i class="bi bi-trophy text-lg"></i>
                <span>My Score Board</span>
            </a>

            <!-- Logout -->
            <form action="{{ route('employee.logout') }}" method="POST" class="pt-6">
                @csrf
                <button type="submit"
                    class="w-full flex items-center px-4 py-2 rounded-lg bg-red-600 hover:bg-red-700 transition">
                    <i class="bi bi-box-arrow-right mr-2"></i> Logout
                </button>
            </form>
        </nav>
    </div>
    <!-- nice -->

    <!-- Overlay for Mobile -->
    <div id="overlay" class="fixed inset-0 bg-black/50 z-40 hidden lg:hidden"></div>

    <!-- JS for Sidebar Toggle -->
    <script>
        const menuToggle = document.getElementById('menuToggle');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');

        menuToggle.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        });

        overlay.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        });
    </script>

<div class="flex-1 flex flex-col min-h-screen bg-white">
  <!-- Main Content -->
    <div class="flex-1 p-4 sm:p-6 md:p-8 lg:p-10">
 <!-- this is contailner  inside okey  sample using -->
 
 <div class="bg-white shadow-lg rounded-lg p-6 max-sm:w-[300px]">
        <h2 class="text-2xl font-bold text-gray-700 text-center">
                Welcome, {{ Auth::guard('employee')->user()->name }}!
            </h2>
            <p class="text-gray-600 text-center mt-2">Manage your tasks and performance here.</p>
             <!-- Profile Container -->
            <div id="profileContainer" class="mt-4"></div>
           <!-- Task Container -->
            <div id="taskContainer" class="mt-6"></div>
           <!-- Container where the scoreboard will be displayed -->
            <div id="scoreContainer" class="mt-6"></div>
        </div>
    </div>
</div>

    <!-- JavaScript for AJAX -->
    <script>
        // my profile

        $(document).ready(function () {
            $("#taskContainer, #scoreContainer").hide(); // Hide other sections

            // Load Profile
            $("#myProfileBtn").on("click", function () {
                $("#profileContainer").show();
                $("#taskContainer, #scoreContainer").hide(); // Hide other sections

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
    <div class="max-w-lg mx-auto bg-white shadow-xl rounded-lg overflow-hidden mt-6">
        <!-- Profile Header with Background Gradient -->
<div class="bg-gradient-to-b from-purple-800 to-purple-900 p-6 text-white text-center relative">
            <!-- User Icon instead of Profile Picture -->
            <div class="w-24 h-24 mx-auto rounded-full bg-white shadow-md flex items-center justify-center">
                <i class="bi bi-person-circle text-4xl text-gray-700"></i>
            </div>
            <h2 class="text-2xl font-bold mt-3">${employee.name}</h2>
            <p class="text-sm opacity-90">${employee.role ?? 'Employee'}</p>
        </div>

        <!-- Profile Details -->
        <div class="p-6 text-gray-700 space-y-3">
            <div class="flex items-center space-x-2">
                <i class="bi bi-person-badge text-blue-500"></i>
                <p><strong>ID:</strong> ${employee.id}</p>
            </div>

            <div class="flex items-center space-x-2">
                <i class="bi bi-envelope text-green-500"></i>
                <p><strong>Email:</strong> ${employee.email}</p>
            </div>

            <div class="flex items-center space-x-2">
                <i class="bi bi-telephone text-red-500"></i>
                <p><strong>Contact:</strong> ${employee.contact ?? 'N/A'}</p>
            </div>

            <div class="flex items-center space-x-2">
                <i class="bi bi-building text-yellow-500"></i>
                <p><strong>Department:</strong> ${employee.department ?? 'N/A'}</p>
            </div>

            <div class="flex items-center space-x-2">
                <i class="bi bi-calendar text-purple-500"></i>
                <p><strong>Joining Date:</strong> ${employee.joining_date ?? 'N/A'}</p>
            </div>
        </div>
    </div>
`;

                        $("#profileContainer").html(profileHTML);
                    })
                    .catch(error => console.error('Error fetching profile:', error));
            });

            // Tasks

            $("#myTasksBtn").on("click", function (event) {
                $("#taskContainer").show();
                $("#profileContainer, #scoreContainer").hide(); // Hide other sections

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
                                    <td class="px-3 py-2 border border-gray-400 text-gray-100 text-center">
                                    <!-- Show current status -->
                                    <span class="text-sm font-semibold text-white mb-1 block">${task.status}</span>

                                     <!-- Show dropdown only if status is NOT Completed -->
                                     ${task.status !== 'Completed' ? `
                                    <select class="status-update bg-gray-700 text-white border border-gray-400 px-2 py-1 rounded" data-task-id="${task.id}">
                                    <option value="Pending" ${task.status === 'Pending' ? 'selected' : ''}>Pending</option>
                                    <option value="Started" ${task.status === 'Started' ? 'selected' : ''}>Started</option>
                                    <option value="Review" ${task.status === 'Review' ? 'selected' : ''}>Review</option>
                                    </select>
                                    ` : ''}
                                    </td>
                                     <td class="px-3 py-2 border border-gray-400 text-gray-100">
                                     <input type="date" class="start-date-update bg-gray-700 text-white border border-gray-400 px-2 py-1 rounded" 
                                      value="${task.task_start_date}" data-task-id="${task.id}">
                                    </td>
                                    <td class="px-3 py-2 border border-gray-400 text-gray-100">${task.computed_deadline}</td>
                                    <td class="px-3 py-2 border border-gray-400 text-gray-100">${task.total_days}</td>
                                    <td class="px-3 py-2 border border-gray-400 text-gray-100">${task.redo_count}</td>
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

  <!-- Make table scroll horizontally on small screens -->
  <div class="overflow-x-auto mt-4">
    <table class="min-w-[900px] w-full rounded-lg overflow-hidden shadow-md text-gray-300 border border-gray-600">
      <thead>
        <tr class="bg-purple-500 text-white text-left text-sm border-b border-gray-400">
          <th class="px-3 py-2 border border-gray-400">ID</th>
          <th class="px-3 py-2 border border-gray-400">Task Title</th>
          <th class="px-3 py-2 border border-gray-400">Description</th>
          <th class="px-3 py-2 border border-gray-400">Status</th>
          <th class="px-3 py-2 border border-gray-400">Start Date</th>
          <th class="px-3 py-2 border border-gray-400">Deadline</th>
          <th class="px-3 py-2 border border-gray-400">Total Days</th>
          <th class="px-3 py-2 border border-gray-400">Redo Count</th>
          <th class="px-3 py-2 border border-gray-400">Remarks</th>
        </tr>
      </thead>
      <tbody>
        ${rows}
      </tbody>
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

        // date auto upadte
        $(document).on("blur", ".start-date-update", function () {
            const $input = $(this);
            const taskId = $input.data("task-id");
            const newDate = $input.val();

            // Check if date is in full correct format (YYYY-MM-DD)
            const isValidFullDate = /^\d{4}-\d{2}-\d{2}$/.test(newDate);

            if (isValidFullDate) {
                $.ajax({
                    url: `/tasks/update-date/${taskId}`,
                    type: "PUT",
                    data: {
                        task_start_date: newDate,
                        _token: $('meta[name="csrf-token"]').attr("content")
                    },
                    success: function (response) {
                        console.log("Start date updated:", response);
                        LoadMyTask(); // Refresh UI if needed
                    },
                    error: function (xhr) {
                        console.error("Update error:", xhr.responseText);
                        alert("Failed to update start date.");
                    }
                });
            } else {
                console.log("Skipped update — not a complete date.");
            }
        });


        // score
        $(document).ready(function () {
            $("#myScoreBtn").on("click", function (event) {
                event.preventDefault();
                $("#scoreContainer").show();
                $("#profileContainer, #taskContainer").hide(); // Hide other sections


                LoadMyScore();
            });
        });

        function LoadMyScore() {
            let url = $("#myScoreBtn").data("url");

            $.ajax({
                url: url,
                type: "GET",
                success: function (html) {
                    $("#scoreContainer").html(html);
                },
                error: function () {
                    alert("Failed to load scores.");
                }
            });
        }


        // Auto update on status change employee

        $(document).ready(function () {
            // Auto update on status change
            $(document).on('change', '.status-update', function () {
                const taskId = $(this).data('task-id');
                const newStatus = $(this).val();

                $.ajax({
                    url: '/tasks/update-status', // Adjust to your actual route
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        task_id: taskId,
                        status: newStatus
                    },
                    success: function (response) {
                        // alert('Status updated successfully!');
                        // Optionally refresh or update parts of the DOM
                    },
                    error: function () {
                        alert('Failed to update status.');
                    }
                });
            });
        });




    </script>

</body>

</html>