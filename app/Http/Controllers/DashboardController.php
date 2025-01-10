<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TaskLog;

class DashboardController extends Controller
{
    public function index()
    {
        $totalTasks = TaskLog::count();
        $pendingTasks = TaskLog::where('status', 'pending')->count();
        $completedTasks = TaskLog::where('status', 'complete')->count();

        return view('dashboard', compact('totalTasks', 'pendingTasks', 'completedTasks'));
    }
}
