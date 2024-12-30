<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TaskLog;

class TaskLogController extends Controller
{
    /**
     * Menampilkan form log tugas.
     */
    public function showForm()
    {
        return view('tasklog.create');
    }

    /**
     * Menyimpan log tugas baru.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        // Validasi input
        $request->validate([
            'task_name' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|string|in:pending,in_progress,complete',
            'date' => 'required|date',
        ], [
        ]);

        // Simpan log tugas
        $taskLog = TaskLog::create([
            'user_id' => $user->id,
            'task_name' => $request->input('task_name'),
            'description' => $request->input('description'),
            'status' => $request->input('status'),
            'date' => $request->input('date'),
            'timestamp' => now(), // Menyimpan timestamp dalam format lengkap

        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('tasklog.index')->with('success', 'Log tugas berhasil disimpan.');
    }

    /**
     * Menampilkan daftar log tugas.
     */
    public function index()
    {
        $user = Auth::user();
        $taskLogs = TaskLog::where('user_id', $user->id)->orderBy('date', 'desc')->get();

        return view('tasklog.index', compact('taskLogs'));
    }
}
