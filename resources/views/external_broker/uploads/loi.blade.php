@extends('external_broker.template')
@section('content')

  @if(session()->has('success'))
  <div class="supplier-input-section">
    <div class="supplier-input-cont w-container">
      <div class="supplier-input-div">
        <a href="https://jvtock.com"><img style="display:block;margin:auto;" src="{{asset('images/jvtock-logo.png')}}" width="70" alt=""></a>
        <div class="alert alert-success" style="margin:15px;">
          <strong>Success!</strong> {{ session()->get('success') }}
        </div>
        <p style="width:100%;text-align:center;" > <a href="https://jvtock.com/" class="nav-links w-nav-link"><i class="fa fa-angle-left"></i>Visit our webpage</a></p>
    </div>
  </div>
</div>

  @else

    <div class="supplier-input-section">
      <div class="supplier-input-cont w-container">
        <div class="supplier-input-div">
          <a href="https://jvtock.com"><img style="display:block;margin:auto;" src="{{asset('images/jvtock-logo.png')}}" width="70" alt=""></a>
          <div class="w-form">
            <form id="email-form" action='/supplier_loi' method='post' enctype='multipart/form-data'>
              @csrf
              <h1 class="supplier-form">Upload LOI document</h1>
              @if ($errors->any())
                <label for="myfile" class="field-label">
                    @foreach ($errors->all() as $error)
                      {{ $error }}
                    @endforeach
                </label>
              @endif
              <input type="hidden" name="id" value="{{$id}}"/>
              <input type="file" class="input-fields w-input" maxlength="256" name="loi" data-name="loi" id="loi" required="">
              <button style="margin:auto;display:block;" class="btn btn-primary">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  @endif

@endsection
