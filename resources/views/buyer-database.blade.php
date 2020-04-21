@extends('layouts.app')
@section('content')

  <div class="section supplier-data-sec buyer-sec-title">
    <div>
      <h1 class="supplier-database-header">Buyer Database</h1>
    </div>
  </div>
  <div class="section supplier-data-sec data-table buyer">
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

  </div>
</div>

@endsection
