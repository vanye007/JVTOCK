@extends('layouts.app')

@section('content')

@php( $buyer_doc = \App\buyer_doc::all())
@php( $supplier_doc = \App\supplier_docs::all())

  <div class="title">
    <div class="w-container">
      <div>
        <h1 class="dashboard-header">dashboard</h1>
      </div>


    </div>
  </div>
  <div class="section mt-0  data-table buyer dash">
    <div class="w-row">
      <div class="w-col w-col-7">
          <a href="/export/inventory"><button type="button" class="btn btn-primary btn-lg mb-3 mt-2">Export Inventory</button></a>
          @if(Auth::user()->email == "wvanye@gmail.com" || Auth::user()->email == "ctkruger@gmail.com")
              <a href="/users"><button type="button" class="btn btn-info btn-lg mb-3 mt-2">Admins</button></a>
          @endif
        <div class="dash-div-1 mb-4">
          <h1 class="action-header dash-action">ACTION REQUIRED</h1>

          @if (sizeof($buyer_actions)>0 || sizeof($supplier_actions) > 0)
            @if (sizeof($buyer_actions)>0)
              <a href="/buyer-database" class="link-block-4 dash-link w-inline-block">
                <div class="action-item-div">
                  <p class="paragraph-2 dash-parag"> {{$buyer_actions->count()}} New buyer entered</p>
                </div>
              </a>
            @endif

            @if (sizeof($supplier_actions)>0)
                  <a href="/supplier-database" class="link-block-4 dash-link w-inline-block">
                    <div class="action-item-div">
                      <p class="paragraph-2 dash-parag"> {{$supplier_actions->count()}} New supplier enter</p>
                    </div>
                  </a>
            @endif

          @else
            <div class="action-item-div">
              <p class="paragraph-2 dash-parag">No action</p>
            </div>

          @endif


          </div>

        {{-- <div class="dash-div-1 spaces"><img src="images/simple-pie-chart-1600.png" width="470" srcset="images/simple-pie-chart-1600-p-500.png 500w, images/simple-pie-chart-1600-p-800.png 800w, images/simple-pie-chart-1600-p-1080.png 1080w, images/simple-pie-chart-1600.png 1600w" sizes="(max-width: 767px) 77vw, (max-width: 991px) 49vw, 470px" alt="" class="image-3"></div> --}}
      </div>
      <div class="w-col w-col-5">
        <div class="dash-div-1">
          <h1 class="heading-4 tt">Template Message</h1>
          <div class="template-cont dash w-container"><img src="images/jvtock-logo.png" width="150" alt="" class="image-2"><a href="/get_message/message" class="button short-button dash-button w-button">Send Message</a>
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

<div class="section supplier-data-sec data-table buyer dash">
  <div>
    @if (sizeof($suppliers)>0)
      <div style="float: none;" class="w-col w-col-12">
        <div style="text-align:center;">
          <div  class="name-text black-field mb-5"><h1 class="action-header dash-action">Supplier Data </h1></div>
        </div>
      </div>
      <div class="table-responsive">
      <table  id="supplier" class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Country</th>
            <th scope="col">Region</th>
            <th scope="col">address</th>
            <th scope="col">Product</th>
            <th scope="col">Price</th>
            <th scope="col">Supply Capacity</th>
            <th scope="col">Inventory</th>
            <th scope="col">Shipping Terms</th>
            <th scope="col">Payment Terms</th>
            <th scope="col">Port of origin</th>
            <th scope="col">Documents</th>
            <th scope="col">Status</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($suppliers->sortByDesc('id') as $key => $value)
            <tr>
              <th scope="row"><a href="/supplier_info/{{$value->supplier_id}}">{{$value->firstname}} {{($value->lastname)}}</a></th>
              <td  data-toggle="modal" id="{{$value->id}}" data-name="supplier"  data-target="#auto_email" class="get_email">{{$value->email}}</td>
              <td>{{$value->country_name}}</td>
              <td>{{$value->region}}</td>
              <td>{{$value->address}}</td>
              <td>{{$value->name}}</td>
              <td>{{$value->price}}</td>
              <td>{{$value->capacity}}</td>
              <td>{{$value->inventory}}</td>
              <td>{{$value->shipping_terms}}</td>
              <td>{{$value->payment_terms}}</td>
              <td>{{$value->port_of_origin}}</td>
              <td>@foreach ($supplier_doc as $key => $s_value)
                @if ($s_value->supplier_infos_id == $value->supplier_id)
                  <a href="/view_doc/{{$s_value->path}}/{{$value->supplier_id}}/supplier">{{$s_value->name}}</a>
                @endif
              @endforeach</td>
              @if ($value->status == 'pending')
                  <td class="text-warning"><b>{{$value->status}}</b></td>
              @else
                  <td class="text-success"><b>{{$value->status}}</b></td>
              @endif
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
  @else
    <div style="float: none;" class="w-col w-col-12">
      <div style="text-align:center;">
        <div  class="name-text black-field mb-5"><h1 class="action-header dash-action">No Supplier Data </h1></div>
      </div>
    </div>
  @endif
  <a href="/supplier-database" class="button dash-button w-button">Explore</a>
  </div>
