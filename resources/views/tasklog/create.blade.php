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
<form action="{{ isset($taskLog) ? route('tasklog.update', $taskLog->id) : route('tasklog.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="task_name">Nama Tugas</label>
        <input type="text" name="task_name" id="task_name" class="form-control" required value="{{ isset($taskLog) ? $taskLog->task_name : '' }}">
    </div>
    <div class="form-group">
        <label for="description">Deskripsi</label>
        <textarea name="description" id="description" class="form-control" required>{{ isset($taskLog) ? $taskLog->description : '' }}</textarea>
    </div>
    <div class="form-group">
        <label for="status">Status</label>
        <select name="status" id="status" class="form-control" required>
            <option value="pending" {{ isset($taskLog) && $taskLog->status == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="in_progress" {{ isset($taskLog) && $taskLog->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
            <option value="complete" {{ isset($taskLog) && $taskLog->status == 'complete' ? 'selected' : '' }}>Complete</option>
        </select>
    </div>
    <div class="form-group">
        <label for="time">Waktu</label>
        <input type="time" name="time" id="time" class="form-control" required value="{{ isset($taskLog) ? $taskLog->time : '' }}">
    </div>
    <div class="form-group">
        <label for="date">Tanggal</label>
        <input type="date" name="date" id="date" class="form-control" required value="{{ isset($taskLog) ? $taskLog->date : '' }}">
    </div>
    <div class="form-group">
        <label for="message">Pesan ke Admin</label>
        <textarea name="message" id="message" class="form-control">{{ isset($taskLog) && $taskLog->message ? $taskLog->message->message : '' }}</textarea>
    </div> 
    <button type="submit" class="btn btn-primary">{{ isset($taskLog) ? 'Update' : 'Simpan' }}</button>
</form>
</div>
@endsection

@section('plugins.chartjs', true)

