<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

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
        'total_days' => 'required|integer|min:1', // Validate it’s a number
        'remarks' => 'nullable|string',
    ]);

    $totalDays = (int) $request->total_days; // ✅ Fix: cast to integer

    $task = new Task();
    $task->task_title = $request->task_title;
    $task->description = $request->description;
    $task->employee_id = $request->employee_id;
    $task->remarks = $request->remarks;

    $task->status = 'Pending';
    $task->task_start_date = now();
    $task->deadline = now()->addDays($totalDays); // ✅ Safe now
    $task->total_days = $totalDays;

    $task->save();

       // If AJAX, return JSON
       return response()->json([
        'task' => [
            'id' => $task->id,
            'task_title' => $task->task_title,
            'description' => $task->description,
            'status' => $task->status,
            'employee_name' => $task->employee->name,
            'employee_email' => $task->employee->email,
       'task_start_date' => Carbon::parse($task->task_start_date)->format('Y-m-d'),

            'deadline' => $task->computed_deadline,
            'total_days' => $task->total_days,
            'redo_count' => $task->redo_count,
            'remarks' => $task->remarks,
        ]
    ]);
    
    // return redirect()->route('admin.dashboard')->with('success', 'Task added successfully');
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

public function updateStartDate(Request $request, $id)
{
    $task = Task::findOrFail($id);

    if ($request->has('task_start_date')) {
        $task->task_start_date = $request->task_start_date;

        // Recalculate deadline if total_days exists
        if ($task->total_days) {
            $task->deadline = Carbon::parse($task->task_start_date)->addDays($task->total_days);
        }

        $task->save();
    }

    return response()->json(['success' => 'Start date updated successfully.']);
}


}
