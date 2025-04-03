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

    // Return a JSON response indicating success
    return response()->json(['success' => true, 'message' => 'Employee added successfully!']);
}


// Employee Delete

public function destroy($id)
{
    $employee = Employee::findOrFail($id);
    $employee->delete();

    return response()->json(['message' => 'Employee deleted successfully!']);
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
}
