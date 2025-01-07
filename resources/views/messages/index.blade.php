@extends('layouts.main')

@section('title', 'Daftar Pesan')

@section('content')
<div class="container">
    <h1>Daftar Pesan</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Pengirim</th>
                <th>Pesan</th>
                <th>Balasan</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($messages as $message)
                <tr>
                    <td>{{ $message->user->name }}</td>
                    <td>{{ $message->message }}</td>
                    <td>{{ $message->response ?? 'Belum ada balasan' }}</td>
                    <td>{{ $message->created_at }}</td>
                    <td>
                        <a href="{{ route('messages.show', $message->id) }}" class="btn btn-info">Lihat</a>
                        @if (Auth::user()->role === 'admin' && !$message->response)
                            <a href="{{ route('admin.messages.reply_form', $message->id) }}" class="btn btn-primary">Balas</a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
