@extends('layouts.app')
@section('content')
  <header id="hero" class="hero-2">
    <div>
      <h1 class="supplier-database-header">Edit Supplier Info</h1>
    </div>
    <div class="flex-container w-container">
      <div class="col-md-12">
        <form action="/update_supplier_info" method="POST">
          @csrf
          @foreach ($supplier_info as $key => $value)

          <input type="hidden" class="form-control" id="supplier_id" name="supplier_id" value="{{$value->id}}">
          <div class="form-group">
            <label for="exampleInputEmail1">First name</label>
            <input type="text" class="form-control" id="firstname" name="firstname" aria-describedby="emailHelp" value="{{$value->firstname}}" placeholder="">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Lastname</label>
            <input type="text" class="form-control" id="lastname" name="lastname" aria-describedby="emailHelp" value="{{$value->lastname}}" placeholder="">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Email</label>
            <input type="text" class="form-control" id="email" name="email" aria-describedby="emailHelp" value="{{$value->email}}" placeholder="">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Phone</label>
            <input type="number" class="form-control" id="phone" name="phone"  value="{{$value->phone}}" placeholder="">
          </div>
          <h3  style="text-align:center;font-weight:normal;">Business info</h3>
          <div class="form-group">
            <label for="exampleInputEmail1">City</label>
            <input type="text" class="form-control" id="city" name="b_city"  value="{{$value->b_city}}" placeholder="">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Address</label>
            <input type="text" class="form-control" id="address" name="b_address"  value="{{$value->b_address}}" placeholder="">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Post code</label>
            <input type="text" class="form-control" id="b_postcode" name="b_postcode"  value="{{$value->b_postcode}}" placeholder="">
          </div>

          <h3  style="text-align:center;font-weight:normal;">Facility info</h3>
          <div class="form-group">
            <label for="exampleInputEmail1">City</label>
            <input type="text" class="form-control" id="f_city" name="f_city"  value="{{$value->f_city}}" placeholder="">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Address</label>
            <input type="text" class="form-control" id="f_address" name="f_address"  value="{{$value->f_address}}" placeholder="">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Post Code</label>
            <input type="text" class="form-control" id="f_postcode" name="f_postcode"  value="{{$value->f_postcode}}" placeholder="">
          </div>
            @endforeach
          <button type="submit" class="btn btn-primary">update</button>
        </form>

      </div>

    </div>
  </header>
@endsection
