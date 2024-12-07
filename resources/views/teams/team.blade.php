@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/account/team.css') }}">
<div class="team-cont">
    <div class="header-layout">
        <h1>{{ $teams->teamname}}</h1>
        <div class="group-country">
            <h4>{{ $teams->group }}</h4>
            <h4>{{ $teams->country }}</h4>
        </div>
        <h2>Ranks: {{ $teams->rank }} <small>place</small></h2>
        <h2>Points: {{ $teams->score }}pts</h2>
        <div style="display: flex; gap: 5px;">
        @php
            $check = DB::table('teams')->where('team_leader', Auth::user()->name)->first();
        @endphp
        @if($check)
            <a href="{{ route('teams.edit', $teams->teamname) }}" class="btn btn-warning btn-sm">Edit</a>
            <form action="{{route('teams.destroy')}}" method="POST">
                {{ csrf_field() }}
                @method('DELETE')
                <input type="submit" value="Delete" class="btn btn-danger btn-sm">
            </form>
        
        @endif
        @if (!$check)
            <form action="{{route('teams.out')}}" method="POST">
                {{ csrf_field() }}
                @method('DELETE')
                <input type="submit" value="Outteam" class="btn btn-danger btn-sm">
            </form>
        @endif
        </div>
    </div>
    <div class="list-member">
        <p>Members</p>
        <table class="table table-striped align-middle">
            <thead>
                <tr>
                    <th class="c1">User Name</th>
                    <th class="c2">Score</th>
                </tr>
            </thead>
            <tbody>
                @foreach($members as $member)
                    <tr id="member">
                        <td>
                            <a id="username" href="{{ url('/') }}">{{ $member->name }}</a>
                        </td>
                        @php 
                            $point = DB::table('users')->where('name', $member->name)->first();
                            @endphp
                        <td>{{ $point->score }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="list-member">
        <p>Solves</p>
        <table class="table table-striped align-middle">
            <thead>
                <tr>
                    <th class="c1">challenge</th>
                    <th class="c2">Type</th>
                    <th class="c3">Points</th>
                    <th class="c4">Time</th>
                </tr>
            </thead>
            <tbody>
                @foreach($submissions as $submission)
                    <tr id="member">
                        <td>{{ $submission->challenge_name }}</td>
                        <td>{{ $submission->type }}</td>
                        <td>{{ $submission->value }}</td>
                        <td>{{ $submission->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="challenges-solved"></div>
</div>
@endsection