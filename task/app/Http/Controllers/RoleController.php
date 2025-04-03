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
// nice
    // Show create form
    public function create()
    {
        return view('admin.role.create');
    }

    // Store new role
    public function store(Request $request)
    {
        $request->validate([
            'role' =>  'required|string|max:255',
            'department' => 'required|string|max:255',
        ]);

        Role::create([
            'role' => $request->role,
            'department' => $request->department,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Role added successfully');
    }

    // Delete role
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return redirect()->route('admin.roles.index')->with('success', 'Role deleted successfully');
    }
}
