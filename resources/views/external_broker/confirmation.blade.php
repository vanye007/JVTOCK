@extends('external_broker.template')
@section('content')
  <body class="buyer-dash-body">
    <section id="" class=" centered p-5" style="width:100%">
      <div class="col-md-12 align-middle confirm" >
        @if(isset($buyer))
          <p style="text-align:center;"><img src="{{asset('images/jvtock-logo.png')}}" width="140" alt=""></p>
            <p style="text-align:center;" class="confirm_text">Thank you! Confirmation of your order request for information has been placed. Our team will get back to you as soon as possible.</p>
            <P><a href="/buyer" class="nav-links w-nav-link"><i class="fa fa-angle-left"></i>Iterms of Interest</a></p>
        @endif

        @if(isset($supplier))
          <p style="text-align:center;"><img src="{{asset('images/jvtock-logo.png')}}" width="140" alt=""></p>
            <p style="text-align:center;" class="confirm_text">Thank you for reaching out to us, We have recieved your supply information. Our customer representative will get back to you shortly. You can add more products or visit our website below</p>
            <p><a href="/add_more_product" class="nav-links w-nav-link"><i class="fa fa-angle-left"></i>Add roduct</a></p>

            <p><a href="https://jvtock.com/" class="nav-links w-nav-link"><i class="fa fa-angle-left"></i>Visit our webpage</a></p>

        @endif
      </div>
    </section>
  </body>
@endsection
