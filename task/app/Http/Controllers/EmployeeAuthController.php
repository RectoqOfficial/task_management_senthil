<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Employee;


class EmployeeAuthController extends Controller
{

//Employee Login show Page    
    public function showLoginForm()
    {
        return view('auth.employee_login');
    }

//Employee Login Page 
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

//Employee Dashboard Page 
    public function dashboard()
    {
        return view('auth.dashboard');
    }

//Employee Logout Page 
    public function logout()
    {
        Auth::guard('employee')->logout();
        return redirect()->route('employee.login')->with('success', 'Logged out successfully!');
    }
}
