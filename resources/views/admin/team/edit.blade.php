@extends('admin.admin')

@section('content-admin')
<h5 style="font-weight: bold; font-size: 32px; margin-top: 30px; margin-left: 20px;">Edit Team</h5>
<div class="container">
    <div class="row">
        <div class="col-sm-10">
            <form action="{{ route('admin.team.update',$team->teamname)}}" method="post">
                {{ csrf_field() }}
                @method('PUT')
                <div class="form-group">
                    <label for="teamname" style="font-weight: bold;">Name:</label>
                    <input type="text" name="teamname" id="teamname" class="form-control" value="{{ $team->teamname }}" style="width: 300px;">
                </div>
                <div class="form-group">
                    <label for="group" style="font-weight: bold;">Affiliation:</label>
                    <input type="text" name="group" id="group" class="form-control" value="{{ $team->group }}" style="width: 300px;">
                </div>
                <div class="forma-group">
                    <label for="password" style="font-weight: bold;">Password:</label>
                    <input type="password" name="password" id="password" class="form-control" value="{{ $team->password }}" style="width: 500px;">
                </div>
                <div class="form-group">
                    <label for="score" style="font-weight: bold;">Score:</label>
                    <input type="text" name="score" id="score" class="form-control" value="{{ $team->score }}" style="width: 300px;">
                </div>
                <div class="form-group" style="margin-top: 10px;">
                    <input class="btn btn-info btn-sm" type="submit" value="Save">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection