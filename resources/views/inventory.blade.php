@extends('layouts.app')
@section('content')

  <div class="section supplier-data-sec">
    <div>
      <h1 class="supplier-database-header">Inventory</h1>
    </div>
  </div>


  <div id="item-of-interest" class="items-of-interest-div">
    <section id="cards-section" class="cards-section">
      <div class="centered-container w-container">
          <a class="button dash-button w-button" data-toggle="modal" data-target="#upload_product">Upload Product</a>
        <div class="cards-grid-container">
          @foreach ($products as $key => $value)
            <div id="{{$value->id}}" class="w-clearfix">
              <div class="cards-image-mask"><img src='{{asset("images/products/{$value->image_path}")}}' alt="" class="cards-image"></div>
              <h3 class="heading">{{$value->type}}</h3>
              <p>{!!  substr(strip_tags($value->description), 0, 38) !!}..</p>
              {{-- <div class="price in-stock">In Stock</div> --}}
              <div class="price">${{$value->price}}</div>
              <a href="/product-info/{{$value->id}}" class="button w-button">Select</a>
            </div>
          @endforeach
        </div>



      </div>
    </section>
  </div>



@endsection
