@extends('layouts.app')
@section('content')

  <header id="hero" class="hero-2">
    <div>
      <h1 class="supplier-database-header">Supplier</h1>
    </div>

    <div class="flex-container w-container col-md-12">

      <div class="col-md-4 info">
        <h3>Supplier info</h3>
        <p><strong>Firsname:</strong> {{$supplier_info['firstname']}}</p>
        <p><strong>Lastname:</strong> {{$supplier_info['lastname']}}</p>
        <p><strong>Email:</strong> {{$supplier_info['email']}} </p>
        <p><strong>Phone: </strong>{{$supplier_info['phone']}}</p>
      </div>
      <div class="col-md-4">
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
      <div class="col-md-4">
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

      {{-- <div class="hero-image-mask col-md-4"><img src="/images/supplier/product_image/{{$image}}" alt="" class="hero-image"></div> --}}

        {{-- <a href="#" class="button w-button col-md-6">Edit Profile</a> --}}

        {{-- <a href='{{("/certificates/{$value->certificates}")}}'><strong>Certificates </strong>{{$value->certificates}}</p></a>
        <a href='{{("/proof_of_life/{$value->proof_of_life}")}}'><strong>Proof of life </strong>{{$value->proof_of_lifes}}</p></a> --}}
    </div>
    <div>
      <h1 class="supplier-database-header">Products</h1>
    </div>
    <div class="flex-container w-container col-md-12">
    @foreach ($products as $key => $value)
      <div class="col-md-6">
        <img class="mb-3 mt-2" src='{{asset("images/uploads/supplier/{$id}/{$value->image}")}}'></img>
        <p><strong>Name:</strong> {{$value->name}}</p>
        <p><strong>Description:</strong> {{$value->description}}</p>
        <p><strong>Price:</strong> {{$value->price}}</p>
        <p><strong>Volume:</strong> {{$value->volume}}</p>
        <p><strong>Inventory:</strong> {{$value->inventory}}</p>
        <p><strong>Supply Capacity:</strong> {{$value->capacity}}</p>
        <p><strong>Certificates:</strong> <a href="/certificates/{{$value->path}}/{{$id}}">{{$value->certificates}} </a></p>
        <p><strong>Units/Pack:</strong> Length {{$value->length}} | Width {{$value->width}} | Height {{$value->height}} | weight {{$value->weight}}</p>
        <p><strong>Packages/Carton:</strong> Length {{$value->plength}} | Width {{$value->pwidth}} | Height {{$value->pheight}} | weight {{$value->pweight}}</p>
        <p><strong>Audit Date:</strong> {{$value->audit_date}}</p>
        <p style="text-align:center;"><strong>Audit Status</strong></p>
        @if ($value->status == 'pending')
            <a href="/approve_product/{{$value->id}}"><button style="Width:100%" type="button" class="btn btn-secondary">Pending</button></a>
        @else
          {{-- <a href="/approve_product/{{$value->id}}"><button style="Width:100%" type="button" class="btn btn-secondary">Pending</button></a> --}}
          <button style="Width:100%" type="button" class="btn btn-success">Approved</button>
        @endif
        {{-- <a href="#" class="button w-button col-md-6">Edit Profile</a> --}}
      </div>
    @endforeach
  </div>

  </header>

@endsection
