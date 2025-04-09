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
    body {
      font-family: 'Poppins', sans-serif;
      overflow-x: hidden;
    }
  </style>
</head>

<body class="bg-gray-900 text-white">

<div class=" max-w-full w-full ml-[10px] mr-[16px] py-6">


  <h3 class="text-lg font-semibold text-black mb-4">My Score Board</h3>

  <div class="w-full overflow-x-auto">
    <table class="min-w-[800px] w-full border-collapse border border-gray-600 text-sm sm:text-base text-white ">
        <thead>
          <tr class="bg-purple-500 text-white text-center">
            <th class="border border-gray-600 px-3 py-2 whitespace-nowrap">ID</th>
            <th class="border border-gray-600 px-3 py-2 whitespace-nowrap">Task Title</th>
            <th class="border border-gray-600 px-3 py-2 whitespace-nowrap">Status</th>
            <th class="border border-gray-600 px-3 py-2 whitespace-nowrap">Overdue</th>
            <th class="border border-gray-600 px-3 py-2 whitespace-nowrap">Redo</th>
            <th class="border border-gray-600 px-3 py-2 whitespace-nowrap">Score</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($tasks as $task)
          <tr class="bg-gray-900 hover:bg-gray-700 transition text-center">
            <td class="border border-gray-600 px-3 py-2">{{ $task->id }}</td>
            <td class="border border-gray-600 px-3 py-2">{{ $task->task_title }}</td>
            <td class="border border-gray-600 px-3 py-2">{{ $task->status }}</td>
            <td class="border border-gray-600 px-3 py-2">{{ $task->score->overdue_count ?? 0 }}</td>
            <td class="border border-gray-600 px-3 py-2">{{ $task->redo_count ?? 0 }}</td>
            <td class="border border-gray-600 px-3 py-2 font-bold">{{ $task->score->score ?? 0 }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

</body>
</html>
