@extends('admin.admin')

@section('content-admin')
<h5 style="font-weight: bold; font-size: 32px; margin-top: 30px; margin-left: 20px;">Edit User</h5>
<div class="container">
    <div class="row">
        <div class="col-sm-10">
            <form action="{{ route('admin.update',$user->name)}}" method="post">
                {{ csrf_field() }}
                @method('PUT')
                <div class="form-group">
                    <label for="name" style="font-weight: bold;">Name:</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" style="width: 500px;">
                </div>
                <div class="form-group">
                    <label for="email" style="font-weight: bold;">Email:</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}" style="width: 500px;">
                </div>
                <div class="forma-group">
                    <label for="productName" style="font-weight: bold;">Password:</label>
                    <input type="password" name="password" id="password" class="form-control" value="{{ $user->password }}" style="width: 500px;">
                </div>
                <div class="form-group">
                    <label for="role" style="font-weight: bold;">Role:</label>
                    <select name="role" id="role" class="form-control" style="width: 500px;">
                        <option value="admin">admin</option>
                        <option value="user">user</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="score" style="font-weight: bold;">Score:</label>
                    <input type="text" name="score" id="score" class="form-control" value="{{ $user->score }}" style="width: 500px;">
                </div>
                <div class="form-group" style="margin-top: 10px;">
                    <input class="btn btn-info btn-sm" type="submit" value="Save">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection