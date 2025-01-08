@extends('layouts.main')

@section('title', 'Kirim Pesan')

@section('content')
<div class="container">
    <h1>Kirim Pesan Baru</h1>

    {{-- Menampilkan pesan sukses atau error --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form kirim pesan --}}
    <form action="{{ route('messages.store') }}" method="POST">
        @csrf
        @if(isset($task_id))
            <input type="hidden" name="task_id" value="{{ $task_id }}">
        @endif
        <div class="form-group">
            <label for="message">Pesan</label>
            <textarea name="message" id="message" class="form-control" rows="5" placeholder="Tulis pesan Anda di sini..." required></textarea>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Kirim</button>
    </form>
</div>
@endsection
