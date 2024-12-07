@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/challenges.css') }}">
<div class="title">
    <h1>Challenges</h1>
</div>
@php
    $checkchall = DB::table('challenges')->get();
@endphp
@if ($checkchall->isEmpty())
    <div class="practice-content">
        <h2 style="font-size: 36px;">Challenges has not started yet !</h2>
    </div>
@else
<div class="practice-content">
    <div class="list-labs">
        @php
            $checkchall = DB::table('challenges')->where('type', 'forensics')->get();
        @endphp
        @if ($checkchall->isEmpty())
        @else
        <div class="chall-title">
            <h2>Forensics</h2>
        </div>
        <div class="forensics-chall">
            @foreach ($challenges as $challenge)
                @if ($challenge->type === 'forensics')
                    @php
                        $submission = DB::table('challengesubmission')->where('challenge_name', $challenge->challenge_name)->where('name', auth()->user()->team)->first();
                    @endphp
                    @if ($submission && $submission->locked)
                        <a href="{{ route('challenge.show', $challenge->challenge_name) }}" class="lab-close">
                            <p id="name">{{ $challenge->challenge_name }}</p> 
                            <p id="point">{{ $challenge->points }}</p>
                        </a>
                    @elseif (!$submission)         
                        <a href="{{ route('challenge.show', $challenge->challenge_name) }}" class="lab-open">
                            <p id="name">{{ $challenge->challenge_name }}</p> 
                            <p id="point">{{ $challenge->points }}</p>
                        </a>
                    @endif
                @endif
            @endforeach
        </div>
        @endif
        @php
            $checkchall = DB::table('challenges')->where('type', 'web')->get();
        @endphp
        @if ($checkchall->isEmpty())
        @else
        <div class="chall-title">
            <h2>Web Exploitation</h2>
        </div>
        <div class="web-chall">
        @foreach ($challenges as $challenge)
                @if ($challenge->type === 'web')
                    @php
                        $submission = DB::table('challengesubmission')->where('challenge_name', $challenge->challenge_name)->where('name', auth()->user()->team)->first();
                    @endphp
                    @if ($submission && $submission->locked)
                        <a href="{{ route('challenge.show', $challenge->challenge_name) }}" class="lab-close">
                            <p id="name">{{ $challenge->challenge_name }}</p> 
                            <p id="point">{{ $challenge->points }}</p>
                        </a>
                    @elseif (!$submission)         
                        <a href="{{ route('challenge.show', $challenge->challenge_name) }}" class="lab-open">
                            <p id="name">{{ $challenge->challenge_name }}</p> 
                            <p id="point">{{ $challenge->points }}</p>
                        </a>
                    @endif
                @endif
            @endforeach

        </div>
        @endif
        @php
            $checkchall = DB::table('challenges')->where('type', 'reverse')->get();
        @endphp
        @if ($checkchall->isEmpty())
        @else
        <div class="chall-title">
            <h2>Reverse Engineering</h2>
        </div>
        <div class="reverse-chall">
        @foreach ($challenges as $challenge)
                @if ($challenge->type === 'reverse')
                    @php
                        $submission = DB::table('challengesubmission')->where('challenge_name', $challenge->challenge_name)->where('name', auth()->user()->team)->first();
                    @endphp
                    @if ($submission && $submission->locked)
                        <a href="{{ route('challenge.show', $challenge->challenge_name) }}" class="lab-close">
                            <p id="name">{{ $challenge->challenge_name }}</p> 
                            <p id="point">{{ $challenge->points }}</p>
                        </a>
                    @elseif (!$submission)         
                        <a href="{{ route('challenge.show', $challenge->challenge_name) }}" class="lab-open">
                            <p id="name">{{ $challenge->challenge_name }}</p> 
                            <p id="point">{{ $challenge->points }}</p>
                        </a>
                    @endif
                @endif
            @endforeach
        </div>
        @endif
        @php
            $checkchall = DB::table('challenges')->where('type', 'crypto')->get();
        @endphp
        @if ($checkchall->isEmpty())
        @else
        <div class="chall-title">
            <h2>Cryptography</h2>
        </div>
        <div class="crypto-chall">
        @foreach ($challenges as $challenge)
                @if ($challenge->type === 'crypto')
                    @php
                        $submission = DB::table('challengesubmission')->where('challenge_name', $challenge->challenge_name)->where('name', auth()->user()->team)->first();
                    @endphp
                    @if ($submission && $submission->locked)
                        <a href="{{ route('challenge.show', $challenge->challenge_name) }}" class="lab-close">
                            <p id="name">{{ $challenge->challenge_name }}</p> 
                            <p id="point">{{ $challenge->points }}</p>
                        </a>
                    @elseif (!$submission)         
                        <a href="{{ route('challenge.show', $challenge->challenge_name) }}" class="lab-open">
                            <p id="name">{{ $challenge->challenge_name }}</p> 
                            <p id="point">{{ $challenge->points }}</p>
                        </a>
                    @endif
                @endif
            @endforeach
        </div>
        @endif
        @php
            $checkchall = DB::table('challenges')->where('type', 'osint')->get();
        @endphp
        @if ($checkchall->isEmpty())
        @else
        <div class="chall-title">
            <h2>OSINT</h2>
        </div>
        <div class="osint-chall">
            @foreach ($challenges as $challenge)
                @if ($challenge->type === 'osint')
                    @php
                        $submission = DB::table('challengesubmission')->where('challenge_name', $challenge->challenge_name)->where('name', auth()->user()->team)->first();
                    @endphp
                    @if ($submission && $submission->locked)
                        <a href="{{ route('challenge.show', $challenge->challenge_name) }}" class="lab-close">
                            <p id="name">{{ $challenge->challenge_name }}</p> 
                            <p id="point">{{ $challenge->points }}</p>
                        </a>
                    @elseif (!$submission)         
                        <a href="{{ route('challenge.show', $challenge->challenge_name) }}" class="lab-open">
                            <p id="name">{{ $challenge->challenge_name }}</p> 
                            <p id="point">{{ $challenge->points }}</p>
                        </a>
                    @endif
                @endif
            @endforeach
        </div>
        @endif
        @php
            $checkchall = DB::table('challenges')->where('type', 'pwn')->get();
        @endphp
        @if ($checkchall->isEmpty())
        @else
        <div class="chall-title">
            <h2>Binary Exploitation</h2>
        </div>
        <div class="pwn-chall">
        @foreach ($challenges as $challenge)
                @if ($challenge->type === 'pwn')
                    @php
                        $submission = DB::table('challengesubmission')->where('challenge_name', $challenge->challenge_name)->where('name', auth()->user()->team)->first();
                    @endphp
                    @if ($submission && $submission->locked)
                        <a href="{{ route('challenge.show', $challenge->challenge_name) }}" class="lab-close">
                            <p id="name">{{ $challenge->challenge_name }}</p> 
                            <p id="point">{{ $challenge->points }}</p>
                        </a>
                    @elseif (!$submission)         
                        <a href="{{ route('challenge.show', $challenge->challenge_name) }}" class="lab-open">
                            <p id="name">{{ $challenge->challenge_name }}</p> 
                            <p id="point">{{ $challenge->points }}</p>
                        </a>
                    @endif
                @endif
            @endforeach
        </div>
        @endif
    </div>
</div>
@endif
@endsection