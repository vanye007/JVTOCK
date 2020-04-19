@extends('layouts.app')
@section('content')

  <div class="action-section centred">
    <div class="action-item-div">
      <p class="paragraph-2"></p>
    </div>
    <h1 class="action-header">ACTION REQUIRED</h1>
    <p class="paragraph-2 address">Please address the below actions</p>
  </div>
  <div class="action-section list">
    <a href="edit-template.html" class="link-block-4 w-inline-block">
      <div class="action-item-div">
        <p class="paragraph-2">New buyer entered: Missing POF</p>
      </div>
    </a>
  </div>
  <div class="action-section list list2">
    <div class="action-item-div">
      <a href="edit-template.html" class="link-block-4 w-inline-block">
        <div class="action-item-div">
          <p class="paragraph-2">New Supplier entered: Missing POL</p>
        </div>
      </a>
    </div>
  </div>
  <div class="action-section list list2">
    <a href="edit-template.html" class="link-block-4 w-inline-block">
      <div class="action-item-div">
        <p class="paragraph-2">Suspected match between buyer and seller</p>
      </div>
    </a>
  </div>
  <div class="action-section list list2">
    <div class="action-item-div">
      <a href="edit-template.html" class="link-block-4 w-inline-block">
        <div class="action-item-div">
          <p class="paragraph-2">Pending paperwork for deal #2211</p>
        </div>
      </a>
    </div>
  </div>

@endsection
