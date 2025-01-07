@extends('layouts.main')

@section('title', 'Detail Pesan')

@section('content')
<div class="container">
    <h1>Detail Pesan</h1>

    <div class="alert alert-info">
        <strong>Pengirim:</strong> {{ $message->user->name }}<br>
        <strong>Pesan:</strong>
        <p>{{ $message->message }}</p>
    </div>

    @if ($message->response)
        <div class="alert alert-success">
            <strong>Balasan:</strong>
            <p>{{ $message->response }}</p>
        </div>
    @endif

    <a href="{{ route('messages.index') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection
