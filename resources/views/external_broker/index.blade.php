<!DOCTYPE html>
<!--  Last Published: Thu Apr 09 2020 20:39:22 GMT+0000 (Coordinated Universal Time)  -->
<html data-wf-page="5e8e3bd015febc56d5d0e545" data-wf-site="5e8e3bd015febce0cfd0e544">
<head>
  <meta charset="utf-8">
  <title>Buyer Input Form</title>
  <meta content="width=device-width, initial-scale=1" name="viewport">
  <link href="{{asset('css/normalize.css')}}" rel="stylesheet" type="text/css">
  <link href="{{asset('css/components.css')}}" rel="stylesheet" type="text/css">
  <link href="{{asset('css/buyer-input-form.css')}}" rel="stylesheet" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js" type="text/javascript"></script>
  <script type="text/javascript">WebFont.load({  google: {    families: ["Open Sans:300,300italic,400,400italic,600,600italic,700,700italic,800,800italic"]  }});</script>
  <!-- [if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js" type="text/javascript"></script><![endif] -->
  <script type="text/javascript">!function(o,c){var n=c.documentElement,t=" w-mod-";n.className+=t+"js",("ontouchstart"in o||o.DocumentTouch&&c instanceof DocumentTouch)&&(n.className+=t+"touch")}(window,document);</script>
  <link href="images/favicon.ico" rel="shortcut icon" type="image/x-icon">
  <link href="images/webclip.png" rel="apple-touch-icon">
</head>
<body>
  <div class="buyer-input-section">
    <div class="buyer-input-cont w-container">
      <div class="buyer-input-form">
        <a href="https://jvtock.com"><img style="display:block;margin:auto;" src="{{asset('images/jvtock-logo.png')}}" width="70" alt=""></a>
        <div class="w-form">
          <form id="email-form"  action='{{url("/buyer_request")}}' method='post'  enctype='multipart/form-data'>
            @csrf
            <h1 class="buyer-header">Buyer Form</h1>
            <label for="name" class="field-label">Full Name</label><input type="text" class="input-fields w-input" maxlength="256" name="name" value="{{ old('name') }}" data-name="Name" id="name" required="">
            <label for="email" class="field-label">Email</label><input type="email" class="input-fields w-input" maxlength="256" name="email" value="{{ old('email') }}" data-name="Email 5" id="email-5" required="">
            <label for="phone" class="field-label">Phone</label><input type="number" class="input-fields w-input" maxlength="256" name="phone" value="{{ old('phone') }}" data-name="Phone" id="phone" required="">
            <select class="input-fields w-input" name="countries">
              @foreach ($countries as $key => $value)
                <option value="{{$value->id}}" >{{$value->country_name}}</option>
              @endforeach
            </select>
            {{-- <input type="file" name="proof" id="file" class="inputfile w-input" required />
            <label class="p-3 mt-2 input-fields w-input" for="file">Proof of funds</label> --}}

            <label for="myfile" class="field-label">Proof of funds:</label>
            <input type="file" class="input-fields w-input" name="proof">
            @if ($errors->any())
              <label for="myfile" class="field-label">
                  @foreach ($errors->all() as $error)
                    {{ $error }}
                  @endforeach
              </label>
            @endif
            <br><br>
            <label for="Certification" class="field-label">Port of Delivery</label><input type="text" class="input-fields w-input" maxlength="256" name="delivery_port" data-name="Certification" id="Certification" required=""><input type="submit" value="Submit" data-wait="Please wait..." class="submit-button w-button">
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
  <script src="https://d3e54v103j8qbb.cloudfront.net/js/jquery-3.4.1.min.220afd743d.js?site=5e8e3bd015febce0cfd0e544" type="text/javascript" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <script src="{{asset('js/buyer-input-form-b30044.js')}}" type="text/javascript"></script>
  <!-- [if lte IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js"></script><![endif] -->
</body>
</html>
