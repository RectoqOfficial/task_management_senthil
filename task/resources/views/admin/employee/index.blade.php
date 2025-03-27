<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee List</title>
</head>
<body>

<h2>Employee List</h2>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Contact</th>
        <th>Gender</th>
        <th>Department</th>
        <th>Role</th>
        <th>Joining Date</th>
    </tr>
    @foreach($employees as $employee)
    <tr>
        <td>{{ $employee->id }}</td>
        <td>{{ $employee->name }}</td>
        <td>{{ $employee->email }}</td>
        <td>{{ $employee->contact }}</td>
        <td>{{ $employee->gender }}</td>
        <td>{{ $employee->department }}</td>
        <td>{{ $employee->role->role }}</td>
        <td>{{ $employee->joining_date }}</td>
    </tr>
    @endforeach
</table>

</body>
</html>
