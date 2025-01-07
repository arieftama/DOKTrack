<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;

class MessageController extends Controller
{
    /**
     * Menampilkan daftar pesan berdasarkan role.
     * - Admin: melihat semua pesan.
     * - Member: melihat pesan yang dikirim sendiri.
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            // Admin melihat semua pesan
            $messages = Message::with('user')
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            // Member hanya melihat pesan yang ia kirim
            $messages = Message::where('user_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->get();
        }

        return view('messages.index', compact('messages'));
    }

    /**
     * Menampilkan form untuk mengirim pesan baru (hanya untuk member).
     */
    public function create(Request $request)
    {
        $task_id = $request->input('task_id');
        return view('messages.create', compact('task_id'));
    }

    /**
     * Menyimpan pesan baru dari member.
     */
    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
            'task_id' => 'required|integer|exists:task_logs,id',
        ]);

        Message::create([
            'user_id' => Auth::id(),
            'message' => $request->input('message'),
            'task_id' => $request->input('task_id'),
            'response' => null, // Default response adalah null
            'is_replied' => false, // Default status balasan adalah false
        ]);

        return redirect()->route('messages.index')->with('success', 'Pesan berhasil dikirim.');
    }

    /**
     * Menampilkan form untuk membalas pesan (khusus admin).
     */
    public function showReplyForm($id)
    {
        $message = Message::findOrFail($id);

        // Pastikan hanya admin yang dapat mengakses form ini
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        return view('messages.reply', compact('message'));
    }

    /**
     * Menyimpan balasan pesan dari admin.
     */
    public function reply(Request $request, $id)
    {
        $request->validate([
            'response' => 'required|string|max:1000',
        ]);

        $message = Message::findOrFail($id);

        // Pastikan hanya admin yang dapat memberikan balasan
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $message->update([
            'response' => $request->input('response'),
            'is_replied' => true,
        ]);

        return redirect()->route('messages.index')->with('success', 'Balasan berhasil dikirim.');
    }

    /**
     * Menampilkan pesan individual.
     */
    public function show($id)
    {
        $message = Message::with('user', 'taskLog')->findOrFail($id);

        return view('messages.show', compact('message'));
    }
}
