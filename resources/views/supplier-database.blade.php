@extends('layouts.app')
@section('content')


    <div class="section supplier-data-sec">
      <div>
        <h1 class="supplier-database-header">Supplier Database</h1>
      </div>
      {{-- <div class="w-row">
        <div class="w-col w-col-2">
          <div><a href="#" class="button supplier-nav-button w-button">Modify Tables</a></div>
        </div>
        <div class="w-col w-col-2">
          <div><a href="#" class="button supplier-nav-button w-button">manage data</a></div>
        </div>
        <div class="w-col w-col-2">
          <div><a href="#" class="button supplier-nav-button w-button">create template</a></div>
        </div>
        <div class="w-col w-col-2">
          <div><a href="#" class="button supplier-nav-button w-button">Revert Changes</a></div>
        </div>
        <div class="w-col w-col-2"></div>
        <div class="w-col w-col-2">
          <div>
            <div data-hover="" data-delay="0" class="button filter w-dropdown">
              <div class="dropdown-toggle w-dropdown-toggle">
                <div class="icon w-icon-dropdown-toggle"></div>
                <div>filter</div>
              </div>
              <nav class="w-dropdown-list"><a href="#" class="filter-open-design w-dropdown-link">Cost</a><a href="#" class="filter-open-design w-dropdown-link">Product</a><a href="#" class="filter-open-design w-dropdown-link">Country</a><a href="#" class="filter-open-design w-dropdown-link">Name</a></nav>
            </div>
          </div>
        </div>
      </div> --}}
    </div>
    <div class="section supplier-data-sec data-table">
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
            <div class="name-text">prices per capacity</div>
          </div>
        </div>
        <div class="w-col w-col-2">
          <div>
            <div class="name-text">Sale Price</div>
          </div>
        </div>
        <div class="w-col w-col-2">
          <div>
            <div class="name-text">Current Supply</div>
          </div>
        </div>


        <div class="w-col w-col-2">
          <div>
            <div class="name-text">Shipping routess</div>
          </div>
        </div>




        <div class="w-col w-col-2">
          <div>
            <div class="name-text">Current inventory</div>
          </div>
        </div>

        <div class="w-col w-col-2">
          <div>
            <div class="name-text">Port of origin</div>
          </div>
        </div>

        <div class="w-col w-col-2">
          <div>
            <div class="name-text">Units per box</div>
          </div>
        </div>

      </div>
      @foreach ($suppliers->sortByDesc('id') as $key => $value)
          <div class="w-row columns">
        <div class="w-col w-col-2">
          <div>
            <a href="/supplier_info/{{$value->id}}" class="name-click w-inline-block">

              <div class="name-text black-field">{{$value->name}} </div>
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



        <div class="w-col w-col-2">
          <div>
            <div class="name-text black-field">{{$value->current_inventory}}</div>
          </div>
        </div>

        <div class="w-col w-col-2">
          <div>
            <div class="name-text black-field">{{$value->port_of_origin}}</div>
          </div>
        </div>

        <div class="w-col w-col-2">
          <div>
            <div class="name-text black-field">{{$value->units_per_box}}</div>
          </div>
        </div>


      </div>

      @endforeach






    </div>


@endsection
