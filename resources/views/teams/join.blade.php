@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/account/createteam.css') }}">
<div class="title">
    <h1>Join Team</h1>
</div>
<div class="create-team-cont">
    <form method="POST" action="{{ route('teams.join') }}">
        @csrf
        <label for="name">Team Name:</label>
        <input type="text" name="teamname" required>
        <label for="description">Password:</label>
        <input type="password" name="password" required>
        <button type="submit">Join Team</button>
    </form>
    @if(session('success'))
        <div class="alert alert-success mt-3">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger mt-3">{{ session('error') }}</div>
    @endif
</div>
@endsection