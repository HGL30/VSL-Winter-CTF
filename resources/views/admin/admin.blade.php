@extends('layouts.app')

@section('content')
<div class="content-admin">
    <div class="left-content">
        <div class="admin-avt">
            <img src="{{ asset('Photo/admin-avt.jpg') }}" alt="admin">
        </div>
        <div class="welcome-admin">
            <p>Hello admin, {{ Auth::user()->name }} !</p>
            <div class="white-line"></div>
        </div>
        <div class="list-panel">
            <div class="user-panel">
                <a href="{{ route('admin.userpanel') }}">Users Panel</a>
            </div>
            <div class="team-panel">
                <a href="{{ route('admin.teampanel') }}">Teams Panel</a>
            </div>
            <div class="practice-panel">
                <a href="{{ route('admin.practicepanel') }}">Practices Panel</a>
            </div>
            <div class="chall-panel">
                <a href="{{ route('admin.challengepanel') }}">Challenges Panel</a>
            </div>
        </div>
    </div>
    <div class="right-content">
        @yield('content-admin')
    </div>
</div>
@endsection
