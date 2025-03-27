<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Employee</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<h2>Add Employee</h2>

<form action="/employees/store" method="POST">
    @csrf

    <label>Name:</label>
    <input type="text" name="name" required>

    <label>Email:</label>
    <input type="email" name="email" required>

    <label>Password:</label>
    <input type="password" name="password" required>

    <label>Contact:</label>
    <input type="text" name="contact" required>

    <label>Gender:</label>
    <select name="gender" required>
        <option value="">Select Gender</option>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
    </select>

    <label>Department:</label>
    <select name="department" id="departmentSelect" required>
        <option value="">Select Department</option>
        @foreach($departments as $department)
            <option value="{{ $department }}">{{ $department }}</option>
        @endforeach
    </select>

    <label>Role:</label>
    <select name="role_id" id="roleSelect" required>
        <option value="">Select Role</option>
    </select>

    <label>Joining Date:</label>
    <input type="date" name="joining_date" required>

    <button type="submit">Add Employee</button>
</form>

<script>
    $('#departmentSelect').on('change', function() {
        var dept = $(this).val();
        $('#roleSelect').empty();
        $('#roleSelect').append('<option value="">Select Role</option>');
        @foreach($roles as $role)
            if ('{{ $role->department }}' == dept) {
                $('#roleSelect').append('<option value="{{ $role->id }}">{{ $role->role }}</option>');
            }
        @endforeach
    });
</script>

</body>
</html>
