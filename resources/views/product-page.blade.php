@extends('layouts.app')
@section('content')
  <section id="feature-section" class="feature-section-3">
    @foreach ($product as $key => $value)
       <h2 style="text-align:center">{{$value->type}}</h2>
      <div class="flex-container-2 w-container mt-4">
       <div class="col-md-12 float-left ">
        <div class="col-md-7 float-left pt-2 mb-4"><img src='{{("/images/products/{$value->image_path}")}}' alt="" class="feature-image">
            <button type="button" id="{{$value->id}}"  class="btn btn-danger delete_product mt-4" style="display:block;margin:auto;"  data-toggle="modal" data-target="#del_product">Delete Product</button>
        </div>
        <div class="col-md-5 float-left border p-2">
        <form action="/update_product/{{$value->id}}" method="post" >
          @csrf

          <div class="form-group float-left col-md-12">
            <label>Product name</label>
            <input type="text" class="form-field w-input form-text  mr-5 mt-1 " maxlength="256" name="type" data-name="name" id="type" placeholder="Product Name" value="{{$value->type}}" required="">
            <label>Price</label>
            <input type="text" class="form-field w-input form-text mt-1 " maxlength="256" name="price" data-name="price" id="type" placeholder="Price" value="{{$value->price}}" required="">
          </div>
          <div class="form-group float-left col-md-12">
            <label>Description</label>
            <textarea style="width:100%;" placeholder="Product description" class="form-field w-input form-text mt-1" maxlength="256" rows="10" name="description" data-name="message">
              {{$value->description}}
            </textarea>
          </div>
          <div class="form-group float-left col-md-12">
          <button class="button w-button btn " >Update</button>
          </div>

        </form>
        </div>
      </div>
    @endforeach
  </section>
@endsection
