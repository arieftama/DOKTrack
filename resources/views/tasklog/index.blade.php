@extends('layouts.main')

@section('content')
<div class="container">
    <h1>Riwayat Log Tugas</h1>

    {{-- Menampilkan pesan sukses atau error --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @elseif (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    {{-- Tabel log tugas --}}
    @if ($taskLogs->isEmpty())
        <p>Tidak ada log tugas yang ditemukan.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Tugas</th>
                    <th>Deskripsi</th>
                    <!-- <th>Divisi</th> -->
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th>Waktu</th>
                    <th>Pesan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($taskLogs as $index => $log)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $log->task_name }}</td>
                        <td>{{ $log->description }}</td>
                        <!-- <td>{{ $log->division }}</td> -->
                        <td>{{ $log->status }}</td>
                        <td>{{ $log->date }}</td>
                        <td>{{ $log->timestamp }}</td>
                        <td>
                            @if ($log->message)
                                <strong></strong> {{ $log->message->message }}
                            @else
                                No message
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('tasklog.edit', $log->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('tasklog.delete', $log->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
