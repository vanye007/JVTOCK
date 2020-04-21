@extends('layouts.app')
@section('content')


    <div class="miss-pof-sec">
      <div class="div-block-2">
        <h1 class="heading-4 tt">Template Message</h1>
      </div>
    </div>
    <div class="miss-pof-sec edit-template">
      <div class="w-row">
        <div class="w-col w-col-2 col-sm-4">
          <div><a href="/get_message/contract" class="button edit-button w-button">Edit Contract</a></div>
        </div>
        <div class="w-col w-col-2 col-sm-4">
          <div><a href="/get_message/loi" class="button edit-button w-button">Edit LOI</a></div>
        </div>
        <div class="w-col w-col-2 col-sm-4">
          <div><a href="/get_message/message" class="button edit-button w-button">Edit Custom</a></div>
        </div>
        <div class="w-col w-col-2 col-sm-4">
          <div><a href="/get_message/pol" class="button edit-button w-button">Edit POL</a></div>
        </div>
        <div class="w-col w-col-2 col-sm-4">
          <div><a href="/get_message/pof" class="button edit-button w-button">Edit POF</a></div>
        </div>
      </div>
      <div class="template-cont w-container"><img src="{{asset('images/jvtock-logo.png')}}" width="150" alt="" class="image-2">
        {{-- <a href="#" class="button short-button w-button">Edit Template</a> --}}
        <div class="div-block-2">
        <form method="post" action='/message/{{$type}}'>
          @csrf
          <p>
             <input type="email" class="form-field w-input" maxlength="256" name="email" data-name="Email" placeholder="To:Email" required="">
                 <textarea style="width:100%;" class="form-field w-input" maxlength="256" rows="10" name="{{$type}}" data-name="message">   @foreach ($template as $key => $value){{$value->message}} @endforeach</textarea>
          <br>
          <br>‍</p>

          <p><strong class="bold-signiture">Kind Regards</strong>,<br>‍<br>{{$name}} from JVTOCK</p>
        </div>
      </div><button style="margin:auto;display:block;"  class="button short-button send w-button w-col-2">Send</button>
    </form>

    </div>


@endsection
