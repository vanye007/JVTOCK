@extends('layouts.app')
@section('content')

  <div class="action-section centred">
    <div class="action-item-div">
      <p class="paragraph-2"></p>
    </div>
    <h1 class="action-header">ACTION REQUIRED</h1>
    <p class="paragraph-2 address">Please address the below actions</p>
  </div>
  @if (sizeof($buyer_actions)>0 || sizeof($supplier_actions))


  @else
    <div class="action-section list">
    <div class="action-item-div">
      <p class="paragraph-2 dash-parag">No action</p>
    </div>
  </div>


  @endif
  @foreach ($buyer_actions as $key => $value)
    <div class="action-section list">
      <a href="/buyer-database" class="link-block-4 dash-link w-inline-block">
        <div class="action-item-div">
          <p class="paragraph-2 dash-parag">New buyer entered</p>
        </div>
      </a>
    </div>
  @endforeach

  @foreach ($supplier_actions as $key => $value)
    <div class="action-section list">
    <a href="/supplier-database" class="link-block-4 dash-link w-inline-block">
      <div class="action-item-div">
        <p class="paragraph-2 dash-parag">New buyer entered: Missing POF</p>
      </div>
    </a>
  </div>
  @endforeach

@endsection
