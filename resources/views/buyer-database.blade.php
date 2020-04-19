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

  </div>
</div>

@endsection
