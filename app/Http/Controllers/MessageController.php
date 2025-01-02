<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;

class MessageController extends Controller
{
    // Menampilkan daftar pesan untuk member
    public function index()
    {
        $messages = Message::where('user_id', Auth::id())->get();
        return view('messages.index', compact('messages'));
    }

    // Form untuk mengirim pesan baru
    public function create()
    {
        return view('messages.create');
    }

    // Menyimpan pesan baru dari member
    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        Message::create([
            'user_id' => Auth::id(),
            'message' => $request->input('message'),
        ]);

        return redirect()->route('messages.index')->with('success', 'Pesan berhasil dikirim.');
    }

    // Menampilkan daftar pesan untuk admin
    public function adminIndex()
    {
        $messages = Message::with('user')->get(); // Ambil semua pesan dengan informasi user
        return view('admin.messages.index', compact('messages'));
    }

    // Tanggapan admin terhadap pesan
    public function respond(Request $request, $id)
    {
        $request->validate([
            'response' => 'required|string|max:1000',
        ]);

        $message = Message::findOrFail($id);
        $message->update([
            'response' => $request->input('response'),
        ]);

        return redirect()->route('admin.messages.index')->with('success', 'Tanggapan berhasil dikirim.');
    }
}
