<?php

namespace App\Http\Controllers;

use App\Models\AttendanceLog;
use App\Models\TaskLog;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReportExport;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function __construct()
    {
        // Ensure the controller is properly initialized
        $this->middleware('auth');
    }

    public function index()
    {
        $attendanceLogs = AttendanceLog::all();
        $taskLogs = TaskLog::all();

        return view('laporan', compact('attendanceLogs', 'taskLogs'));
    }

    public function exportPDF()
    {
        $attendanceLogs = AttendanceLog::all();
        $taskLogs = TaskLog::all();

        // Gunakan view khusus untuk PDF
        $pdf = PDF::loadView('laporan_pdf', compact('attendanceLogs', 'taskLogs'))->setPaper('a4', 'landscape');
        return $pdf->download('laporan_absensi_log_tugas.pdf');
    }


    public function exportExcel()
    {
        return Excel::download(new ReportExport, 'laporan.xlsx');
    }
}
