<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Role Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body class="bg-black text-white p-6">
<div class="max-w-6xl mx-auto bg-gray-800 shadow-lg rounded-lg p-4 sm:p-6">
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-4 sm:mb-6 gap-3">
        <h2 class="text-2xl sm:text-3xl font-semibold text-white flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 sm:w-7 sm:h-7 text-purple-400" fill="none"
                viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M17 9V7a4 4 0 10-8 0v2M5 21h14a2 2 0 002-2v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2z" />
            </svg>
            Role Management
        </h2>
        <button class="bg-purple-500 text-white px-4 py-2 rounded-lg flex items-center gap-1 hover:bg-purple-600 transition text-sm sm:text-base"
            data-modal="createRoleModal">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            Create Role
        </button>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-600 text-white text-center text-sm">
            <thead>
                <tr class="bg-purple-600 text-left">
                    <th class="border border-gray-600 p-2">ID</th>
                    <th class="border border-gray-600 p-2">Role Name</th>
                    <th class="border border-gray-600 p-2">Department</th>
                    <th class="border border-gray-600 p-2">Actions</th>
                </tr>
            </thead>
            <tbody id="role-list">
                @foreach($roles as $role)
                <tr class="bg-gray-900 hover:bg-gray-700">
                    <td class="border border-gray-600 p-2">{{ $role->id }}</td>
                    <td class="border border-gray-600 p-2">{{ $role->role }}</td>
                    <td class="border border-gray-600 p-2">{{ $role->department }}</td>
                    <td class="border border-gray-600 p-2">
                        <button class="delete-role bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition"
                            data-id="{{ $role->id }}">
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
<div id="createRoleModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">
    <div class="bg-gray-900 text-gray-300 p-6 rounded-lg shadow-xl w-full max-w-sm sm:max-w-md">
        <h3 class="text-lg font-bold mb-4 text-white">Create Role</h3>
        <form id="create-role-form" action="{{ route('admin.roles.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="role" class="block text-sm font-medium">Role Name</label>
                <input type="text" class="w-full p-2 rounded bg-gray-800 border border-gray-600 text-white"
                    id="role" name="role" required>
            </div>
            <div class="mb-3">
                <label for="department" class="block text-sm font-medium">Department</label>
                <input type="text" class="w-full p-2 rounded bg-gray-800 border border-gray-600 text-white"
                    id="department" name="department" required>
            </div>
            <button type="submit"
                class="bg-purple-500 text-white w-full py-2 rounded hover:bg-purple-600 transition">Create
                Role</button>
        </form>
        <button id="close-modal"
            class="mt-4 bg-red-500 text-white w-full py-2 rounded-lg hover:bg-red-600 transition">Close</button>
    </div>
</div>


    <script>
        document.querySelector('[data-modal="createRoleModal"]').addEventListener('click', function () {
            document.getElementById('createRoleModal').classList.remove('hidden');
        });

        document.getElementById('close-modal').addEventListener('click', function () {
            document.getElementById('createRoleModal').classList.add('hidden');
        });

       

// dynamcly show create role
        $('#create-role-form').on('submit', function (e) {
        e.preventDefault();

        const form = $(this);
        const data = form.serialize();

        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: data,
            success: function (response) {
                if (response.success) {
                    // Append full row with ID, Role, Department, Delete
                    $('#role-list').append(`
                        <tr class="bg-gray-900 hover:bg-gray-700" id="role-row-${response.role.id}">
                            <td class="border border-gray-600 p-2">${response.role.id}</td>
                            <td class="border border-gray-600 p-2">${response.role.role}</td>
                            <td class="border border-gray-600 p-2">${response.role.department}</td>
                            <td class="border border-gray-600 p-2">
                                <button
                                    class="delete-role bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition"
                                    data-id="${response.role.id}">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    `);

                    // Clear form and close modal
                    form[0].reset();
                    $('#createRoleModal').addClass('hidden');
                    alert(response.message);
                }
            },
            error: function (xhr) {
                alert('Error creating role');
                console.error(xhr.responseText);
            }
        });
    });

    // delete
    // Delete handler for both existing and new roles
    $(document).on('click', '.delete-role', function () {
        const roleId = $(this).data('id');

        if (confirm('Are you sure you want to delete this role?')) {
            $.ajax({
                url: `/admin/roles/${roleId}`,
                type: 'DELETE',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function () {
                    $(`#role-row-${roleId}`).remove();
                    alert('Role deleted successfully');
                },
                error: function () {
                    alert('Error deleting role');
                }
            });
        }
    });
    </script>
</body>

</html>