<?php

namespace App\Exports;

use App\Models\AttendanceLog;
use App\Models\TaskLog;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ReportExport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            new AttendanceSheetExport(),
            new TaskLogSheetExport(),
        ];
    }
}

class AttendanceSheetExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return AttendanceLog::with('user')
            ->get()
            ->map(function ($log) {
                return [
                    'Nama Member' => $log->user->name,
                    'Tanggal' => $log->created_at->format('d-m-Y'),
                    'Check-in' => $log->check_in,
                    'Check-out' => $log->check_out,
                    'Durasi' => $log->duration,
                ];
            });
    }

    public function headings(): array
    {
        return ['Nama Member', 'Tanggal', 'Check-in', 'Check-out', 'Durasi'];
    }
}

class TaskLogSheetExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return TaskLog::with('user')
            ->get()
            ->map(function ($log) {
                return [
                    'Nama Member' => $log->user->name,
                    'Tanggal' => $log->created_at->format('d-m-Y'),
                    'Nama File' => $log->file_name,
                    'Sektor Tujuan' => $log->destination,
                    'Status' => $log->status,
                ];
            });
    }

    public function headings(): array
    {
        return ['Nama Member', 'Tanggal', 'Nama File', 'Sektor Tujuan', 'Status'];
    }
}
