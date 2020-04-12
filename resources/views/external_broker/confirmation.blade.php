@extends('external_broker.template')
@section('content')
  <body class="buyer-dash-body">
    <div data-collapse="medium" data-animation="over-right" data-duration="400" class="dashboard-nav w-nav">
      <div data-collapse="medium" data-animation="over-right" data-duration="400" class="dashboard-nav w-nav">
        @include('external_broker.nav');
      </div>
    </div>
    <div class="side-nav-dash"><a href="#" class="link-block w-inline-block"><img src="images/dashboard.png" width="50" alt="" class="image"></a></div>
    <section id="feature-section" class="feature-section-2">
      <p class="confirmation-request">Thank you! Confirmation of your order request for information has been placed. Our team will get back to you as soon as possible.</p>
    </section>
    <!-- [if lte IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js"></script><![endif] -->
  </body>
@endsection
