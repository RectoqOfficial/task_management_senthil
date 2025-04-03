<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Scoreboard</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-gray-900 text-white p-6">
<div class="mt-6">
    <h3 class="text-xl font-semibold text-gray-700">My Score Board</h3>
    <div class="overflow-x-auto mt-4">
        <table class="w-full border border-gray-600 text-white text-center">
            <thead>
                <tr class="bg-purple-600 text-white text-left text-sm">
                    <th class="border border-gray-600 p-2">ID</th>
                    <th class="border border-gray-600 p-2">Task Title</th>
                    <th class="border border-gray-600 p-2">Status</th>
                    <th class="border border-gray-600 p-2">Overdue Count</th>
                    <th class="border border-gray-600 p-2">Redo Count</th>
                    <th class="border border-gray-600 p-2">Score</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                    <tr class="bg-gray-900 hover:bg-gray-700">
                        <td class="border border-gray-600 p-2">{{ $task->id }}</td>
                        <td class="border border-gray-600 p-2">{{ $task->task_title }}</td>
                        <td class="border border-gray-600 p-2">{{ $task->status }}</td>
                        <td class="border border-gray-600 p-2">{{ $task->score->overdue_count ?? 0 }}</td>
                        <td class="border border-gray-600 p-2">{{ $task->score->redo_count ?? 0 }}</td>
                        <td class="border border-gray-600 p-2 font-bold">{{ $task->score->score ?? 0 }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
