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
        // Ambil log absensi user untuk hari ini
        $todayLog = AttendanceLog::where('user_id', auth()->user()->id)
            ->where('date', now()->format('Y-m-d'))
            ->first();

        // Ambil semua log absensi user
        $attendanceLogs = AttendanceLog::where('user_id', auth()->user()->id)->get();

        // Data default untuk input
        $checkInTime = $todayLog->check_in ?? null;
        $checkOutTime = $todayLog->check_out ?? null;

        return view('attendance', compact('attendanceLogs', 'checkInTime', 'checkOutTime'));
    }

    /**
     * Melakukan check-in untuk user.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function checkIn(Request $request)
    {
        // Cek apakah sudah check-in hari ini
        $existingCheckIn = AttendanceLog::where('user_id', auth()->user()->id)
            ->where('date', now()->format('Y-m-d'))
            ->first();

        if ($existingCheckIn) {
            return redirect()->back()->with('error', 'Anda sudah melakukan check-in hari ini.');
        }

        // Simpan data check-in
        $attendance = new AttendanceLog();
        $attendance->user_id = auth()->user()->id;
        $attendance->date = now()->format('Y-m-d');
        $attendance->check_in = now()->format('H:i:s');
        $attendance->save();

        return redirect()->back()->with('success', 'Check-in berhasil.');
    }

    /**
     * Melakukan check-out untuk user.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function checkOut(Request $request)
    {
        // Ambil log absensi hari ini
        $attendance = AttendanceLog::where('user_id', auth()->user()->id)
            ->where('date', now()->format('Y-m-d'))
            ->first();

        if ($attendance) {
            if ($attendance->check_out) {
                return redirect()->back()->with('error', 'Anda sudah melakukan check-out hari ini.');
            }

            // Simpan waktu check-out
            $attendance->check_out = now()->format('H:i:s');
            $attendance->save();

            return redirect()->back()->with('success', 'Check-out berhasil.');
        }

        return redirect()->back()->with('error', 'Data check-in tidak ditemukan. Silakan lakukan check-in terlebih dahulu.');
    }
}
