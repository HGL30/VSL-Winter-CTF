@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/account/createteam.css') }}">
<div class="title">
    <h1>Create Team</h1>
</div>
<div class="create-team-cont">
    <form method="POST" action="{{ route('teams.create') }}">
        @csrf
        <label for="name">Team Name:</label>
        <input type="text" name="teamname" required>
        <label for="description">Password:</label>
        <input type="password" name="password" required>
        <button type="submit">Create Team</button>
    </form>
</div>
@if(session('success'))
    <div class="alert alert-success mt-3">{{ session('success') }}</div>
@elseif(session('error'))
    <div class="alert alert-danger mt-3">{{ session('error') }}</div>
@endif
@endsection