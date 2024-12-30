<!-- filepath: /C:/laragon/www/DOKTrack/resources/views/attendance.blade.php -->
@extends('layouts.main')

@section('title', 'Attendance')   

@section('content_header')
    <h1>Attendance</h1>
@stop

@section('content')
    <div class="container">
        <h1 class="mt-5">Absensi Hari Ini</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('attendance.checkIn') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="check_in" class="form-label">Waktu Check-in</label>
                <input type="text" class="form-control" id="check_in" name="check_in" value="{{ now()->format('H:i:s') }}" readonly>
            </div>
            <button type="submit" class="btn btn-primary">Check-in</button>
        </form>

        <form action="{{ route('attendance.checkOut') }}" method="POST" class="mt-3">
            @csrf
            <div class="mb-3">
                <label for="check_out" class="form-label">Waktu Check-out</label>
                <input type="text" class="form-control" id="check_out" name="check_out" value="{{ now()->format('H:i:s') }}" readonly>
            </div>
            <button type="submit" class="btn btn-secondary">Check-out</button>
        </form>

        <h2 class="mt-5">Log Absensi</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Waktu Check-in</th>
                    <th>Waktu Check-out</th>
                </tr>
            </thead>
            <tbody>
                @foreach($attendanceLogs as $log)
                    <tr>
                        <td>{{ $log->date }}</td>
                        <td>{{ $log->check_in }}</td>
                        <td>{{ $log->check_out ?? 'Belum Check-out' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
@endsection