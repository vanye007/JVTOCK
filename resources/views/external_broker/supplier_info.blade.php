@extends('external_broker.template')
@section('content')
  <div class="supplier-input-section">
    <div class="supplier-input-cont w-container">
      <div class="supplier-input-div">
        <a href="https://jvtock.com"><img style="display:block;margin:auto;" src="{{asset('images/jvtock-logo.png')}}" width="70" alt=""></a>
        <div class="w-form">
          <form id="email-form" action='@if ($referral_id !== null){{url("/submit_referral_supply/{$referral_id}")}}@else{{url("/supplier_info")}}@endif' method='post'>
            @csrf
            <h1 class="supplier-form">Supplier Form</h1>
            @if ($errors->any())
              <label for="myfile" class="field-label">
                  @foreach ($errors->all() as $error)
                    {{ $error }}
                  @endforeach
              </label>
            @endif
            <label for="name" class="field-label">Firstname </label>
            <input type="text" class="input-fields w-input" maxlength="256" name="firstname" data-name="firstname" id="firstname" required="">
            <label for="name" class="field-label">Lastname </label>
            <input type="text" class="input-fields w-input" maxlength="256" name="lastname" data-name="lastname" id="lastname" required="">
            <label for="name" class="field-label">Email </label>
            <input type="text" class="input-fields w-input" maxlength="256" name="email" data-name="email" id="email" required="">
            <label for="name" class="field-label">Phone </label>
            <input type="text" class="input-fields w-input" maxlength="256" name="phone" data-name="phone" id="phone" required="">
            <input type="submit" value="Next" data-wait="Please wait..." class="submit-button w-button">
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
