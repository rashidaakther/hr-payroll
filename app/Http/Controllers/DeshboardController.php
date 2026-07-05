<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DeshboardController extends Controller
{
    public function adminDashboard()
    {
        return view('admin.dashboard');
    }
    public function adminAnalytics()
    {
        return view('admin.analytics');
    }
    public function employeeDashboard()
    {
        return view('employee.dashboard');
    }
    public function employeeAnalytics()
    {
        return view('employee.analytics');
    }   
}
