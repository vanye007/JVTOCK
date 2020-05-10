@extends('external_broker.template')
@section('content')
  <div class="supplier-input-section">
    <div class="supplier-input-cont w-container">
      <div class="supplier-input-div">
        <a href="https://jvtock.com"><img style="display:block;margin:auto;" src="{{asset('images/jvtock-logo.png')}}" width="70" alt=""></a>
        <div class="w-form">
          <form id="package-form" action='/packages' method='post'>
            @csrf
            <h1 class="supplier-form">Units / Package information</h1>
            @if ($errors->any())
              <label for="myfile" class="field-label">
                  @foreach ($errors->all() as $error)
                    {{ $error }}
                  @endforeach
              </label>
            @endif
            <label for="name" class="field-label">Length </label>
            <input type="text" class="input-fields w-input" maxlength="256" name="length" data-name="length" id="length" required>
            <input type="hidden" class="input-fields w-input" value="{{$product_info_fk}}" maxlength="256" name="product_info" data-name="product_info" id="product_info" required="">
            <label for="name" class="field-label">Width </label>
            <input type="text" class="input-fields w-input" maxlength="256" name="width" data-name="width" id="width" required="">
            <label for="name" class="field-label">Height </label>
            <input type="text" class="input-fields w-input" maxlength="256" name="height" data-name="height" id="height" required="">
            <br>
            <hr>
            <br>
            <h1 class="supplier-form">Packages / Carton information</h1>
            <label for="name" class="field-label">Length</label>
            <input type="text" class="input-fields w-input" maxlength="256" name="carton_length" data-name="carton_length" required="">
            <label for="name" class="field-label">Width </label>
            <input type="text" class="input-fields w-input" maxlength="256" name="carton_width" data-name="carton_width"  required="">
            <label for="name" class="field-label">Height </label>
            <input type="text" class="input-fields w-input" maxlength="256" name="carton_height" data-name="carton_height" required="">
            <label for="name" class="field-label">Weight </label>
            <input type="text" class="input-fields w-input" maxlength="256" name="weight" data-name="weight"  required="">
            <input type="submit" value="finish" class="submit-button w-button">
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
