@extends('layouts.app')
@section('content')


    <div class="miss-pof-sec">
      <div class="div-block-2">
        <h1 class="heading-4 tt">Template Message</h1>
      </div>
    </div>
    <div class="miss-pof-sec edit-template">
      <div class="template-cont w-container"><img src="images/jvtock-logo.png" width="150" alt="" class="image-2">
        {{-- <a href="#" class="button short-button w-button">Edit Template</a> --}}
        <div class="div-block-2">
        <form method="post" action='/send_message'>
          @csrf
          <p>
             <input type="email" class="form-field w-input" maxlength="256" name="email" data-name="Email" placeholder="To:Email" required="">
             <input type='text' class="form-field w-input" maxlength="256" name="subject" data-name="subject" placeholder="subject" required="">
            <textarea style="width:100%;" class="form-field w-input" maxlength="256" rows="10" name="message" data-name="message">@foreach ($template as $key => $value)@if ($value->type == 'message'){{$value->message}}@endif
            @endforeach</textarea>
          <br>
          <br>‍</p>

          <p><strong class="bold-signiture">Kind Regards</strong>,<br>‍<br>{{$name}} from JVTOCK</p>
        </div>
      </div><button style="margin:auto;display:block;"  class="button short-button send w-button w-col-2">Send</button>
    </form>

    </div>


@endsection
