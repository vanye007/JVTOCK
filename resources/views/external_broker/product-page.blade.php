@extends('external_broker.template')
@section('content')
  <body class="buyer-dash-body">
    <div data-collapse="medium" data-animation="over-right" data-duration="400" class="dashboard-nav w-nav">
      @include('external_broker.nav')
    </div>
      <section id="feature-section" class="feature-section-2">
        <div class="flex-container w-container">
          <div class="feature-image-mask col-md-4"><img src="/images/products/{{$image}}" alt="" class="feature-image"></div>
          <div class="col-md-8">
            <h2>{{$product_name}}</h2>
            <p>@foreach ($product as $key => $value)
              {{$value->description}}

            
            @endforeach</p>
            {{-- @foreach ($specification as $key => $value)
              <p>{{$value->description}}</p>
            @endforeach --}}
            <a href="/inquiry/{{$product_id}}/{{$session}}" class="button w-button">inquiry</a></div>
        </div>
      </section>
    <!-- [if lte IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js"></script><![endif] -->
  </body>
@endsection
