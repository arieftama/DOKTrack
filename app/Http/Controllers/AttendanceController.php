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
        $attendanceLogs = AttendanceLog::where('user_id', auth()->user()->id)->get();
        return view('attendance', compact('attendanceLogs'));
    }

    /**
     * Melakukan check-in untuk user.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkIn(Request $request)
    {
        $existingCheckIn = AttendanceLog::where('user_id', auth()->user()->id)
                                ->where('date', now()->format('Y-m-d'))
                                ->first();
    
        if ($existingCheckIn) {
            return redirect()->back()->with('error', 'You have already checked in today.');
        }
    
        $attendance = new AttendanceLog();
        $attendance->user_id = auth()->user()->id;
        $attendance->date = now()->format('Y-m-d');
        $attendance->check_in = now()->format('H:i:s');
        $attendance->save();
    
        return redirect()->back()->with('success', 'Check-in successful');
    }
    

    /**
     * Melakukan check-out untuk user.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkOut(Request $request)
    {
        $attendance = AttendanceLog::where('user_id', auth()->user()->id)
                                ->where('date', now()->format('Y-m-d'))
                                ->first();
        if ($attendance) {
            $attendance->check_out = now()->format('H:i:s');
            $attendance->save();

            return redirect()->back()->with('success', 'Check-out successful');
        }

        return redirect()->back()->with('error', 'Check-in record not found');
    }
}