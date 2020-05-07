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
        <a href='{{url("/view_proof_of_funds/{$value->proof}/{$value->id}")}}'><p>
        <br><strong>Proof of funds: </strong>{{$value->proof}}
        <br></p></a>
        <a href="#" class="button w-button">Edit Profile</a>

      </div>


      {{-- <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img class="d-block w-100" src="..." alt="First slide">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="..." alt="Second slide">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="..." alt="Third slide">
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div> --}}

  <div class="col-md-4 hero-image-mask"><img src="/images/cart.png" alt="" class="hero-image"></div>
        @endforeach

    </div>
  </header>
@endsection
