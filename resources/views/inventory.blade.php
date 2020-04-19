@extends('layouts.app')
@section('content')

  <div id="item-of-interest" class="items-of-interest-div">
    <section id="cards-section" class="cards-section">
      <div class="centered-container w-container">
        <h2 class="items-of-interest-header">Items of Interest</h2>
        <div class="cards-grid-container">
          @foreach ($products as $key => $value)
            <div id="{{$value->id}}" class="w-clearfix">
              <div class="cards-image-mask"><img src='{{asset("images/products/{$value->image_path}")}}' alt="" class="cards-image"></div>
              <h3 class="heading">{{$value->type}}</h3>
              <p>{{$value->description}} </p>
              {{-- <div class="price in-stock">In Stock</div> --}}
              <div class="price">${{$value->price}}</div>
              <a href="#" class="button w-button">Select</a>
            </div>
          @endforeach

          <div id="w-node-7b034b1f5649-0ddbcad8" class="div-block w-clearfix">
            <div class="cards-image-mask"><img src="https://uploads-ssl.webflow.com/5db1c76aadcfe25e881680fa/5db86dc421496616bf357c25_placeholder.svg" alt="" class="cards-image"></div>
            <h3 id="w-node-7b034b1f564c-0ddbcad8" class="heading">COVID-19 Test Kit</h3>
            <p id="w-node-7b034b1f564e-0ddbcad8">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique. </p>
            <div class="price in-stock">In Stock</div>
            <div class="price">$5.99</div><a href="#" class="button w-button">Select</a></div>
        </div>



      </div>
    </section>
  </div>



@endsection
