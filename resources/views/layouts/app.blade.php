<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
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
