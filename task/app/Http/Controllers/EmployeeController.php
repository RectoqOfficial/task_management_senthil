<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Role;

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

        return redirect()->route('admin.employee.index')->with('success', 'Employee added successfully!');
    }
    
    public function show($id)
{
    $employee = Employee::with('role')->findOrFail($id);
    return view('admin.employee.show', compact('employee'));
}

}
