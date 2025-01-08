<?php
// filepath: /C:/laragon/www/DOKTrack/app/Http/Controllers/TaskLogController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TaskLog;
use App\Models\Message;

class TaskLogController extends Controller
{
    /**
     * Menampilkan form log tugas.
     *
     * @return \Illuminate\View\View
     */
    public function showForm()
    {
        return view('tasklog.create');
    }

    /**
     * Menyimpan log tugas baru.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        // Validasi input
        $request->validate([
            'task_name' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|string|max:255',
            'date' => 'required|date',
            'message' => 'nullable|string',
        ]);

        // Simpan log tugas
        $taskLog = TaskLog::create([
            'user_id' => $user->id,
            'task_name' => $request->input('task_name'),
            'description' => $request->input('description'),
            'status' => $request->input('status'),
            'date' => $request->input('date'),
        ]);

        // Simpan pesan jika ada
        if ($request->filled('message')) {
            Message::create([
                'user_id' => $user->id,
                'task_id' => $taskLog->id,
                'message' => $request->input('message'),
            ]);
        }

        return redirect()->route('tasklog.index')->with('success', 'Log tugas berhasil disimpan.');
    }

    /**
     * Menampilkan daftar log tugas.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $taskLogs = TaskLog::with('messages')->where('user_id', Auth::id())->get();
        return view('tasklog.index', compact('taskLogs'));
    }

    /**
     * Menyimpan tanggapan admin.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $messageId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function respond(Request $request, $messageId)
    {
        $request->validate([
            'response' => 'required|string',
        ]);

        $message = Message::findOrFail($messageId);
        $message->update([
            'response' => $request->input('response'),
            'is_replied' => true,
        ]);

        return redirect()->route('tasklog.index')->with('success', 'Tanggapan berhasil disimpan.');
    }

    public function edit($id)
    {
        $taskLog = TaskLog::with('message')->findOrFail($id);
        return view('tasklog.create', compact('taskLog'));
    }

    public function update(Request $request, $id)
    {
        $taskLog = TaskLog::findOrFail($id);

        $request->validate([
            'task_name' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|string|max:255',
            'date' => 'required|date',
            'message' => 'nullable|string',
        ]);

        $taskLog->update([
            'task_name' => $request->input('task_name'),
            'description' => $request->input('description'),
            'status' => $request->input('status'),
            'date' => $request->input('date'),
        ]);

        if ($request->filled('message')) {
            $taskLog->message()->updateOrCreate(
                ['task_id' => $taskLog->id],
                ['message' => $request->input('message')]
            );
        }

        return redirect()->route('tasklog.index')->with('success', 'Log tugas berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $taskLog = TaskLog::findOrFail($id);
        $taskLog->delete();

        return redirect()->route('tasklog.index')->with('success', 'Log tugas berhasil dihapus.');
    }
}