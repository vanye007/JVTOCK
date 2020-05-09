@extends('external_broker.template')
@section('content')
  <div class="supplier-input-section">
    <div class="supplier-input-cont w-container">
      <div class="supplier-input-div">
        <div class="w-form">
          <form id="email-form" action='/submit_product_info' method='post' enctype='multipart/form-data'>
            @csrf
            <h1 class="supplier-form">Product information</h1>
            @if ($errors->any())
              <label for="myfile" class="field-label">
                  @foreach ($errors->all() as $error)
                    {{ $error }}
                  @endforeach
              </label>
            @endif
            <label for="name" class="field-label">Product Name </label>
            <input type="text" class="input-fields w-input" maxlength="256" name="name" data-name="name" id="name" required="">
            <input type="hidden" class="input-fields w-input" value="{{$facility_info}}" maxlength="256" name="facility_info"  value="{{ old('facility_info') }}" data-name="name" id="facility_info" required="">
            <label for="name" class="field-label">Product description</label>
            <textarea name="description"  value="{{ old('description') }}" class="input-fields w-input">
            </textarea>
            <label for="name" class="field-label">Product Certificates </label>
            <input type="text" class="input-fields w-input" maxlength="256" placeholder="Certificate type" name="cert_type"  value="{{ old('cert_type') }}" data-name="cert_type" id="cert_name" required="">
            <input type="file" class="input-fields w-input" maxlength="256" name="certificates"  value="{{ old('certificates') }}" data-name="certificates" id="certificates" required="">
            <label for="name" class="field-label">Product Image </label>
            <input type="file" class="input-fields w-input" maxlength="256" name="image"  value="{{ old('image') }}" data-name="image" id="image" required="">
            {{-- <label for="name" class="field-label">Proof of life (Product video) </label>
            <input type="file" class="input-fields w-input" maxlength="256" name="pof" data-name="image" id="image" required=""> --}}
            <label for="name" class="field-label">Price</label>
            <input type="text" class="input-fields w-input" maxlength="256" name="price"  value="{{ old('price') }}" data-name="price" id="price" required="">
            <label for="name" class="field-label">Volume </label>
            <input type="text" class="input-fields w-input" maxlength="256" name="volume"  value="{{ old('volume') }}" data-name="volume" id="volume" required="">
            <label for="name" class="field-label">Inventory</label>
            <input type="text" class="input-fields w-input" maxlength="256" name="inventory"  value="{{ old('inventory') }}" data-name="inventory" id="inventory" required="">
            <label for="name" class="field-label">Supply Capacity </label>
            <input type="text" class="input-fields w-input" maxlength="256" name="capacity"  value="{{ old('capacity') }}" data-name="capacity" id="capacity" required="">
            <label for="name" class="field-label">Select Audit Date </label>
            <input type="date" class="input-fields w-input" maxlength="256" name="date" data-name="date" id="date"  value="{{ old('date') }}" required="">
            <input type="submit" value="Next" data-wait="Please wait..." class="submit-button w-button">
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
