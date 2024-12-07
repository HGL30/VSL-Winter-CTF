@extends('admin.admin')

@section('content-admin')
<div class="container">
      <table class="table table-striped align-middle">
        <thead>
          <tr>
            <th class="c1">Name</th>
            <th class="c2">Type</th>
            <th class="c3">Difficulty</th>
            <th class="c4">Panel</th>
          </tr>
        </thead>
        <tbody>
          @foreach($challenges as $challenge)
              <tr>
                  <td>{{ $challenge->challenge_name }}</td>
                  <td>{{ $challenge->type }}</td>
                  <td>{{ $challenge->difficulty }}</td>
                  <td>
                    <a href="{{ route('admin.challenge.edit', $challenge->challenge_name) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form class="d-inline-block" action="{{route('admin.challenge.destroy', $challenge->challenge_name)}}" method="POST">
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
<a class="create-button" style="width: 150px; height: 50px; background-color: green; color: white; font-size: 20px; font-weight: 500; border: none; border-radius: 10px; cursor: pointer; margin-left: 10px; text-decoration: none; display: flex; text-align: center; align-items: center; justify-content: center;" href="{{ route('admin.challenge.create') }}">Add Challenges</a>
@endsection