@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/practices.css') }}">
<div class="title">
    <h1>Practices</h1>
</div>
<div class="practice-content">
    <form method="GET" action="{{ route('practices') }}">
        <label for="type"><i class="fa-solid fa-filter" style="color: #000000;"></i>  Filter by Type:</label>
        <select name="type" id="type">
            <option value="">All</option>
            <option value="Forensics">Forensics</option>
            <option value="Web">Web Exploitation</option>
            <option value="Reverse">Reverse Engineering</option>
            <option value="Crypto">Cryptography</option>
            <option value="osint">OSINT</option>
            <option value="PWN">PWN</option>
        </select>
        <button type="submit">Filter </button>
    </form>
    <div class="white-space"></div>
    <div class="list-labs">
        @foreach ($labs as $lab)
            @php
                $submission = DB::table('submissions')->where('lab_name', $lab->name)->where('name', auth()->user()->name)->first();
            @endphp
            @if ($submission && $submission->locked)
                <a href="{{ route('lab.show', $lab->name) }}" class="lab-close">
                    <p id="difficult">Difficulty: <strong>{{ $lab->difficulty }}</strong></p>
                    <p id="name">{{ $lab->name }}</p> 
                </a>
            @elseif (!$submission)         
                <a href="{{ route('lab.show', $lab->name) }}" class="lab-open">
                    <p id="difficult">Difficulty: <strong>{{ $lab->difficulty }}</strong></p>
                    <p id="name">{{ $lab->name }}</p> 
                </a>
            @endif
        @endforeach
    </div>
</div>
@endsection