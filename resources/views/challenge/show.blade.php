@extends('layouts.app')

@section('content')
<div class="container mt-4" style="min-height: 70vh;">
    <h1 class="display-4">{{ $challenge->challenge_name }}</h1>
    <p>{{ $challenge->description }}</p>
    <p><strong>Difficulty:</strong> {{ $challenge->difficulty }}</p>

    <ul class="list-unstyled">
        <li>File:<a href="{{ route('download', ['name' => $challenge->challenge_name]) }}" class="btn btn-link" style="color: purple; font-size: 18px;">Source here</a></li>
        <li>Link:<a href="{{ $challenge->link }}" target="_blank" class="btn btn-link" style="color: purple; font-size: 18px;">{{ $challenge->link }}</a></li>
    </ul>

    <form action="{{ route('submit.challenge', $challenge->challenge_name) }}" method="POST" class="mt-4">
        @csrf
        <div class="mb-3">
            <label for="flag" class="form-label">Submit Flag:</label>
            <input type="text" name="flag" id="flag" class="form-control" style="width: 400px;" required>
        </div>
        <button type="submit" class="btn btn-primary" style="background-color: purple; border: none;">Submit</button>
    </form>

    @if(session('success'))
        <div class="alert alert-success mt-3">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger mt-3">{{ session('error') }}</div>
    @endif
</div>

@endsection
