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

        $role = Role::create([
            'role' => $request->role,
            'department' => $request->department,
        ]);
    
            // Return JSON for AJAX
    return response()->json([
        'success' => true,
        'message' => 'Role created successfully!',
        'role' => $role,
    ]);
    }

    // Delete role
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        return response()->json(['success' => 'Role deleted successfully']);
    }
    

}
