@extends('layouts.app')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #6a11cb, #2575fc, #00c9a7); /* New gradient background */
        min-height: 100vh;
    }
</style>

<div class="container mt-5">
    <div class="card shadow-lg border-0 rounded-lg p-4" style="background: linear-gradient(135deg, #ffffff, #f8f9fa);">
    <div class="card-body text-center" style="background: linear-gradient(135deg, #ff9a9e, #fad0c4, #fbc2eb); padding: 20px; border-radius: 10px;">
    <h2 class="fw-bold text-primary">Welcome, Admin!</h2>
    <p class="text-muted">This is your dashboard where you can manage users, tasks, and settings.</p>
    <div class="d-flex justify-content-center mt-4">
        <a href="{{ route('admin.employee.index') }}" class="btn btn-info mx-2">
            <i class="bi bi-people"></i> Manage Employees
        </a>
        <a href="{{ route('admin.tasks.index') }}" class="btn btn-success mx-2">
            <i class="bi bi-list-task"></i> Manage Tasks
        </a>
        <a href="{{ route('admin.roles.index') }}" class="btn btn-warning mx-2">
            <i class="bi bi-person-badge"></i> Manage Roles
        </a>
    </div>
</div>

        </div>
    </div>
</div>
@endsection
