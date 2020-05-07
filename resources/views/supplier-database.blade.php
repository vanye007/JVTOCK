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
                <input type="text" class="form-control" id="exampleInputname" name="firstname" aria-describedby="emailHelp" placeholder="Supplier name">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" id="exampleInputname" name="lastname" aria-describedby="emailHelp" placeholder="Supplier name">
              </div>
              <div class="form-group">
                <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp" placeholder="Supplier email">
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
      @if (sizeof($suppliers)>0)
        <div style="float: none;" class="w-col w-col-12">
        </div>
        <div class="table-responsive">
        <table  id="supplier" class="table">
          <thead class="thead-dark">
            <tr>
              <th scope="col">Name</th>
              <th scope="col">Country</th>
              <th scope="col">Region</th>
              <th scope="col">Product</th>
              <th scope="col">Price</th>
              <th scope="col">Supply Capacity</th>
              <th scope="col">Inventory</th>
              <th scope="col">Shipping Terms</th>
              <th scope="col">Payment Terms</th>
              <th scope="col">Port of origin</th>
              <th scope="col">Status</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($suppliers->sortByDesc('id') as $key => $value)
              <tr>
                <th scope="row"><a href="/supplier_info/{{$value->supplier_id}}">{{$value->firstname}} {{$value->lastname}}</a></th>
                <td>{{$value->country_name}}</td>
                <td>{{$value->region}}</td>
                <td>{{$value->name}}</td>
                <td>{{$value->price}}</td>
                <td>{{$value->capacity}}</td>
                <td>{{$value->inventory}}</td>
                <td>{{$value->shipping_terms}}</td>
                <td>{{$value->payment_terms}}</td>
                <td>{{$value->port_of_origin}}</td>
                <td>{{$value->status}}</td>
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
