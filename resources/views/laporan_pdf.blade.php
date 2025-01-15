<!DOCTYPE html>
<html>
<head>
    <title>Laporan Absensi dan Log Tugas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1 class="text-center">Laporan Absensi dan Log Tugas</h1>

    <!-- Informasi Umum -->
    <p><strong>Tanggal Cetak:</strong> {{ now()->format('d-m-Y H:i') }}</p>
    <p><strong>Disusun Oleh:</strong> {{ Auth::user()->name }}</p>

    <!-- Tabel Absensi -->
    <h2>Laporan Absensi</h2>
    <table>
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
    <h2>Laporan Log Tugas</h2>
    <table>
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
</body>
</html>
