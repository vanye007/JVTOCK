@extends('layouts.app')
@section('content')

    <!-- Modal -->
    <div class="modal fade" id="supplier_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="supplier-database-header" id="supplier_formCenterTitle">Referral form</h1>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <label>This is your personal referral form</label>
            <form method="post" action='/supplier_referral/{{Auth::user()->id}}'>
              @csrf

              <div class="form-group">
                <input type="text" class="form-control" id="exampleInputname" name="name" aria-describedby="emailHelp" placeholder="Supplier name">
                {{-- <small id="namehelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
              </div>
              <div class="form-group">
                <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp" placeholder="Supplier email">
                {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
              </div>
              <div class="form-group">
                <input type="phone" class="form-control" name="phone" id="exampleInputphone" placeholder="Supplier phone ">
              </div>

              <button type="submit" class="button edit-button w-button">Send</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="section supplier-data-sec">
      <div>
        <h1 class="supplier-database-header">Supplier Database</h1>
      </div>

    </div>

    <div class="section supplier-data-sec data-table ">
      <div class="w-row">
        <div class="w-col w-col-2 col-sm-4">
          <div><a  class="button edit-button w-button" data-toggle="modal" data-target="#supplier_form">Send supplier form</a></div>
        </div>
      </div>
      @if (sizeof($suppliers))
        <div class="table-responsive">
        <table class="table">
          <thead class="thead-dark">
            <tr>
              <th scope="col">Name</th>
              <th scope="col">Country</th>
              <th scope="col">Product</th>
              <th scope="col">Prices/capacity</th>
              <th scope="col">Sales price</th>
                <th scope="col">Supply capacity</th>
              <th scope="col">Shipping routes</th>
              <th scope="col">Current inventory</th>
              <th scope="col">Port of origin</th>
              <th scope="col">Units per box</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($suppliers->sortByDesc('id') as $key => $value)
              <tr>
                <th scope="row"><a href="/supplier_info/{{$value->id}}">{{$value->name}}</a></th>
                <td>{{$value->country_name}}</td>
                <td>{{$value->type}}</td>
                <td>{{$value->prices_per_capacity}}</td>
                <td>{{$value->price}}</td>
                <td>{{$value->supply_capacity}}</td>
                <td>{{$value->shipping_routes}}</td>
                <td>{{$value->current_inventory}}</td>
                <td>{{$value->port_of_origin}}</td>
                <td>{{$value->units_per_box}}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      @else
        <div style="float: none;" class="w-col w-col-12">
          <div style="text-align:center;">
            <div  class="name-text black-field mb-5"><h1 class="action-header dash-action">No Supplier data </h1></div>
          </div>
        </div>
      @endif
    </div>


@endsection
