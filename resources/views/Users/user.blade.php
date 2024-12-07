@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/account/user.css') }}">
<div class="team-cont">
    <div class="header-layout">
        <label>{{ $users->name }}</label>
        <h2 id="teamname">{{ $users->team }}</h2>
        <div class="group-country">
            <h4>{{ $users->group }}</h4>
            <h4>{{ $users->country }}</h4>
        </div>
    </div>

    <div class="list-member">
        <p>Practices</p>
        <table class="table table-striped align-middle">
            <thead>
                <tr>
                    <th class="c1">challenge</th>
                    <th class="c2">Type</th>
                    <th class="c3">Difficulty</th>
                    <th class="c4">Time</th>
                </tr>
            </thead>
            <tbody>
                @foreach($submissions as $submission)
                    <tr id="member">
                        <td>{{ $submission->lab_name }}</td>
                        <td>{{ $submission->type }}</td>
                        <td>{{ $submission->difficulty }}</td>
                        <td>{{ $submission->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection