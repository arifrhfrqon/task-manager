<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $role = Auth::user()->role->name;

        if ($role === 'admin') {
            return view('dashboard.admin');
        } elseif ($role === 'manager') {
            return view('dashboard.manager');
        } elseif ($role === 'staff') {
            return view('dashboard.staff');
        }

        abort(403);
    }
}
