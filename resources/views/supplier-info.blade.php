@extends('layouts.app')
@section('content')
  <header id="hero" class="hero-2">
    <div>
      <h1 class="supplier-database-header">Supplier Informations</h1>
    </div>
    <div class="col-md-12 m-3 action_btns">
      <button id="supplier_upload" class="btn btn-info mb-3"  data-toggle="modal" data-target="#upload_doc"><i class="fa fa-upload"></i> Upload Doc</button>
        <a href="/edit_supplier_info/{{$supplier_info['id']}}"><button class="btn btn-warning"><i class="fa fa-edit"></i> Edit supplier info</button></a>
    </div>
    <div class="w-container container col-md-12 w-col-12">
      <div class="col-md-3 col-sm-12 info float-left">
        <h3>Supplier details</h3>
        <p><strong>Firsname:</strong> {{$supplier_info['firstname']}}</p>
        <p><strong>Lastname:</strong> {{$supplier_info['lastname']}}</p>
        <p><strong>Email:</strong> {{$supplier_info['email']}} </p>
        <p><strong>Phone: </strong>{{$supplier_info['phone']}}</p>
      </div>
      <div class="col-md-3 float-left">
        <h3>Business info</h3>
        @foreach ($business_info as $key => $value)
        <p><strong>Country: </strong>@foreach ($countries as $key => $country_value)
          @if ($country_value->id == $value->country_id )
            {{$country_value->country_name}}
          @endif
        @endforeach</p>
        <p><strong>City:</strong> {{$value->city}}</p>
        <p><strong>Address:</strong> {{$value->address}}</p>
        <p><strong>Post Code: </strong>{{$value->postal_code}}</p>
        @endforeach
      </div>
      <div class="col-md-3 float-left">
        <h3>Facility info</h3>
        @foreach ($facility_info as $key => $value)
        <p><strong>Country: </strong>@foreach ($countries as $key => $country_value)
          @if ($country_value->id == $value->country_id )
            {{$country_value->country_name}}
          @endif
        @endforeach</p>
        <p><strong>City:</strong> {{$value->city}}</p>
        <p><strong>Address:</strong> {{$value->address}}</p>
        <p><strong>Post Code: </strong>{{$value->postal_code}}</p>
        @endforeach
      </div>
      <div class="col-md-3 float-left">
        <h3>Documents</h3>
        @foreach ($docs as $key => $value)
          <a href="/view_doc/{{$value->path}}/{{$value->supplier_infos_id}}/supplier"><p>{{$value->name}}</p></a>
        @endforeach

        <p></p>
        <p></p>
        <p></p>
      </div>
    </div>
    <div>
      <h1 class="supplier-database-header">Products</h1>
    </div>
    <div class="container w-container col-md-12 w-col-12">

    @foreach ($products as $key => $value)
      <div class="col-md-6 col-sm-12 float-left">
        {{-- <img class="mb-3 mt-2" src='{{asset("images/uploads/supplier/{$id}/{$value->image}")}}'></img> --}}
        <a href="/edit_product/{{$id}}"><button class="btn btn-warning"><i class="fa fa-edit"></i> Edit product</button></a>
        <img class="mb-3 mt-2" src='{{ url("images/{$id}/{$value->image}") }}' alt="" title="">

        {{-- <img class="mb-3 mt-2" src="{{ route('image.displayImage',$value->image) }}" alt="" title=""> --}}
        <p><strong>Name:</strong> {{$value->name}}</p>
        <p><strong>Description:</strong> {{$value->description}}</p>
        <p><strong>Price:</strong> {{$value->price}}</p>
        <p><strong>Volume:</strong> {{$value->volume}}</p>
        <p><strong>Inventory:</strong> {{$value->inventory}}</p>
        <p><strong>Supply Capacity:</strong> {{$value->capacity}}</p>
        <p><strong>Certificates:</strong> @foreach ($certificates as $key => $cert_value)
          @if ($cert_value->product_infos_id == $value->product_id)
              <a href="/certificates/{{$cert_value->path}}/{{$id}}">{{$cert_value->certificates}} </a>,
          @endif
        @endforeach
        </p>
        {{-- <p><strong>Proof of life:</strong> <a href="/proof_of_life/{{$value->pof}}/{{$id}}">{{$value->pof}} </a></p> --}}
        <p><strong>Units / Package:</strong> Length {{$value->length}} | Width {{$value->width}} | Height {{$value->height}} | weight {{$value->weight}}</p>
        <p><strong>Packages / Carton:</strong> Length {{$value->plength}} | Width {{$value->pwidth}} | Height {{$value->pheight}} | weight {{$value->pweight}}</p>
        <p><strong>Audit Date:</strong> {{$value->audit_date}}</p>
        <p><strong>JVTOCK Sales price</strong>
          <form method="post" action="/update_sales_price" enctype='multipart/form-data'>
            @csrf
            <input style="width:120px;float:left" type="hidden" class="form-field w-input" maxlength="256" name="sales_id" value="{{$value->sales_price_id}}" required="">
            <input style="width:120px;float:left" type="text" class="input-fields w-input mr-2" maxlength="256" name="sale_price" value="{{$value->sale_price}}"   required="">
            <button  class="btn btn-primary">Update</button>
          </form>
        </p>
        <p style=""><strong>Audit Status</strong>: {{$value->status}}</p>
        <a href="" id="{{$value->product_id}}"  class="btn btn-info upload_prod_cert mb-3" data-toggle="modal" data-target="#upload_product_file">Upload product certificate</a>

        @if ($value->status == 'pending')
            <a href="/approve_product/{{$value->product_id}}"><button style="Width:100%" type="button" class="btn btn-primary">Approve</button></a>
        @else
          {{-- <a href="/approve_product/{{$value->id}}"><button style="Width:100%" type="button" class="btn btn-secondary">Pending</button></a> --}}
          <a href="/reject_product/{{$value->product_id}}">  <button style="Width:100%" type="button" class="btn btn-warning">Reject</button></a>
        @endif
        {{-- <a href="#" class="button w-button col-md-6">Edit Profile</a> --}}
      </div>
    @endforeach

  </div>

  </header>

@endsection
