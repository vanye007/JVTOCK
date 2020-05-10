@extends('layouts.app')
@section('content')

  <header id="hero" class="hero-2">
    <div>
      <h1 class="supplier-database-header">Buyer Inquiry</h1>
    </div>
    <div class="flex-container w-container">
      <div class="col-md-8">
        @foreach ($buyer as $key => $value)
          <h1>{{$value->name}}</h1>
        <p><strong>Country:</strong> {{$value->country_name}}
        <br><strong>Email:</strong> {{$value->email}}
        <br><strong>Phone:</strong> {{$value->phone}}
        <p><strong>Interested Products: </strong>  @foreach ($inquiry as $key => $inq_value)

          @if (count($inquiry) > 1)
            @if ($inq_value->buyer_id == $value->id)
              | {{$inq_value->type}}
            @endif

          @else
            @if ($inq_value->buyer_id == $value->id)
              {{$inq_value->type}}
            @endif

          @endif
          @endforeach</p>
        <p>
        <br><strong>Proof of funds: </strong><a href='{{url("/view_proof_of_funds/{$value->proof}/{$value->id}")}}'>{{$value->proof}}</a>
        <br><strong>Audit Status (Approved): </strong>{{$value->approved}}
        <br></p>
        @if ($value->approved == 'no')
          <a href="/approve_buyer/{{$value->id}}" class="btn btn-success">Approve</a>
        @else
          <a href="/reject_buyer/{{$value->id}}" class="btn btn-warning">Reject</a>
        @endif
      </div>

  <div class="col-md-4 hero-image-mask"><img src="/images/cart.png" alt="" class="hero-image"></div>
        @endforeach

    </div>
  </header>
@endsection
