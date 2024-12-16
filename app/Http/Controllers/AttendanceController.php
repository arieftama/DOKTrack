<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\AttendanceLog;

class AttendanceController extends Controller
{
    /**
     * Menampilkan form absensi.
     *
     * @return \Illuminate\View\View
     */
    public function showForm()
    {
        return view('attendance');
    }

    /**
     * Melakukan check-in untuk user.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkIn(Request $request)
    {
        $user = Auth::user(); // Mendapatkan user yang sedang login
        $today = now()->format('Y-m-d'); // Format tanggal saat ini

        // Cek apakah user sudah check-in
        $attendance = AttendanceLog::firstOrCreate(
            ['user_id' => $user->id, 'date' => $today], // Kriteria unik
            ['check_in' => now()] // Jika belum ada, set 'check_in'
        );

        return response()->json([
            'message' => 'Check-in berhasil',
            'data' => $attendance,
        ]);
    }

    /**
     * Melakukan check-out untuk user.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkOut(Request $request)
    {
        $user = Auth::user(); // Mendapatkan user yang sedang login
        $today = now()->format('Y-m-d'); // Format tanggal saat ini

        // Cek apakah user sudah check-in
        $attendance = AttendanceLog::where('user_id', $user->id)
            ->where('date', $today)
            ->first();

        if ($attendance && !$attendance->check_out) {
            $attendance->check_out = now();
            $attendance->save();

            return response()->json([
                'message' => 'Check-out berhasil',
                'data' => $attendance,
            ]);
        }

        return response()->json([
            'message' => 'Check-out gagal, Anda belum check-in atau sudah check-out',
        ], 400);
    }
}