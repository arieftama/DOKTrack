<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TaskLog;

class TaskLogController extends Controller
{
    public function markTaskComplete(Request $request)
{
    $request->validate([
        'file_name' => 'required|string',
        'sector' => 'required|string'
    ]);

    $taskLog = TaskLog::create([
        'user_id' => Auth::id(),
        'file_name' => $request->file_name,
        'sector' => $request->sector,
        'status' => 'complete',
        'timestamp' => now(),
    ]);

    return response()->json(['message' => 'Tugas selesai dicatat', 'data' => $taskLog]);
}

}
