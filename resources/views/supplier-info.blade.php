@extends('layouts.app')
@section('content')

  <header id="hero" class="hero-2">
    <div>
      <h1 class="supplier-database-header">Supplier</h1>
    </div>
    <div class="flex-container w-container">
      <div>
        @foreach ($supplier as $key => $value)
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
        <br><strong>Port of origin: </strong>{{$value->port_of_origin}}
        <br></p>
        <a href='{{("/certificates/{$value->id}/{$value->certificates}")}}'><strong>Certificates </strong>{{$value->certificates}}</p></a>
        <a href='{{("/proof_of_life/{$value->id}/{$value->proof_of_life}")}}'><strong>Proof of life </strong>{{$value->proof_of_lifes}}</p></a>
        <a href="#" class="button w-button">Edit Profile</a>
      </div>
      <div class="hero-image-mask"><img src="/images/supplier/product_image/{{$image}}" alt="" class="hero-image"></div>


    </div>
  </header>

@endsection
