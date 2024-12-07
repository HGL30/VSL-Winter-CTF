@extends('admin.admin')

@section('content-admin')
<link rel="stylesheet" href="{{ asset('css/Teams.css') }}">
<div class="search-container">
    <form method="GET" action="{{ route('admin.teampanel') }}" class="search-bar">
        <!-- Ô chọn Tên (select) -->
        <select class="form-select" id="field" name="field" required>
            <!-- Các tùy chọn trong ô chọn (Tên, Tổ chức, Trang web) -->
            <option selected value="teamname">Name</option>
            <option value="group">Group</option>
            <option value="website">Website</option>
        </select>

        <!-- Ô input cho người dùng nhập nội dung tìm kiếm -->
        <input class="form-control search-input" id="q" name="q" placeholder="Text here to find" required type="text">

        <!-- Nút tìm kiếm -->
        <button type="submit" class="btn btn-primary search-btn">
            <!-- Icon kính lúp -->
            <i class="fa-solid fa-magnifying-glass" style="color: #ffffff;"></i>
        </button>
    </form>
</div>
<hr>
<div class="container">
      <table class="table table-striped align-middle">
        <thead>
          <tr>
            <th class="c1">Team</th>
            <th class="c2">Website</th>
            <th class="c3">Group</th>
            <th class="c4">Panel</th>
          </tr>
        </thead>
        <tbody>
          @foreach($teams as $team)
              <tr>
                  <td>
                    <a id="teamname" href="{{ url('/') }}">{{ $team->teamname }}</a>
                  </td>
                  <td>
                    <a id="website" href="{{ $team->website }}"><i class="fa-solid fa-arrow-up-right-from-square" style="color: #800080;"></i></a>
                  </td>
                  <td>{{ $team->group }}</td>
                  <td>
                    <a href="{{ route('admin.team.edit', $team->teamname) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form class="d-inline-block" action="{{route('admin.team.destroy', $team->teamname)}}" method="POST">
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
<a class="create-button" href="{{ route('admin.team.create') }}">Add Team</a>
@endsection