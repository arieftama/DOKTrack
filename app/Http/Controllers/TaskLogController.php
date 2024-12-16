<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TaskLog;

class TaskLogController extends Controller
{
    /**
     * Menampilkan form log tugas.
     *
     * @return \Illuminate\View\View
     */
    public function showForm()
    {
        return view('tasklog');
    }

    /**
     * Menyimpan log tugas baru.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $today = now()->format('Y-m-d');

        // Validasi input
        $request->validate([
            'task_name' => 'required|string|max:255',
            'description' => 'required|string',
            'division' => 'required|string',
            'status' => 'required|string',
            'date' => 'required|date',
            'timestamp' => 'required|date_format:H:i:s',
        ]);

        // Simpan log tugas
        $taskLog = TaskLog::create([
            'user_id' => $user->id,
            'task_name' => $request->input('task_name'),
            'description' => $request->input('description'),
            'division' => $request->input('division'),
            'status' => $request->input('status'),
            'date' => $request->input('date'),
            'timestamp' => $request->input('timestamp'),
        ]);

        return response()->json([
            'message' => 'Log tugas berhasil disimpan',
            'data' => $taskLog,
        ]);
    }
}
