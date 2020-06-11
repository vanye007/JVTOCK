@extends('layouts.app')
@section('content')
  <header id="hero" class="hero-2">
    <div>
      <h1 class="supplier-database-header">Edit Product</h1>
    </div>
    <div class="flex-container w-container">
      <div class="col-md-12">
        <form action="/update_supplier_product" method="POST">
          @csrf
          @foreach ($product as $key => $value)

          <input type="hidden" class="form-control" id="product_id" name="product_id" value="{{$value->id}}">
          <div class="form-group">
            <label for="exampleInputEmail1">Name</label>
            <input type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp" value="{{$value->name}}" placeholder="">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Description</label>
            <input type="text" class="form-control" id="description" name="description" aria-describedby="emailHelp" value="{{$value->description}}" placeholder="">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Volume</label>
            <input type="text" class="form-control" id="volume" name="volume" aria-describedby="emailHelp" value="{{$value->volume}}" placeholder="">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Inventory</label>
            <input type="text" class="form-control" id="Inventory" name="inventory"  value="{{$value->inventory}}" placeholder="">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Capacity</label>
            <input type="text" class="form-control" id="capacity" name="capacity"  value="{{$value->capacity}}" placeholder="">
          </div>

          <h3  style="text-align:center;font-weight:normal;">Units / Packages</h3>
          <div class="form-group">
            <label for="exampleInputEmail1">length</label>
            <input type="text" class="form-control" id="u_length" name="u_length"  value="{{$value->u_length}}" placeholder="">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Width</label>
            <input type="text" class="form-control" id="u_width" name="u_width"  value="{{$value->u_width}}" placeholder="">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Height</label>
            <input type="text" class="form-control" id="u_height" name="u_height"  value="{{$value->u_height}}" placeholder="">
          </div>

          <h3  style="text-align:center;font-weight:normal;">Packages / Carton</h3>
          <div class="form-group">
            <label for="exampleInputEmail1">length</label>
            <input type="text" class="form-control" id="p_length" name="p_length"  value="{{$value->p_length}}" placeholder="">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Width</label>
            <input type="text" class="form-control" id="p_width" name="p_width"  value="{{$value->p_width}}" placeholder="">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Height</label>
            <input type="text" class="form-control" id="p_height" name="p_height"  value="{{$value->p_height}}" placeholder="">
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">Weight</label>
            <input type="text" class="form-control" id="p_weight" name="p_weight"  value="{{$value->p_weight}}" placeholder="">
          </div>
            @endforeach
          <button type="submit" class="btn btn-primary">update</button>
        </form>

      </div>

    </div>
  </header>
@endsection
