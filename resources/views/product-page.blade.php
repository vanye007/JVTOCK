@extends('layouts.app')
@section('content')
  <section id="feature-section" class="feature-section-3">
    @foreach ($product as $key => $value)
      <div class="flex-container-2 w-container">
        <div class="feature-image-mask"><img src='{{("/images/products/{$value->image_path}")}}' alt="" class="feature-image"></div>
        <div>
        <form action="/update_product/{{$value->id}}" method="post" >
          @csrf
          <h2>{{$value->type}}</h2>
          <input type="text" class="form-field w-input" maxlength="256" name="type" data-name="price" id="type" placeholder="Product Name" value="{{$value->type}}" required="">
          <input type="text" class="form-field w-input" maxlength="256" name="price" data-name="price" id="type" placeholder="Price" value="{{$value->price}}" required="">
          <textarea style="width:100%;" placeholder="Product description" class="form-field w-input" maxlength="256" rows="10" name="description" data-name="message">
            {{$value->description}}
          </textarea>
          </div>
          <button class="button w-button">Update</button>
        </form>
        </div>
    @endforeach
  </section>
  <div data-collapse="medium" data-animation="over-right" data-duration="400" class="dashboard-nav w-nav">
  </div>
@endsection
