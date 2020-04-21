@extends('layouts.app')
@section('content')
  <section id="feature-section" class="feature-section-3">
    @foreach ($product as $key => $value)
      <div class="flex-container-2 w-container">
        <div class="col-md-5 feature-image-mask"><img src='{{("/images/products/{$value->image_path}")}}' alt="" class="feature-image"></div>
        <div class="col-md-7">
        <form action="/update_product/{{$value->id}}" method="post" >
          @csrf
          <h2>{{$value->type}}</h2>
          <input type="text" class="form-field w-input form-text" maxlength="256" name="type" data-name="price" id="type" placeholder="Product Name" value="{{$value->type}}" required="">
          <input type="text" class="form-field w-input form-text" maxlength="256" name="price" data-name="price" id="type" placeholder="Price" value="{{$value->price}}" required="">
          <textarea style="width:100%;" placeholder="Product description" class="form-field w-input form-text" maxlength="256" rows="10" name="description" data-name="message">
            {{$value->description}}
          </textarea>
          <button class="button w-button btn">Update</button>
          </div>

        </form>
        </div>
    @endforeach
  </section>
@endsection
