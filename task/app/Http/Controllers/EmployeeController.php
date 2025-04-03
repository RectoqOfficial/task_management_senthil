<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;


class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::with('role')->get();
        return view('admin.employee.index', compact('employees'));
    }
//Employee Create Page      
    public function create()
    {
        $departments = Role::distinct()->pluck('department');
        $roles = Role::all();

        return view('admin.employee.create', compact('departments', 'roles'));
    }

//Employee Store Database
public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:employees',
        'password' => 'required',
        'contact' => 'required',
        'gender' => 'required',
        'department' => 'required',
        'role_id' => 'required|exists:roles,id',
        'joining_date' => 'required|date'
    ]);

    Employee::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'contact' => $request->contact,
        'gender' => $request->gender,
        'department' => $request->department,
        'role_id' => $request->role_id,
        'joining_date' => $request->joining_date,
    ]);

    return redirect()->route('admin.dashboard')->with('success', 'Employee added successfully');

}


// Employee Delete

public function destroy($id)
{
    $employee = Employee::findOrFail($id);
    $employee->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Delete successfully');
}



public function showProfile(Request $request)
{
   
        // Get the authenticated employee using the 'employee' guard
        $employee = Auth::guard('employee')->user(); 
    
        // Check if an employee is authenticated
        if (!$employee) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    
        // Return employee details as JSON
        return response()->json([
            'id' => $employee->id,
            'name' => $employee->name,
            'email' => $employee->email,
            'contact' => $employee->contact,
            'department' => $employee->department,
            'role' => $employee->role->role ?? 'N/A', 
            'joining_date' => $employee->joining_date,
        ]);
    }


    public function showScorePage()
{
    $employeeId = Auth::guard('employee')->id();
    
    // Fetch tasks assigned to the logged-in employee along with their scores
    $tasks = Task::where('employee_id', $employeeId)
                ->with('score')
                ->get();

    return view('admin.score.scores', compact('tasks'));
}


// public function dashboard()
// {
//     // Check if the employee is authenticated
//     if (!Auth::guard('employee')->check()) {
//         return redirect()->route('employee.login')->with('error', 'Please log in to view your dashboard.');
//     }

//     // Get the logged-in employee
//     $employee = Auth::guard('employee')->user();

//     // Fetch task counts
//     $totalTasks = Task::where('assigned_to', $employee->id)->count();
//     $pendingTasks = Task::where('assigned_to', $employee->id)->where('status', 'pending')->count();
//     $startedTasks = Task::where('assigned_to', $employee->id)->where('status', 'started')->count();
//     $completedTasks = Task::where('assigned_to', $employee->id)->where('status', 'completed')->count();
//     $reviewTasks = Task::where('assigned_to', $employee->id)->where('status', 'review')->count();

//     // Debugging: Check if task data is retrieved
//     \Log::info("Total Tasks: {$totalTasks}, Pending: {$pendingTasks}, Started: {$startedTasks}, Completed: {$completedTasks}, Review: {$reviewTasks}");

//     // Return the correct view
//     return view('auth.dashboard', compact(
//         'totalTasks', 'pendingTasks', 'startedTasks', 'completedTasks', 'reviewTasks'
//     ));
// }
}
