@extends('layouts.app')

@section('content')

  <!-- Modal -->
<div class="modal fade" id="upload_product" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <form method="post" action="/upload_product" enctype='multipart/form-data'>
          @csrf
          <input type="text" class="form-field w-input" maxlength="256" name="type"  placeholder="Product Name"  required="">
          <input type="text" class="form-field w-input" maxlength="256" name="price"  placeholder="Price" required="">
          <textarea style="width:100%;" placeholder="Product description" name="description" class="form-field w-input" maxlength="256" rows="10" ></textarea>
          <input type="file" class="input-fields w-input" maxlength="256" name="image"  required="">
          <button class="button w-button">Upload</button>
        </form>
      </div>
    </div>
  </div>
</div>

  {{-- @guest
  <li class="nav-item">
      <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
  </li>
  @if (Route::has('register'))
      <li class="nav-item">
          <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
      </li>
  @endif
@else

  <li class="nav-item dropdown">
      <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
          {{ Auth::user()->name }} <span class="caret"></span>
      </a>

      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="{{ route('logout') }}"
             onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
              {{ __('Logout') }}
          </a>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
          </form>
      </div>
  </li>
@endguest --}}


  <div class="title">
    <div class="w-container">
      <div>
        <h1 class="dashboard-header">dashboard</h1>
      </div>
    </div>
  </div>
  <div class="_1st-sect">
    <div class="w-row">
      <div class="w-col w-col-7">
        <div class="dash-div-1">
          <h1 class="action-header dash-action">ACTION REQUIRED</h1>
          <a href="/edit-template" class="link-block-4 dash-link w-inline-block">
            <div class="action-item-div">
              <p class="paragraph-2 dash-parag">New buyer entered: Missing POF</p>
            </div>
          </a>
          <a href="/edit-template" class="link-block-4 dash-link w-inline-block">
            <div class="action-item-div">
              <p class="paragraph-2 dash-parag">New Supplier entered: Missing POL</p>
            </div>
          </a>
          <a href="/edit-template" class="link-block-4 dash-link w-inline-block">
            <div class="action-item-div">
              <p class="paragraph-2 dash-parag">Suspected match between buyer and seller</p>
            </div>
          </a>
          <a href="/edit-template" class="link-block-4 dash-link w-inline-block">
            <div class="action-item-div">
              <p class="paragraph-2 dash-parag">Pending paperwork for deal #2211</p>
            </div>
          </a>
          <a href="/edit-template" class="link-block-4 dash-link w-inline-block">
            <div class="action-item-div">
              <p class="paragraph-2 dash-parag">New buyer entered: Missing POF</p>
            </div>
          </a>
          <a href="/edit-template" class="link-block-4 dash-link w-inline-block">
            <div class="action-item-div">
              <p class="paragraph-2 dash-parag">New buyer entered: Missing POF</p>
            </div>
          </a><a href="/action-items" class="button dash-button action-sec w-button">Edit</a></div>
        {{-- <div class="dash-div-1 spaces"><img src="images/simple-pie-chart-1600.png" width="470" srcset="images/simple-pie-chart-1600-p-500.png 500w, images/simple-pie-chart-1600-p-800.png 800w, images/simple-pie-chart-1600-p-1080.png 1080w, images/simple-pie-chart-1600.png 1600w" sizes="(max-width: 767px) 77vw, (max-width: 991px) 49vw, 470px" alt="" class="image-3"></div> --}}
      </div>
      <div class="w-col w-col-5">
        <div class="dash-div-1">
          <h1 class="heading-4 tt">Template Message</h1>
          <div class="template-cont dash w-container"><img src="images/jvtock-logo.png" width="150" alt="" class="image-2"><a href="/edit-template" class="button short-button dash-button w-button">Send Message</a>
            <div class="div-block-2">
              <p>@foreach ($template as $key => $value)
                @if ($value->type == 'message')
                  {{$value->message}}

                @endif

              @endforeach<br>‍</p>
              <p><strong class="bold-signiture">Kind Regards</strong>,<br>‍<br>{{$name}} from JVTOCK</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="_1st-sect _2nd-sec supplier_database">
    <div>
      <h1 class="supplier-database-header dash">Supplier Database</h1>
      <div class="columns w-row">
        <div class="w-col w-col-2">
          <div>
            <div class="name-text">Name</div>
          </div>
        </div>
        <div class="w-col w-col-2">
          <div>
            <div class="name-text">Country</div>
          </div>
        </div>
        <div class="w-col w-col-2">
          <div>
            <div class="name-text">Product</div>
          </div>
        </div>
        <div class="w-col w-col-2">
          <div>
            <div class="name-text">Price per capacity</div>
          </div>
        </div>
        <div class="w-col w-col-2">
          <div>
            <div class="name-text">Sale Price</div>
          </div>
        </div>

        <div class="w-col w-col-2">
          <div>
            <div class="name-text">Current inventory</div>
          </div>
        </div>


        <div class="w-col w-col-2">
          <div>
            <div class="name-text">Shipping routes</div>
          </div>
        </div>

      </div>

        @foreach ($suppliers->sortByDesc('id') as $key => $value)
            <div class="columns w-row">
          <div class="w-col w-col-2">
            <div>
              <a href="/supplier_info/{{$value->id}}" class="name-click w-inline-block">
                <div class="name-text black-field">{{$value->name}}</div>
              </a>
            </div>
          </div>

          <div class="w-col w-col-2">
            <div>
              <div class="name-text black-field">{{$value->country_name}}</div>
            </div>
          </div>

          <div class="w-col w-col-2">
            <div>
              <div class="name-text black-field">{{$value->type}}</div>
            </div>
          </div>

          <div class="w-col w-col-2">
            <div>
              <div class="name-text black-field">{{$value->prices_per_capacity}}</div>
            </div>
          </div>

          <div class="w-col w-col-2">
            <div>
              <div class="name-text black-field">{{$value->price}}</div>
            </div>
          </div>

          <div class="w-col w-col-2">
            <div>
              <div class="name-text black-field">{{$value->current_inventory}}</div>
            </div>
          </div>


          <div class="w-col w-col-2">
            <div>
              <div class="name-text black-field">{{$value->shipping_routes}}</div>
            </div>
          </div>

        </div>

        @endforeach


    </div><a href="/supplier-database" class="button dash-button w-button">Edit</a></div>
  <div class="section supplier-data-sec data-table buyer dash">
    <h1 class="supplier-database-header dash">Buyer Database</h1>
    <div class="w-row">
      <div class="w-col w-col-2 w-col-small-2 w-col-tiny-2">
        <div>
          <div class="name-text">Name</div>
        </div>
      </div>
      <div class="w-col w-col-2 w-col-small-2 w-col-tiny-2">
        <div>
          <div class="name-text">Country</div>
        </div>
      </div>
      <div class="w-col w-col-2 w-col-small-2 w-col-tiny-2">
        <div>
          <div class="name-text">Product</div>
        </div>
      </div>
      <div class="w-col w-col-2 w-col-small-2 w-col-tiny-2">
        <div>
          <div class="name-text">Demand</div>
        </div>
      </div>
      <div class="w-col w-col-2 w-col-small-2 w-col-tiny-2">
        <div>
          <div class="name-text">Proof of funds</div>
        </div>
      </div>
      <div class="w-col w-col-2 w-col-small-2 w-col-tiny-2">
        <div>
          <div class="name-text">LOI</div>
        </div>
      </div>
    </div>

    @foreach ($buyers->sortByDesc('id') as $key => $value)
    <div class="w-row">
        <div class="w-col w-col-2 w-col-small-2 w-col-tiny-2">
          <div>
            <a href="supplier-name-info.html" class="name-click w-inline-block">
              <div class="name-text black-field">{{$value->name}}</div>
            </a>
          </div>
        </div>

        <div class="w-col w-col-2 w-col-small-2 w-col-tiny-2">
          <div>
            <div class="name-text black-field">{{$value->country_name}}</div>
          </div>
        </div>

        <div class="w-col w-col-2 w-col-small-2 w-col-tiny-2">
          <div>
            <div class="name-text black-field">{{$value->type}}</div>
          </div>
        </div>

        <div class="w-col w-col-2 w-col-small-2 w-col-tiny-2">
          <div>
            <div class="name-text black-field"> Null </div>
          </div>
        </div>

        <div class="w-col w-col-2 w-col-small-2 w-col-tiny-2">
          <div>
            <div class="name-text black-field"> {{$value->proof}} </div>
          </div>
        </div>
        </div>

      @endforeach


<a href="/buyer-database" class="button dash-button w-button">Edit</a></div>
  <div id="item-of-interest" class="items-of-interest-div dash-inventory">
    <section id="cards-section" class="cards-section">
      <div class="centered-container w-container">
        <h2 class="items-of-interest-header">Inventory</h2>
        <div class="cards-grid-container">
          @foreach ($products as $key => $value)
            <div id="{{$value->id}}" class="w-clearfix">
              <div class="cards-image-mask"><img src='{{asset("images/products/{$value->image_path}")}}' alt="" class="cards-image"></div>
              <h3 class="heading">{{$value->type}}</h3>
              <p>{!!  substr(strip_tags($value->description), 0, 150) !!} .... </p>
              {{-- <div class="price in-stock">In Stock</div> --}}
              <div class="price">${{$value->price}}</div>
              <a href="/product-info/{{$value->id}}" class="button w-button">Select</a>
            </div>
          @endforeach
        </div>
      </div><a  class="button dash-button w-button" data-toggle="modal" data-target="#upload_product">Upload Product</a></section>
  </div>

</div>


@endsection
