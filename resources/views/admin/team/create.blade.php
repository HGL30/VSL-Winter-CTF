@extends('admin.admin')

@section('content-admin')
<h5 style="font-weight: bold; font-size: 32px; margin-top: 30px; margin-left: 20px;">Add Team</h5>
<div class="container" style="width: 100%; display: flex; flex-direction: column; align-items: left;">
    <div class="row">
        <div class="col-sm-10">
            <form action="{{ route('admin.team.store')}}" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="teamname" style="font-weight: bold;">Name:</label>
                    <input type="text" name="teamname" id="teamname" class="form-control" style="width: 300px;">
                </div>
                <div class="form-group">
                    <label for="password" style="font-weight: bold;">Password:</label>
                    <input type="password" name="password" id="password" class="form-control" style="width: 300px;">
                </div>
                <div class="form-group" style="margin-top: 10px;">
                    <input class="btn btn-info btn-sm" type="submit" value="Create Team">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection