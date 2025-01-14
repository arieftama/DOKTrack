@extends('layouts.main')

@section('title', 'Laporan Absensi dan Log Tugas')

@section('content_header')
    <h1>Laporan Absensi dan Log Tugas</h1>
@stop

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Laporan Absensi dan Log Tugas</h1>

    <div class="mb-3">
        <a href="{{ route('report.exportPDF') }}" class="btn btn-danger">Export PDF</a>
        <a href="{{ route('report.exportExcel') }}" class="btn btn-success">Export Excel</a>
    </div>

    <!-- Informasi Umum -->
    <p><strong>Tanggal Cetak:</strong> {{ now()->format('d-m-Y H:i') }}</p>
    <p><strong>Disusun Oleh:</strong> {{ Auth::user()->name }}</p>

    <!-- Tabel Absensi -->
    <h2 class="mt-5">Laporan Absensi</h2>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Member</th>
                <th>Tanggal</th>
                <th>Check-in</th>
                <th>Check-out</th>
                <th>Durasi Kerja</th>
            </tr>
        </thead>
        <tbody>
            @foreach($attendanceLogs as $index => $log)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $log->user->name }}</td>
                    <td>{{ \Carbon\Carbon::parse($log->created_at)->format('d-m-Y') }}</td>
                    <td>{{ $log->check_in ?? '-' }}</td>
                    <td>{{ $log->check_out ?? '-' }}</td>
                    <td>{{ $log->duration ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Tabel Log Tugas -->
    <h2 class="mt-5">Laporan Log Tugas</h2>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Member</th>
                <th>Tanggal</th>
                <th>Nama File</th>
                <th>Sektor Tujuan</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($taskLogs as $index => $log)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $log->user->name }}</td>
                    <td>{{ \Carbon\Carbon::parse($log->created_at)->format('d-m-Y') }}</td>
                    <td>{{ $log->file_name }}</td>
                    <td>{{ $log->destination }}</td>
                    <td>{{ $log->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
