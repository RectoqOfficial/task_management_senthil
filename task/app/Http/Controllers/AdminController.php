<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//Admin Dashboard Page
class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.admin_dashboard');
    }
}

