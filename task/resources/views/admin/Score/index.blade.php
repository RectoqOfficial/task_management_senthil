<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task List</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-gradient-to-r from-blue-500 to-blue-700 min-h-screen flex items-center justify-center">

    <div class="w-full max-w-5xl bg-white shadow-lg rounded-lg p-6">
        <h2 class="text-2xl font-bold text-gray-700 text-center mb-6">Task List</h2>

        <div class="flex justify-end mb-4">
            <a href="{{ url('/score/create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                Create Task
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full border-collapse border border-gray-300 rounded-lg shadow-md">
                <thead>
                    <tr class="bg-blue-600 text-white">
                        <th class="py-3 px-4 text-left">Task ID</th>
                        <th class="py-3 px-4 text-left">Employee ID</th>
                        <th class="py-3 px-4 text-left">Status</th>
                        <th class="py-3 px-4 text-left">Rework Count</th>
                        <th class="py-3 px-4 text-left">Overdue</th>
                        <th class="py-3 px-4 text-left">Remarks</th>
                        <th class="py-3 px-4 text-left">Score</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Table will be empty -->
                    <tr class="border-b hover:bg-gray-100 transition">
                        <td class="py-3 px-4 text-gray-600 text-center" colspan="7">No tasks available</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
  
<!-- nice -->