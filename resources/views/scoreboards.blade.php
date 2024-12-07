@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/scoreboards.css') }}">
<div class="title">
    <h1>Scoreboards</h1>
</div>
@php
    $checkchall = DB::table('challenges')->get();
@endphp
@if ($checkchall->isEmpty())
    <div class="error-content">
        <h2 style="font-size: 36px;">Challenges has not started yet !</h2>
    </div>
@else
    <div class="practice-content">
        <table class="table table-striped align-middle">
            <thead>
                <tr>
                    <th>Rank</th>
                    <th>User</th>
                    <th>Total Score</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($leaderboard as $leaderboard => $player)
                    <tr>
                        <td id="place">{{ $leaderboard + 1 }}</td>
                        @php
                            DB::table('teams')->where('teamname', $player->teamname)->update(['rank'=> $leaderboard + 1]);
                        @endphp
                        <td>
                            <a id="teamname" href="{{ route('teams.team') }}">{{ $player->teamname }}</a>
                        </td>
                        <td id="score">{{ $player->score }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif
@endsection