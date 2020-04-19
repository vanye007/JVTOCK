@extends('layouts.app')
@section('content')

  <header id="hero" class="hero-2">
    <div>
      <h1 class="supplier-database-header">Buyer Inquiry</h1>
    </div>
    <div class="flex-container w-container">
      <div>
        @foreach ($buyers as $key => $value)
          <h1>{{$value->name}}</h1>
        @endforeach

        <p>-Joint Venture Agreement
        <br>-Commission Agreement
        <br>-IMFPA
        <br>To change this section’s background, select the “Hero Section,” then scroll to the <strong>background</strong> section of the Style panel and add a color, image, or gradient.</p>
        <p><strong>Country:</strong> {{$value->country_name}}
        <br><strong>Email:</strong> {{$value->email}}
        <br><strong>Phone:</strong> {{$value->phone}}
        <br><strong>Shipping routes: </strong>{{$value->shipping_routes}}
        <br><strong>Supply Capacity: </strong>{{$value->supply_capacity}}
        <br><strong>Current Inventory: </strong>{{$value->current_inventory}}
        <br><strong>Port of origin: </strong>{{$value->port_of_origin}}</p>
        <p>
        <br><strong>Proof of funds: </strong>{{$value->proof_of_funds}}
        <br></p>
        <a href="#" class="button w-button">Edit Profile</a>
      </div>
      <div class="hero-image-mask"><img src="/storage/uploads/seller/product_image/{{$image}}" alt="" class="hero-image"></div>
    </div>
  </header>
@endsection
