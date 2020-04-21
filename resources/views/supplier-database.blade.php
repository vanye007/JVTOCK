@extends('layouts.app')
@section('content')


    <div class="section supplier-data-sec">
      <div>
        <h1 class="supplier-database-header">Supplier Database</h1>
      </div>

    </div>

    <div class="section supplier-data-sec data-table">
      @if (sizeof($suppliers))
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
      @else
        <div style="float: none;" class="w-col w-col-12">
          <div style="text-align:center;">
            <div  class="name-text black-field mb-5"><h1 class="action-header dash-action">No Supplier data </h1></div>
          </div>
        </div>
      @endif
    </div>


@endsection
