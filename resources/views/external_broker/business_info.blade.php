@extends('external_broker.template')
@section('content')
  <div class="supplier-input-section">
    <div class="supplier-input-cont w-container">
      <div class="supplier-input-div">
        <a href="https://jvtock.com"><img style="display:block;margin:auto;" src="{{asset('images/jvtock-logo.png')}}" width="70" alt=""></a>
        <div class="w-form">
          <form id="email-form" action='/business_info' method='post'>
            @csrf
            <h1 class="supplier-form">Business information</h1>
            @if ($errors->any())
              <label for="myfile" class="field-label">
                  @foreach ($errors->all() as $error)
                    {{ $error }}
                  @endforeach
              </label>
            @endif
            {{-- Check if business info variable is not null. This is used to validate  --}}
            @if (isset($business_info) && count($business_info)>0)
              @foreach ($business_info as $key => $b_value)
                <select class="input-fields w-input" name="country">
                    <option selected="selected">SELECT COUNTRY</option>
                  @foreach ($countries as $key => $value)
                    <option value="{{$value->id}}" >{{$value->country_name}}</option>
                  @endforeach
                  <option value="{{$b_value->country_id}}" selected>{{$b_value->country_name}}</option>
                </select>
                  <input type="hidden" class="input-fields w-input" value="{{$supplier_info_fk}}" maxlength="256" name="supplier_info" data-name="supplier_info" id="supplier_info" required="">
                <label for="name" class="field-label">City </label>
                <input type="text" class="input-fields w-input" maxlength="256" value="{{$b_value->city}}" name="city" data-name="city" id="city" required="">
                <label for="name" class="field-label">Address </label>
                <input type="text" class="input-fields w-input" maxlength="256" value="{{$b_value->address}}" name="address" data-name="address" id="address" required="">
                <label for="name" class="field-label">Postal Code </label>
                <input type="text" class="input-fields w-input" maxlength="256" value="{{$b_value->postal_code}}" name="postcode" data-name="postcode" id="postcode" required="">
              @endforeach
            @else
              <select class="input-fields w-input" name="country">
                  <option selected="selected">SELECT COUNTRY</option>
                @foreach ($countries as $key => $value)
                  <option value="{{$value->id}}" >{{$value->country_name}}</option>
                @endforeach
              </select>
                <input type="hidden" class="input-fields w-input" value="{{$supplier_info_fk}}" maxlength="256" name="supplier_info" data-name="supplier_info" id="supplier_info" required="">
              <label for="name" class="field-label">City </label>
              <input type="text" class="input-fields w-input" maxlength="256" value name="city" data-name="city" id="city" required="">
              <label for="name" class="field-label">Address </label>
              <input type="text" class="input-fields w-input" maxlength="256" name="address" data-name="address" id="address" required="">
              <label for="name" class="field-label">Postal Code </label>
              <input type="text" class="input-fields w-input" maxlength="256" name="postcode" data-name="postcode" id="postcode" required="">
            @endif
            <br>
            <hr>
            <br>
            <h1 class="supplier-form">Facility information</h1>
            @if (isset($facility_info) && count($facility_info)>0)
              @foreach ($facility_info as $key => $f_value)
                <select class="input-fields w-input" name="facility_country">
                    <option selected="selected">SELECT FACILITY COUNTRY</option>
                  @foreach ($countries as $key => $value)
                    <option value="{{$value->id}}" >{{$value->country_name}}</option>
                  @endforeach
                    <option value="{{$f_value->country_id}}" selected>{{$f_value->country_name}}</option>
                </select>
                <label for="name" class="field-label">City </label>
                <input type="text" class="input-fields w-input" maxlength="256" value="{{$f_value->city}}" name="facility_city" data-name="facility_city" id="facility_city" required="">
                <label for="name" class="field-label">Region (State/Province)</label>
                <input type="text" class="input-fields w-input" value="{{$f_value->region}}" maxlength="256" name="region" data-name="region" id="region" required="">
                <label for="name" class="field-label">Address </label>
                <input type="text" class="input-fields w-input" maxlength="256" value="{{$f_value->address}}" name="facility_address" data-name="facility_address" id="facility_address" required="">
                <label for="name" class="field-label">Postal Code </label>
                <input type="text" class="input-fields w-input" maxlength="256" value="{{$f_value->postal_code}}" name="facility_postcode" data-name="facility_postcode" id="facility_postcode" required="">
                <label for="name" class="field-label">Port of Origin </label>
                <input type="text" class="input-fields w-input" maxlength="256" value="{{$f_value->port_of_origin}}" name="poo" data-name="port_of_origin" id="port_of_origin" required="">
                <label for="name" class="field-label">Define Shipping Terms</label>
                <textarea name="shipping_terms" class="input-fields w-input">
                  {{$f_value->shipping_terms}}
                </textarea>
                <label for="name" class="field-label">Define Payment Terms</label>
                <textarea name="payment_terms" class="input-fields w-input">
                  {{$f_value->payment_terms}}
                </textarea>
              @endforeach
            @else
              <select class="input-fields w-input" name="facility_country">
                  <option selected="selected">SELECT FACILITY COUNTRY</option>
                @foreach ($countries as $key => $value)
                  <option value="{{$value->id}}" >{{$value->country_name}}</option>
                @endforeach
              </select>
              <label for="name" class="field-label">City </label>
              <input type="text" class="input-fields w-input" maxlength="256" name="facility_city" data-name="facility_city" id="facility_city" required="">
              <label for="name" class="field-label">Region (State/Province)</label>
              <input type="text" class="input-fields w-input" maxlength="256" name="region" data-name="region" id="region" required="">
              <label for="name" class="field-label">Address </label>
              <input type="text" class="input-fields w-input" maxlength="256" name="facility_address" data-name="facility_address" id="facility_address" required="">
              <label for="name" class="field-label">Postal Code </label>
              <input type="text" class="input-fields w-input" maxlength="256" name="facility_postcode" data-name="facility_postcode" id="facility_postcode" required="">
              <label for="name" class="field-label">Port of Origin </label>
              <input type="text" class="input-fields w-input" maxlength="256" name="poo" data-name="port_of_origin" id="port_of_origin" required="">
              <label for="name" class="field-label">Define Shipping Terms</label>
              <textarea name="shipping_terms" class="input-fields w-input">
              </textarea>
              <label for="name" class="field-label">Define Payment Terms</label>
              <textarea name="payment_terms" class="input-fields w-input">
              </textarea>
            @endif
            <input type="submit" value="Next" data-wait="Please wait..." class="submit-button w-button">
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
