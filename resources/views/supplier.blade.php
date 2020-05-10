@extends('external_broker.template')
@section('content')
  <div class="supplier-input-section">
    <div class="supplier-input-cont w-container">
      <div class="supplier-input-div">
        <div class="w-form">
          <img src="{{asset('images/jvtock-logo.png')}}" width="70" alt="">
          <form id="email-form" action='@if ($referral_id !== null){{url("/submit_referral_supply/{$referral_id}")}}@else{{url("/submit_supply")}}@endif' method='post'  enctype='multipart/form-data'>
            @csrf
            <h1 class="supplier-form">Supplier Form</h1>
            @if ($errors->any())
              <label for="myfile" class="field-label">
                  @foreach ($errors->all() as $error)
                    {{ $error }}
                  @endforeach
              </label>
            @endif
            <label for="name" class="field-label">Full Name </label>
            <input type="text" class="input-fields w-input" maxlength="256" name="name" data-name="name" id="name" required="">
            <label for="name" class="field-label">Email </label>
            <input type="text" class="input-fields w-input" maxlength="256" name="email" data-name="email" id="email" required="">
            <label for="name" class="field-label">Phone </label>
            <input type="text" class="input-fields w-input" maxlength="256" name="phone" data-name="phone" id="phone" required="">
            <select class="input-fields w-input" name="countries">
                <option selected="selected">SELECT COUNTRY</option>
              @foreach ($countries as $key => $value)
                <option value="{{$value->id}}" >{{$value->country_name}}</option>
              @endforeach
            </select>
            <select class="input-fields w-input" name="product_id">
              <option selected="selected">SELECT PRODUCT TO SUPPLY</option>
              @foreach ($products as $key => $value)
                <option value="{{$value->id}}" >{{$value->type}}</option>
              @endforeach
            </select>
            <label for="name" class="field-label">Product Specification </label>
            <input type="text" class="input-fields w-input" maxlength="256" name="specifications" data-name="Name" id="name" required="">
            <label for="email" class="field-label">Plan shipping routes to planned buyers</label>
            <input type="text" class="input-fields w-input" maxlength="256" name="shipping_routes" data-name="Email" id="email" required="">
            <label for="email-6" class="field-label">Define shipping terms</label>
            <input type="text" class="input-fields w-input" maxlength="256" name="shipping_terms" data-name="shipping_terms" id="shipping_terms" required="">
            <label for="Certification" class="field-label">Define payment terms</label>
            <input type="text" class="input-fields w-input" maxlength="256" name="payment_terms" data-name="Certification" id="Certification" required="">
            <label for="Proof-Of-Life" class="field-label">Prices At Different Capacities</label>
            <input type="text" class="input-fields w-input" maxlength="256" name="prices_per_capacity" data-name="prices_per_capacity" id="prices_per_capacity" required="">
            <label for="Proof-Of-Life-6" class="field-label">Planned Capacity Upgrades</label>
            <input type="text" class="input-fields w-input" maxlength="256" name="capacity_upgrades" data-name="capacity_upgrades" id="capacity_upgrades" required="">

            <label for="Proof-Of-Life-6" class="field-label">Certification</label>
            @if($errors->has('certificates'))
              <label for="myfile" class="field-label bg-danger text-white p-3">
                  {{ $errors->first('certificates') }}
              </label>
            @endif
            <input type="file" class="input-fields w-input" maxlength="256" name="certificates" data-name="certificates" id="certificates" required="">
            <label for="Proof-Of-Life-6" class="field-label">Product Image</label>
            <input type="file" class="input-fields w-input" maxlength="256" name="product_image" data-name="product_image" id="product_image" required="">

            <label for="Proof-Of-Life-2" class="field-label">Product Price</label>
            <input type="text" class="input-fields w-input" maxlength="256" name="price" data-name="price" id="price" required="">
            <label for="Proof-Of-Life-2" class="field-label">Supply Capacity</label>
            <input type="text" class="input-fields w-input" maxlength="256" name="supply_capacity" data-name="supply_capacity" id="supply_capacity" required="">
            <label for="Proof-Of-Life-6" class="field-label">Current Inventory</label>
            <input type="text" class="input-fields w-input" maxlength="256" name="current_inventory" data-name="current_inventory" id="current_inventory" required="">
            <label for="Proof-Of-Life-6" class="field-label">Port of Origin</label>
            <input type="text" class="input-fields w-input" maxlength="256" name="port_of_origin" data-name="port_of_origin" id="port_of_origin" required="">
            <label for="Proof-Of-Life-6" class="field-label">Pieces/units per Box (boxes per carton, cartons per pallet. Associated dimensions and weight)</label>
            <input type="text" class="input-fields w-input" maxlength="256" name="units_per_box" data-name="units_per_box" id="units_per_box" required="">
            <label for="Proof-Of-Life-6" class="field-label">Proof of life</label>
            @if($errors->has('proof_of_life'))
              <label for="myfile" class="field-label bg-danger text-white p-3">
                  {{ $errors->first('proof_of_life') }}
              </label>
            @endif
            <input type="file" class="input-fields w-input" maxlength="256" name="proof_of_life" data-name="proof_of_life" id="proof_of_life" required="">
            <input type="submit" value="Submit" data-wait="Please wait..." class="submit-button w-button">
          </form>
          <div class="w-form-done">
            <div>Thank you! Your submission has been received!</div>
          </div>
          <div class="w-form-fail">
            <div>Oops! Something went wrong while submitting the form.</div>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- <div class="supplier-input-section">
    <div class="supplier-input-cont w-container">
      <div class="supplier-input-div">
        <div class="w-form">
          <form id="email-form" name="email-form" data-name="Email Form">
            <h1 class="supplier-form">Supplier Form</h1><label for="name-2" class="field-label">Non Circumvention Non Disclosure and Working Agreement (NCNDA)</label><input type="text" class="input-fields w-input" maxlength="256" name="name-2" data-name="Name 2" id="name-2" required="">
            <label for="email-6" class="field-label">Proof Of Life (POL) If Applicable</label><input type="text" class="input-fields w-input" maxlength="256" name="email-6" data-name="Email 6" id="email-6" required=""><input type="submit" value="Submit" data-wait="Please wait..." class="submit-button w-button">
          </form>
          <div class="w-form-done">
            <div>Thank you! Your submission has been received!</div>
          </div>
          <div class="w-form-fail">
            <div>Oops! Something went wrong while submitting the form.</div>
          </div>
        </div>
      </div>
    </div>
  </div> --}}


@endsection
