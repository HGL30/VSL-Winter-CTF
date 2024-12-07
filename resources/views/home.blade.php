@extends('layouts.app')

@section('content')
<div class="container" style="background-color: white;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="display: flex; align-items: center; justify-content: center;">
                    <p style="font-size: larger;">Welcome to VSLCTF !</p>
                </div>

                <div class="card-body" style="display: flex; gap: 50px; align-items: center; justify-content: center;">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @php
                        $check = DB::table('team_members')->where('name', Auth::user()->name)->first();
                    @endphp
                    @if(!$check)
                    <a href="{{ route('teams.create') }}" style="width: 200px; height: 50px; border-radius: 10px; background-color: purple; border: none; color: white; font-size:larger; display: flex; align-items: center; justify-content: center; text-decoration: none;"><b>Create Team</b></a>
                    <a href="{{ route('teams.join') }}" style="width: 200px; height: 50px; border-radius: 10px; background-color: purple; border: none; color: white; font-size:larger; display: flex; align-items: center; justify-content: center; text-decoration: none;"><b>Join Team</b></a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
