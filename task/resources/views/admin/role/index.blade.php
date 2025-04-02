<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Role Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-black text-white p-6">
    <div class="max-w-6xl mx-auto bg-gray-800 shadow-lg rounded-lg p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-3xl font-semibold text-white flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a4 4 0 10-8 0v2M5 21h14a2 2 0 002-2v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2z" />
                </svg>
                Role Management
            </h2>
            <button class="bg-purple-500 text-white px-4 py-2 rounded-lg flex items-center gap-1 hover:bg-purple-600 transition" data-modal="createRoleModal">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Create Role
            </button>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full border border-gray-600 text-white text-center">
                <thead>
                    <tr class="bg-purple-600 text-white text-left text-sm">
                        <th class="border border-gray-600 p-2">ID</th>
                        <th class="border border-gray-600 p-2">Role Name</th>
                        <th class="border border-gray-600 p-2">Department</th>
                        <th class="border border-gray-600 p-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($roles as $role)
                    <tr class="bg-gray-900 hover:bg-gray-700">
                        <td class="border border-gray-600 p-2">{{ $role->id }}</td>
                        <td class="border border-gray-600 p-2">{{ $role->role }}</td>
                        <td class="border border-gray-600 p-2">{{ $role->department }}</td>
                        <td class="border border-gray-600 p-2">
                            <button class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition" onclick="confirm('Are you sure?')">
                                Delete
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
    <!-- Create Role Modal -->
    <div id="createRoleModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-gray-900 text-gray-300 p-6 rounded-lg shadow-xl w-96">
            <h3 class="text-lg font-bold mb-4 text-white">Create Role</h3>
            <form action="{{ route('admin.roles.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="role" class="block text-sm font-medium">Role Name</label>
                    <input type="text" class="w-full p-2 rounded bg-gray-800 border border-gray-600 text-white" id="role" name="role" required>
                </div>
                <div class="mb-3">
                    <label for="department" class="block text-sm font-medium">Department</label>
                    <input type="text" class="w-full p-2 rounded bg-gray-800 border border-gray-600 text-white" id="department" name="department" required>
                </div>
                <button type="submit" class="bg-purple-500 text-white w-full py-2 rounded hover:bg-purple-600 transition">Create Role</button>
            </form>
            <button id="close-modal" class="mt-4 bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition">Close</button>
        </div>
    </div>
    
    <script>
        document.querySelector('[data-modal="createRoleModal"]').addEventListener('click', function () {
            document.getElementById('createRoleModal').classList.remove('hidden');
        });
        
        document.getElementById('close-modal').addEventListener('click', function () {
            document.getElementById('createRoleModal').classList.add('hidden');
        });
    </script>
</body>
</html>
