@extends('admin.admin')

@section('content-admin')
<link rel="stylesheet" href="{{ asset('css/Users.css') }}">
<div class="search-container">
    <form method="GET" action="{{ route('admin.userpanel') }}" class="search-bar">
        <select class="form-select" id="field" name="field" required>
            <option selected value="name">Name</option>
            <option value="group">Group</option>
            <option value="website">Website</option>
        </select>
        <input class="form-control search-input" id="username" name="username" placeholder="Type here to" required type="text">
        <button type="submit" class="btn btn-primary search-btn">
            <i class="fa-solid fa-magnifying-glass" style="color: #ffffff;"></i>
        </button>
    </form>
</div>
<hr>
<div class="container">
    <table class="table table-striped align-middle">
        <thead>
            <tr>
                <th class="c1">User</th>
                <th class="c2">Email</th>
                <th class="c3">Role</th>
                <th class="c4">Panel</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>
                    <a id="username" href="{{ url('/') }}">{{ $user->name }}</a>
                </td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role }}</td>
                <td>
                    <a href="{{ route('admin.user.edit', $user->name) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form class="d-inline-block" action="{{route('admin.user.destroy', $user->name)}}" method="POST">
                        {{ csrf_field() }}
                        @method('DELETE')
                        <input type="submit" value="Delete" class="btn btn-danger btn-sm">
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<a class="create-button" href="{{ route('admin.user.create') }}">Add Account</a>
@endsection