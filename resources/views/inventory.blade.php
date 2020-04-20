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
              <p>{!!  substr(strip_tags($value->description), 0, 150) !!} .... </p>
              {{-- <div class="price in-stock">In Stock</div> --}}
              <div class="price">${{$value->price}}</div>
              <a href="#" class="button w-button">Select</a>
            </div>
          @endforeach
        </div>



      </div>
    </section>
  </div>



@endsection
