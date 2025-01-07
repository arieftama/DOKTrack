@extends('layouts.main')

@section('title', 'Balas Pesan')

@section('content')
<div class="container">
    <h1>Balas Pesan</h1>

    <div class="alert alert-info">
        <strong>Pesan Asli:</strong>
        <p>{{ $message->message }}</p>
    </div>

    {{-- Form untuk membalas pesan --}}
    <form action="{{ route('admin.messages.reply', $message->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="response">Balasan</label>
            <textarea name="response" id="response" class="form-control" rows="5" placeholder="Tulis balasan Anda di sini..." required></textarea>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Kirim Balasan</button>
    </form>
</div>
@endsection
