@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/account/editteam.css') }}">
<div class="title">
    <h1>Edit Team</h1>
</div>
<div class="content-edit">
    <div class="form-edit">
        <form action="{{ route('teams.update',$team->teamname)}}" method="post">
            {{ csrf_field() }}
            @method('PUT')
            <div class="form-group">
                <label for="teamname" style="font-weight: bold;">Team Name:</label>
                <input type="text" name="teamname" id="teamname" class="form-control" value="{{ $team->teamname }}">
            </div>
            <div class="form-group">
                <label for="password" style="font-weight: bold;">Password:</label>
                <input type="password" name="password" id="password" class="form-control" value="{{ $team->password }}">
            </div>
            <div class="form-group" style="display: flex; flex-direction: column;">
                <label for="leader" style="font-weight: bold;">Team Leader:</label>
                <select name="team_leader" id="team_leader">
                    @foreach($team_member as $member)
                        <option value="{{ $member->name }}">{{ $member->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="group" style="font-weight: bold;">Website:</label>
                <input type="link" name="website" id="website" class="form-control" value="{{ $team->website }}">
            </div>
            <div class="form-group">
                <label for="group" style="font-weight: bold;">Affiliation:</label>
                <input type="text" name="group" id="group" class="form-control" value="{{ $team->group }}">
            </div>
            <div class="form-group">
                <label for="group" style="font-weight: bold;">Country:</label>
                <input type="text" name="country" id="country" class="form-control" value="{{ $team->country }}">
            </div>
            <div class="form-group">
                <input class="btn btn-info btn-sm" type="submit" value="Save">
            </div>
        </form>
    </div>
</div>
@endsection