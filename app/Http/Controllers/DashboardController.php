<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard'); // Pastikan file blade bernama 'dashboard.blade.php' ada di folder resources/views
    }
}
