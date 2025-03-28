<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Employee;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::with('employee')->get();
        return view('admin.tasks.index', compact('tasks'));
    }

    public function create()
    {
        $employees = Employee::all();
        return view('admin.tasks.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'task_title' => 'required|string|max:255',
            'description' => 'required',
            'employee_id' => 'required|exists:employees,id',
            'status' => 'required|in:Pending,Ongoing,Completed',
            'deadline' => 'required|date',
            'task_start_date' => 'required|date',
            'total_days' => 'required|integer',
            'remarks' => 'nullable|string',
        ]);

        Task::create($request->all());

        return redirect()->route('admin.tasks.index')->with('success', 'Task created successfully!');
    }
}
