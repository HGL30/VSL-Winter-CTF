@extends('layouts.app')

@section('content')
<link rel="stylesheet" type="text/css" href="css/Teams.css">
<main role="main">
  <div class="jumbotron">
    <div class="container">
      <h1>Teams</h1>
    </div>
  </div>
  <div class="search-container">
    <form method="GET" action="{{ route('teams') }}" class="search-bar">
        <!-- Ô chọn Tên (select) -->
        <select class="form-select" id="field" name="field" required>
            <!-- Các tùy chọn trong ô chọn (Tên, Tổ chức, Trang web) -->
            <option selected value="teamname">Name</option>
            <option value="group">Affiliation</option>
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
            <th class="c3">Affiliation</th>
            <th class="c4">Country</th>
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
                  <td>{{ $team->country }}</td>
              </tr>
          @endforeach
        </tbody>
      </table>
  </div>
</main>
@endsection