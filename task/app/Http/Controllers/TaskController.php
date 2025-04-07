<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


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
            'status' => 'required|in:Pending, Ongoing, Completed, Started, Review, Redo, Overdue',
            'deadline' => 'nullable|date',
            'task_start_date' => 'nullable|date',
            'total_days' => 'nullable|integer',
            'remarks' => 'nullable|string',
        ]);

        Task::create($request->all());

        return redirect()->route('admin.dashboard')->with('success', 'Task added successfully');
    }
    
    // delete task
    public function destroy($id)
{
    $task = Task::findOrFail($id);
    $task->delete();

    return response()->json(['message' => 'Task deleted successfully']);
}

    
    // Employee show Task
    public function showEmployeeTasks(Request $request)
{
    if (!Auth::guard('employee')->check()) {
        \Log::error('Unauthorized access attempt to showEmployeeTasks');
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    $employee = Auth::guard('employee')->user();
    \Log::info("Fetching tasks for employee ID: {$employee->id}");

    $tasks = Task::where('employee_id', $employee->id)->get();

    \Log::info('Tasks retrieved:', $tasks->toArray());

    if ($request->ajax()) {
        return response()->json($tasks);
    }

    return view('admin.user.mytask', compact('tasks'));
}




// task date employee start
public function updateTask(Request $request, $id)
{
    $task = Task::find($id);
    
    if (!$task) {
        return response()->json(['error' => 'Task not found'], 404);
    }

    $task->status = $request->status;
    $task->task_start_date = $request->task_start_date;
    
    

    // Automatically calculate deadline based on total_days if needed
    

    $task->save();
    Log::info("After update: ", $task->toArray());




    return response()->json(['success' => 'Task updated successfully']);
}


 
// Admin Redo count click employee show
public function updateStatus(Request $request)
{
    $request->validate([
        'task_id' => 'required|exists:tasks,id',
        'status' => 'required|in:Pending,Started,Review,Redo,Overdue,Completed',
    ]);

    $task = Task::findOrFail($request->task_id);

    if ($request->status === "Redo") {
        $task->redo_count += 1;
    }

    $task->status = $request->status;
    $task->save();

    return response()->json(['success' => true, 'message' => 'Status updated successfully!']);
}



}
