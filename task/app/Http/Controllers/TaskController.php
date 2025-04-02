<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{

//Task Index show page    
    public function index()
    {
        $tasks = Task::with('employee')->get();
        return view('admin.tasks.index', compact('tasks'));
    }
    
    // nice

//Task Create page      
    public function create()
    {
        $employees = Employee::all();
        return view('admin.tasks.create', compact('employees'));
    }

//Task Store Database  
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
    public function showEmployeeTasks(Request $request)
    {
        if (!Auth::guard('employee')->check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    
        $employee = Auth::guard('employee')->user();
        $tasks = Task::where('employee_id', $employee->id)->get();
    
        if ($request->ajax()) {
            return response()->json($tasks); // Return JSON for AJAX
        }
    
        return view('admin.user.mytask', compact('tasks'));
    }
    


}
