@extends('external_broker.template')
@section('content')
  <body class="buyer-dash-body">
    <div data-collapse="medium" data-animation="over-right" data-duration="400" class="dashboard-nav w-nav">
      @include('external_broker.nav');
    </div>
    <div class="side-nav-dash"><a href="#" class="link-block w-inline-block"><img src="images/dashboard.png" width="50" alt="" class="image"></a></div>
    <section id="feature-section" class="feature-section-2">
      <div class="flex-container w-container">
        <div class="feature-image-mask"><img src="/images/products/{{$image}}" alt="" class="feature-image"></div>
        <div>
          <h2>{{$product_name}}</h2>
          @foreach ($specification as $key => $value)
            <p>{{$value->Specifications}}</p>
          @endforeach
          <a href="/inquiry/{{$product_id}}/{{$session}}" class="button w-button">inquiry</a></div>
      </div>
    </section>
    <!-- [if lte IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js"></script><![endif] -->
  </body>
@endsection
