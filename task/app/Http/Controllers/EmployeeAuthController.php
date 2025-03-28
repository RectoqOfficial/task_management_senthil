<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Employee;

class EmployeeAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.employee_login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('employee')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('employee.dashboard');
        }

        return back()->withErrors(['email' => 'Invalid email or password']);
    }

    public function dashboard()
    {
        return view('employee.dashboard');
    }

    public function logout()
    {
        Auth::guard('employee')->logout();
        return redirect()->route('employee.login')->with('success', 'Logged out successfully!');
    }
}
