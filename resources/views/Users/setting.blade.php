@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{asset('css/account/setting.css')}}">
<div class="title">
    <h1>Settings</h1>
</div>
<div class="user-info">
    <form action="{{ route('users.update',$user->name)}}" method="post">
        {{ csrf_field() }}
        @method('PUT')
        <div class="infor-part">
            <label for="name" style="font-weight: bold;">Name:</label>
            <input type="text" name="name" id="name" class="input-data" value="{{ $user->name }}" style="width: 500px;">
        </div>
        <div class="infor-part">
            <label for="email" style="font-weight: bold;">Email:</label>
            <input type="email" name="email" id="email" class="input-data" value="{{ $user->email }}" style="width: 500px;">
        </div>
        <div class="infor-part">
            <label for="productName" style="font-weight: bold;">Current Password:</label>
            <input type="password" name="curpassword" id="curpassword" class="input-data" value="{{ $user->password }}" style="width: 500px;">
        </div>
        <div class="infor-part">
            <label for="productName" style="font-weight: bold;">New Password:</label>
            <input type="password" name="password" id="password" class="input-data" value="" style="width: 500px;">
        </div>
        <div class="infor-part">
            <label for="name" style="font-weight: bold;">Website:</label>
            <input type="link" name="website" id="website" class="input-data" value="{{ $user->website }}" style="width: 500px;">
        </div>
        <div class="infor-part">
            <label for="name" style="font-weight: bold;">Affiliation:</label>
            <input type="text" name="group" id="group" class="input-data" value="{{ $user->group }}" style="width: 500px;">
        </div>
        <div class="infor-part">
            <label for="name" style="font-weight: bold;">Country:</label>
            <input type="text" name="country" id="country" class="input-data" value="{{ $user->country }}" style="width: 500px;">
        </div>
        <div class="button-save">
            <input class="button" type="submit" value="Save">
        </div>
    </form>
</div>
@if(session('success'))
    <div class="alert alert-success mt-3">{{ session('success') }}</div>
@elseif(session('error'))
    <div class="alert alert-danger mt-3">{{ session('error') }}</div>
@endif
@endsection