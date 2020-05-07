@extends('layouts.app')
@section('content')

  <div class="section supplier-data-sec buyer-sec-title">
    <div>
      <h1 class="supplier-database-header">Buyer Database</h1>
    </div>
  </div>
  <div class="section supplier-data-sec data-table buyer " style="padding-top:0px;">
    <div class="table-responsive">
    <table id="buyer" class="table">
      <thead class="thead-dark">
        <tr>
          <th scope="col">Name</th>
          <th scope="col">Country</th>
          <th scope="col">Phone</th>
          <th scope="col">Interested product</th>
          <th scope="col">Delivery port</th>
          <th scope="col">Proof of funds</th>
        </tr>
      </thead>
      <tbody>
          @foreach ($buyers->sortByDesc('id') as $key => $value)
          <tr>
            <th scope="row"><a href="/buyer_info/{{$value->id}}">{{$value->name}}</a></th>
            <td>{{$value->country_name}}</td>
            <td>{{$value->phone}}</td>
            <td>@foreach ($inquiry as $key => $inq_value)
              @if ($inq_value->buyer_id == $value->id)
                {{$inq_value->type}}
              @endif
            @endforeach</td>
            <td>{{$value->delivery_port}}</td>
            <td>{{$value->proof}}</td>
          </tr>
        @endforeach
      </tbody>
    </table>

  </div>
</div>

@endsection
