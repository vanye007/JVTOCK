@extends('external_broker.template')
@section('content')
  <body class="buyer-dash-body">
    <div data-collapse="medium" data-animation="over-right" data-duration="400" class="dashboard-nav w-nav">
      @include('external_broker.nav')
    </div>
    <div id="item-of-interest" class="items-of-interest-div">
      <section id="cards-section" class="cards-section">
        <h2 class="items-of-interest-header">Inventory items</h2>
        {{-- <form action="/search" class="search-inventory w-form"><input type="search" class="search-input w-input" maxlength="256" name="query" placeholder="Search Inventory" id="search" required=""><input type="submit" value="Search" class="search-button w-button"></form> --}}
        <div class="centered-container w-container">
          <div class="cards-grid-container">
          @foreach ($products as $key => $value)
              <div id="{{$value->id}}">
                <div class="cards-image-mask"><img src="images/products/{{$value->image_path}}" alt="" class="cards-image"></div>
                <h3 class="heading">{{$value->type}}</h3>
                <p>   {!!  substr(strip_tags($value->description), 0, 150) !!} .... </p><a href="/product-page/{{$value->id}}/{{$session}}/{{$value->type}}" class="button w-button">Select</a>
              </div>
          @endforeach
          </div>
        </div>
      </section>
    </div>
    <!-- [if lte IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js"></script><![endif] -->
  </body>
@endsection
