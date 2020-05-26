@extends('layouts.app')
@section('content')
@php( $buyer_doc = \App\buyer_doc::all())
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
            <th scope="col">Email</th>
            <th scope="col">Country</th>
            <th scope="col">Region</th>
            <th scope="col">Address</th>
            <th scope="col">Phone</th>
            <th scope="col">Interested product</th>
            <th scope="col">Delivery port</th>
            <th scope="col">Proof of funds</th>
            <th scope="col">Documents</th>
          </tr>
        </thead>
        <tbody>

            @foreach ($buyers->sortByDesc('id') as $key => $value)
            <tr>
              <th scope="row"><a href="/buyer_info/{{$value->id}}">{{$value->name}}</a></th>
              <td data-toggle="modal" id="{{$value->id}}" data-name="buyer" data-target="#auto_email" class="get_email">{{$value->email}}</td>
              <td>{{$value->country_name}}</td>
              <td>{{$value->region}}</td>
              <td>{{$value->address}}</td>
              <td>{{$value->phone}}</td>
              <td>@foreach ($inquiry as $key => $inq_value)
                @if ($inq_value->buyer_id == $value->id)
                  {{$inq_value->type}}
                @endif
              @endforeach</td>
              <td>{{$value->delivery_port}}</td>
              <td><a href="/view_proof_of_funds/{{$value->proof}}/{{$value->id}}">{{$value->proof}}</a></td>
              <td>@foreach ($buyer_doc as $key => $b_value)
                @if ($b_value->buyer_id == $value->id)
                  <a href="/view_doc/{{$b_value->path}}/{{$value->id}}/buyer">{{$b_value->name}}</a>
                @endif
              @endforeach</td>
            </tr>
          @endforeach
        </tbody>
      </table>
  </div>
</div>

@endsection
