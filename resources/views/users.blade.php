@extends('layouts.app')
@section('content')

  <div class="section supplier-data-sec buyer-sec-title">
    <div>
      <h1 class="supplier-database-header">Users</h1>
    </div>
  </div>
  <div class="section supplier-data-sec data-table buyer " style="padding-top:0px;">
    <div class="table-responsive">
    <table id="users" class="table">
      <thead class="thead-dark">
        <tr>
          <th scope="col">Name</th>
          <th scope="col">Email</th>
          <th scope="col">Role</th>
          <th scope="col">Approved</th>
          <th scope="col">Action</th>

        </tr>
      </thead>
      <tbody>
          @foreach ($users->sortByDesc('id') as $key => $value)
          <tr>
            <th scope="row">{{$value->name}}</th>
            <td>{{$value->email}}</td>
            <td>{{$value->role}}</td>
            <td>{{$value->approve}}</td>
            <td>@if ($value->approve == 'yes')
              <a href="/revoke_user/{{$value->id}}"><button class="btn btn-warning">Revoke</button></a>
            @else
                <a href="/approve_user/{{$value->id}}"><button class="btn btn-primary">Approve</button></a>
            @endif</td>
          </tr>
        @endforeach
      </tbody>
    </table>

  </div>
</div>

@endsection
