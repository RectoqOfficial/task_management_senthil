<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    // Show all roles
    public function index()
    {
        $roles = Role::all();
        return view('admin.role.index', compact('roles'));
    }

    // Show create form
    public function create()
    {
        return view('admin.role.create');
    }

    // Store new role
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
            'department' => 'required'
        ]);

        Role::create([
            'name' => $request->name,
            'department' => $request->department
        ]);

        return redirect()->route('admin.roles.index')->with('success', 'Role added successfully');
    }

    // Delete role
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return redirect()->route('admin.roles.index')->with('success', 'Role deleted successfully');
    }
}
