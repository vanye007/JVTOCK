{{-- <div data-collapse="medium" data-animation="over-right" data-duration="400" class="dashboard-nav w-nav">
  <div class="w-container"><a href="old-home.html" class="w-nav-brand"><img src="{{asset('images/jvtock-logo.png')}}" width="70" alt=""></a>
    <nav role="navigation" class="open-menue-bg w-nav-menu">
      <a href="/inventory" class="nav-links w-nav-link">Iterms of Interest</a>
      <a href="/action-items" class="nav-links w-nav-link">Action Items</a>
      <a class="nav-links w-nav-link" href="/logout"> Logout </a>

      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
      </form>
    </nav>
    <div class="w-nav-button">
      <div class="w-icon-nav-menu"></div>
    </div>
  </div>
</div> --}}

<div data-collapse="medium" data-animation="over-right" data-duration="400" class="dashboard-nav w-nav">
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="/home"><img src="{{asset('images/jvtock-logo.png')}}" width="70" alt=""></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav mr-auto">
        {{-- <li class="nav-item active">
          <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Features</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Pricing</a>
        </li> --}}
      </ul>
      <span class="navbar-text">
        <a class="nav-link " href="/logout"> Logout </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
      </span>
    </div>
  </nav>
</div>
