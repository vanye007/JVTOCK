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


          @if (sizeof($buyer_actions)>0 || sizeof($supplier_actions))


          @else

            <div class="action-item-div">
              <p class="paragraph-2 dash-parag">No action</p>
            </div>


          @endif
          @foreach ($buyer_actions as $key => $value)
              <a href="/buyer-database" class="link-block-4 dash-link w-inline-block">
                <div class="action-item-div">
                  <p class="paragraph-2 dash-parag">New buyer entered</p>
                </div>
              </a>
          @endforeach

          @foreach ($supplier_actions as $key => $value)
            <a href="/supplier-database" class="link-block-4 dash-link w-inline-block">
              <div class="action-item-div">
                <p class="paragraph-2 dash-parag">New buyer entered: Missing POF</p>
              </div>
            </a>
          @endforeach

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
  @if (sizeof($suppliers)>0)
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


  </div>

  @else
    <div style="float: none;" class="w-col w-col-12">
      <div style="text-align:center;">
        <div  class="name-text black-field mb-5"><h1 class="action-header dash-action">No Supplier Data </h1></div>
      </div>
    </div>
  @endif
  <a href="/supplier-database" class="button dash-button w-button">Edit</a></div>
  <div class="section supplier-data-sec data-table buyer dash">
    @if (sizeof($buyers)>0)
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
            <div class="name-text">Phone</div>
          </div>
        </div>
        <div class="w-col w-col-2 w-col-small-2 w-col-tiny-2">
          <div>
            <div class="name-text">Interested Product</div>
          </div>
        </div>
        <div class="w-col w-col-2 w-col-small-2 w-col-tiny-2">
          <div>
            <div class="name-text">Delivery Port</div>
          </div>
        </div>

        <div class="w-col w-col-2 w-col-small-2 w-col-tiny-2">
          <div>
            <div class="name-text">Proof of Funds</div>
          </div>
        </div>
      </div>
      @foreach ($buyers->sortByDesc('id') as $key => $value)
      <div class="w-row">
          <div class="w-col w-col-2 w-col-small-2 w-col-tiny-2">
            <div>
              <a href="/buyer_info/{{$value->id}}" class="name-click w-inline-block">
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
              <div class="name-text black-field">{{$value->phone}}</div>
            </div>
          </div>

          <div class="w-col w-col-2 w-col-small-2 w-col-tiny-2">
            <div>
              <div class="name-text black-field">@foreach ($inquiry as $key => $inq_value)
                @if ($inq_value->buyer_id == $value->id)
                  {{$inq_value->type}}
                @endif
              @endforeach</div>
            </div>
          </div>

          <div class="w-col w-col-2 w-col-small-2 w-col-tiny-2">
            <div>
              <div class="name-text black-field"> {{$value->delivery_port}} </div>
            </div>
          </div>

          <div class="w-col w-col-2 w-col-small-2 w-col-tiny-2">
            <div>
              <div class="name-text black-field"> {{$value->proof}} </div>
            </div>
          </div>
          </div>

        @endforeach

    @else
      <div style="float: none;" class="w-col w-col-12">
        <div style="text-align:center;">
          <div  class="name-text black-field mb-5"><h1 class="action-header dash-action">No Buyer Data </h1></div>
        </div>
      </div>

    @endif



<a href="/buyer-database" class="button dash-button w-button">Edit</a></div>
  <div id="item-of-interest" class="items-of-interest-div dash-inventory">
    <section id="cards-section" class="cards-section">
      <div class="centered-container w-container">
        <h2 class="items-of-interest-header">Inventory</h2>
        @if (sizeof($products)>0)
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

        @else
          <div style="float: none;" class="w-col w-col-12">
            <div style="text-align:center;">
              <div  class="name-text black-field mb-5"><h1 class="action-header dash-action">No Inventory </h1></div>
            </div>
          </div>

        @endif

      </div><a  class="button dash-button w-button" data-toggle="modal" data-target="#upload_product">Upload Product</a></section>
  </div>

</div>


@endsection
