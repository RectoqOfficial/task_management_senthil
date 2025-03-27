@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Welcome, Admin!</h2>
    <p>This is your dashboard where you can manage users, tasks, and settings.</p>

    <div class="mt-4">
        <a href="{{ route('admin.logout') }}" 
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
           class="btn btn-danger">
            Logout
        </a>
        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>
</div>
@endsection
