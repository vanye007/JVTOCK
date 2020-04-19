@extends('layouts.app')
@section('content')


    <div class="miss-pof-sec">
      <div class="div-block-2">
        <h1 class="heading-4 tt">Template Message</h1>
      </div>
    </div>
    <div class="miss-pof-sec edit-template">
      {{-- <div class="w-row">
        <div class="w-col w-col-2">
          <div><a href="#" class="button edit-button w-button">Edit Contract</a></div>
        </div>
        <div class="w-col w-col-2">
          <div><a href="#" class="button edit-button w-button">Edit LOI</a></div>
        </div>
        <div class="w-col w-col-2">
          <div><a href="#" class="button edit-button w-button">Edit Message</a></div>
        </div>
        <div class="w-col w-col-2">
          <div><a href="#" class="button edit-button w-button">Edit POL</a></div>
        </div>
        <div class="w-col w-col-2">
          <div><a href="#" class="button edit-button w-button">Edit POF</a></div>
        </div>
        <div class="w-col w-col-2">
          <div><a href="#" class="button edit-button w-button">Upload</a></div>
        </div>
      </div> --}}
      <div class="template-cont w-container"><img src="images/jvtock-logo.png" width="150" alt="" class="image-2">
        {{-- <a href="#" class="button short-button w-button">Edit Template</a> --}}
        <div class="div-block-2">
        <form method="post" action='/send_message'>
          @csrf
          <p>
             <input type="email" class="form-field w-input" maxlength="256" name="email" data-name="Email" placeholder="To:Email" required="">
           {{-- @if ($buyers->isEmpty())
             <input type="email" class="form-field w-input" maxlength="256" name="email" data-name="Email" placeholder="Email" required="">
            @else
              <strong class="bold-name "><select class="form-field w-input" name="email"><option>Select buyer to send message</option>
              @foreach ($buyers as $key => $value)
                <option value="{{$value->email}}">{{$value->name}}, {{$value->email}}</option>
              @endforeach
            <br></strong></select>
            @endif --}}

          <br> @foreach ($template as $key => $value)
            <textarea style="width:100%;" class="form-field w-input" maxlength="256" rows="10" name="message" data-name="message">@if ($value->type == 'message'){{$value->message}}@endif
            </textarea>
          @endforeach<br>‍</p>

          <p><strong class="bold-signiture">Kind Regards</strong>,<br>‍<br>{{$name}} from JVTOCK</p>
        </div>
      </div><button style="margin:auto;display:block;"  class="button short-button send w-button w-col-2">Send</button>
    </form>

    </div>


@endsection
