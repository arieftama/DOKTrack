@extends('layouts.main')

@section('title', 'Account Information')

@section('content_header')
    <h1>Account Information</h1>
@stop

@section('content')
<div class="container mt-5">
    <h1>Account Information</h1>
    <p><strong>Name:</strong> {{ $user->name }}</p>
    <p><strong>Email:</strong> {{ $user->email }}</p>
    <p><strong>Role:</strong> {{ $user->role }}</p>

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
</div>
@endsection
