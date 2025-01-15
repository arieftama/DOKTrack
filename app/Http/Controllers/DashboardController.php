<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TaskLog;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistik Tugas
        $totalTasks = TaskLog::count();
        $pendingTasks = TaskLog::where('status', 'pending')->count();
        $completedTasks = TaskLog::where('status', 'complete')->count();

        // Statistik Member
        $activeMembers = User::where('status', 'active')->count();  // Uncomment ini

        // Tugas Harian untuk Grafik
        $tasksByDate = TaskLog::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->whereBetween('created_at', [Carbon::now()->subDays(7)->startOfDay(), Carbon::now()->endOfDay()])
            ->groupBy(TaskLog::raw('DATE(created_at)'))
            ->orderBy('date', 'asc')
            ->get();

        $taskDates = $tasksByDate->pluck('date')->map(function ($date) {
            return Carbon::parse($date)->format('Y-m-d');
        });

        $taskCounts = $tasksByDate->pluck('count');

        // Daftar Tugas Terbaru
        $recentTasks = TaskLog::orderBy('created_at', 'desc')->take(5)->get();

        $events = TaskLog::select('id', 'task_name as title', 'created_at as start', 'status')
        ->get()
        ->map(function($task) {
            return [
                'title' => $task->title,
                'start' => Carbon::parse($task->start)->format('Y-m-d'), // Pastikan format tanggal benar
                'backgroundColor' => $task->status === 'complete' ? '#00a65a' : '#f39c12',
                'borderColor' => $task->status === 'complete' ? '#00a65a' : '#f39c12',
                'url' => route('tasklog.store', $task->id), // Tambahkan link jika diperlukan
            ];
        });

    return view('dashboard', compact('totalTasks', 'pendingTasks', 'completedTasks', 'activeMembers', 'taskDates', 'taskCounts', 'recentTasks', 'events'));


        $events = [
            [
                'title' => 'Task 1',
                'start' => '2025-01-15',
                'backgroundColor' => '#f39c12',
                'borderColor' => '#f39c12',
            ],
            [
                'title' => 'Task 2',
                'start' => '2025-01-16',
                'backgroundColor' => '#00a65a',
                'borderColor' => '#00a65a',
            ],
        ];



        return view('dashboard', compact(
            'totalTasks',
            'pendingTasks',
            'completedTasks',
            'activeMembers',
            'taskDates',
            'taskCounts',
            'recentTasks',
            'events' // Tambahkan ini
        ));

    }
}
