@extends('layouts.main')

@section('title', 'Task Log')   

@section('content_header')
    <h1>Task Log</h1>
@stop

@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@section('content')
<div class="container">
<form action="{{ route('tasklog.storeWithMessage') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="task_name">Nama Tugas</label>
        <input type="text" name="task_name" id="task_name" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="description">Deskripsi</label>
        <textarea name="description" id="description" class="form-control" required></textarea>
    </div>
    <div class="form-group">
    <label for="status">Status</label>
    <select name="status" id="status" class="form-control" required>
        <option value="pending">Pending</option>
        <option value="in_progress">In Progress</option>
        <option value="complete">Complete</option>
    </select>
</div>
    <div class="form-group">
        <label for="time">Waktu</label>
        <input type="time" name="time" id="time" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="date">Tanggal</label>
        <input type="date" name="date" id="date" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="message">Pesan ke Admin</label>
        <textarea name="message" id="message" class="form-control"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
</form>
</div>
@endsection

@section('plugins.chartjs', true)

