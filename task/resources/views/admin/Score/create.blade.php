<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Task</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');
        body { 
            font-family: 'Poppins', sans-serif; 
            overflow: hidden; /* Prevent scrolling */
        }
    </style>
</head>
<body class="bg-gradient-to-r from-blue-500 to-blue-700 min-h-screen flex items-center justify-center">

    <div class="w-full max-w-lg bg-white shadow-lg rounded-lg p-8 h-[600px] flex flex-col justify-center">
        <h2 class="text-2xl font-bold text-gray-700 text-center mb-6">Create Task</h2>

        <form action="#" method="POST" class="space-y-4 flex-grow">
            <div>
                <label for="employee_id" class="block text-gray-600 font-medium mb-1">Employee ID</label>
                <input type="number" name="employee_id" required class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <div>
                <label for="status" class="block text-gray-600 font-medium mb-1">Status</label>
                <select name="status" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                    <option value="pending">Pending</option>
                    <option value="in_progress">In Progress</option>
                    <option value="completed">Completed</option>
                </select>
            </div>

            <div>
                <label for="rework_count" class="block text-gray-600 font-medium mb-1">Rework Count</label>
                <input type="number" name="rework_count" value="0" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <div>
                <label for="overdue" class="block text-gray-600 font-medium mb-1">Overdue</label>
                <select name="overdue" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                    <option value="0">No</option>
                    <option value="1">Yes</option>
                </select>
            </div>

            <div>
                <label for="remarks" class="block text-gray-600 font-medium mb-1">Remarks</label>
                <textarea name="remarks" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"></textarea>
            </div>

            <div>
                <label for="score" class="block text-gray-600 font-medium mb-1">Score</label>
                <input type="number" name="score" min="0" max="100" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <button type="submit" class="w-full bg-green-600 text-white py-3 rounded-lg font-medium hover:bg-green-700 transition">Create Task</button>
        </form>
    </div>

</body>
</html>
