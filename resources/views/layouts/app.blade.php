<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <link href="{{asset('css/normalize.css')}}" rel="stylesheet" type="text/css">
  <link href="{{asset('css/components.css')}}" rel="stylesheet" type="text/css">
  <link href="{{asset('css/admin/jvtock-broker-system.css')}}" rel="stylesheet" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js" type="text/javascript"></script>
  <script type="text/javascript">WebFont.load({  google: {    families: ["Open Sans:300,300italic,400,400italic,600,600italic,700,700italic,800,800italic"]  }});</script>
  <!-- [if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js" type="text/javascript"></script><![endif] -->
  <script type="text/javascript">!function(o,c){var n=c.documentElement,t=" w-mod-";n.className+=t+"js",("ontouchstart"in o||o.DocumentTouch&&c instanceof DocumentTouch)&&(n.className+=t+"touch")}(window,document);</script>
  <link href="images/favicon.ico" rel="shortcut icon" type="image/x-icon">
  <link href="images/webclip.png" rel="apple-touch-icon">
</head>

<!-- Modal -->
<div class="modal fade" id="upload_product" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
  <div class="modal-content">
    <div class="modal-body">
      <h1 class="supplier-database-header">Upload Product</h1>
      <form method="post" action="/upload_product" enctype='multipart/form-data'>
        @csrf
        <input type="text" class="form-field w-input" maxlength="256" name="type"  placeholder="Product Name"  required="">
        <input type="text" class="form-field w-input" maxlength="256" name="price"  placeholder="Price" required="">
        <textarea style="width:100%;" placeholder="Product description" name="description" class="form-field w-input" maxlength="256" rows="10" ></textarea>
        <input type="file" name="image" id="file" class="inputfile" required />
        <label class="p-3 mt-2" for="file">Choose an image</label>
        {{-- <input type="file" class="input-fields w-input inputfile" maxlength="256" name="image"  required="">
        <label for="file">Choose a file</label> --}}
        <button class="button w-button mt-4">Upload</button>
      </form>
    </div>
  </div>
</div>
</div>

@if(session()->has('notification'))
  <div class="notification alert alert-success alert-dismissible fade show" role="alert">
      {{ session()->get('notification') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
@endif



  @if (\Request::is('login'))
        @yield('content')

  @else
    <body class="buyer-dash-body">
      @if (\Request::is('login') || \Request::is('register') )

      @else
        @include('layouts.dashboard-nav')
        @include('layouts.side-nav')
      @endif


      @yield('content')

     {{-- @if (\Request::is('login'))

     @else
       @include('layouts.side-nav')

     @endif --}}

   </body>


  @endif


<script src="https://d3e54v103j8qbb.cloudfront.net/js/jquery-3.4.1.min.220afd743d.js?site=5e854119fc8197562bad8342" type="text/javascript" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="{{ asset('/js/admin/admin.js') }}" defer></script>
</html>