</div>
  <div class="section supplier-data-sec data-table buyer dash">
    @if (sizeof($buyers)>0)
      <div style="float: none;" class="w-col w-col-12">
        <div style="text-align:center;">
          <div  class="name-text black-field mb-5"><h1 class="action-header dash-action">Buyer Data </h1></div>
        </div>
      </div>
      <div class="table-responsive">
      <table id="buyer" class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Country</th>
            <th scope="col">Region</th>
            <th scope="col">Address</th>
            <th scope="col">Phone</th>
            <th scope="col">Interested product</th>
            <th scope="col">Delivery port</th>
            <th scope="col">Proof of funds</th>
            <th scope="col">Document</th>

          </tr>
        </thead>
        <tbody>

            @foreach ($buyers->sortByDesc('id') as $key => $value)
            <tr>
              <th scope="row"><a href="/buyer_info/{{$value->id}}">{{$value->name}}</a></th>
              <td data-toggle="modal" id="{{$value->id}}" data-name="buyer" data-target="#auto_email" class="get_email">{{$value->email}}</td>
              <td>{{$value->country_name}}</td>
              <td>{{$value->region}}</td>
              <td>{{$value->address}}</td>
              <td>{{$value->phone}}</td>
              <td>@foreach ($inquiry as $key => $inq_value)
                @if ($inq_value->buyer_id == $value->id)
                  {{$inq_value->type}}
                @endif
              @endforeach</td>
              <td>{{$value->delivery_port}}</td>
              <td>{{$value->proof}}</td>
              <td>@foreach ($buyer_doc as $key => $b_value)
                @if ($b_value->buyer_id == $value->id)
                  <a href="/view_doc/{{$b_value->path}}/{{$value->id}}/buyer">{{$b_value->name}}</a>
                @endif
              @endforeach</td>
            </tr>
          @endforeach
        </tbody>
      </table>

    </div>

    @else
      <div style="float: none;" class="w-col w-col-12">
        <div style="text-align:center;">
          <div  class="name-text black-field mb-5"><h1 class="action-header dash-action">No Buyer Data </h1></div>
        </div>
      </div>

    @endif
    <a href="/buyer-database" class="button dash-button w-button">Explore</a></div>
  </div>


  <div id="item-of-interest" class="items-of-interest-div dash-inventory">
    <section id="cards-section" class="cards-section">
      <div class="centered-container w-container">
        <h2 class="items-of-interest-header">Inventory (Front end)</h2>
        @if (sizeof($products)>0)
          <div class="cards-grid-container">
            @foreach ($products as $key => $value)
              <div id="{{$value->id}}" class="w-clearfix">
                <div class="cards-image-mask"><img src='{{asset("images/products/{$value->image_path}")}}' alt="" class="cards-image"></div>
                <h3 class="heading">{{$value->type}}</h3>
                <p>{!!  substr(strip_tags($value->description), 0, 38) !!}..</p>
                {{-- <div class="price in-stock">In Stock</div> --}}
                <div class="price">{{$value->price}}</div>
                <a href="/product-info/{{$value->id}}" class="button w-button">Select</a>
              </div>
            @endforeach
          </div>

        @else
          <div style="float: none;" class="w-col w-col-12">
            <div style="text-align:center;">
              <div  class="name-text black-field mb-5"><h1 class="action-header dash-action">No Inventory </h1></div>
            </div>
          </div>

        @endif

      </div><a href="" class="button dash-button w-button" data-toggle="modal" data-target="#upload_product">Upload Product</a></section>
  </div>




@endsection
