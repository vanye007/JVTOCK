@extends('layouts.app')
@section('content')
    <div class="miss-pof-sec">
      <div class="div-block-2">
        <h1 class="heading-4 tt">Template Message</h1>
      </div>
    </div>
    <div class="miss-pof-sec edit-template">
      <div class="w-row">
        {{-- <div class="w-col w-col-2 col-sm-4">
          <div><a href="/get_message/contract" class="button edit-button w-button">Edit Contract</a></div>
        </div> --}}
        <div class="w-col w-col-3 col-sm-4">
          <div><a href="/template/loi" class="button edit-button w-button @if ($type == 'loi') active @endif">LOI Template</a></div>
        </div>
        <div class="w-col w-col-3 col-sm-4">
          <div><a href="/template/mndnc" class="button edit-button w-button @if ($type == 'loi') active @endif">MNDNC Template</a></div>
        </div>
        <div class="w-col w-col-3 col-sm-4">
          <div><a href="/get_message/message" class="button edit-button w-button @if ($type == 'message') active @endif">SEND MAIL</a></div>
        </div>
        {{-- <div class="w-col w-col-3 col-sm-4">
          <div><a href="/get_message/pol" class="button edit-button w-button @if ($type == 'pol') active @endif">Edit Template</a></div>
        </div> --}}
        {{-- <div class="w-col w-col-3 col-sm-4">
          <div><a href="/get_message/pof" class="button edit-button w-button @if ($type == 'pof') active @endif">Edit Template</a></div>
        </div> --}}
      </div>
      <div class="template-cont w-container"><img src="{{asset('images/jvtock-logo.png')}}" width="150" alt="" class="image-2">
        <div class="div-block-2">
        <form method="post" action='/message/{{$type}}'>
          @csrf
          <p>
             <input type="email" class="form-field w-input" maxlength="256" name="email"  @if ($email !== null)
               value = "{{$email}}"
             @endif data-name="Email" placeholder="To:Email" required="">
             <input type="text" class="form-field w-input" maxlength="256" name="subject"  data-name="subject" placeholder="subject" required="">
              <textarea style="width:100%;" class="form-field w-input" maxlength="256" rows="10" name="{{$type}}" data-name="message">   @foreach ($template as $key => $value){{$value->message}} @endforeach</textarea>
          <br>
          <br>‍</p>
          <p><strong class="bold-signiture">Kind Regards</strong>,<br>‍<br>{{$name}} from JVTOCK</p>
        </div>
      </div><button style="margin:auto;display:block;"  class="button short-button send w-button w-col-2">Send</button>
    </form>

    </div>


@endsection
