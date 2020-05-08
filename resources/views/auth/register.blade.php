@extends('layouts.app')

@section('content')
  <div class="w-container">
<div class="w-row">
<div class="sign-up-col orange w-col w-col-12">
  <div class="login-div _2 height">
    <h1 class="heading-5 heading-2">Create Account</h1><a href="#" class="link-block-5 w-inline-block"></a><a href="#" class="link-block-6 w-inline-block"></a><a href="#" class="link-block-7 w-inline-block"></a>
    <div class="text-block">Or Use your email for registration.</div>
    <div class="w-form">
      <form id="email-form" method="post" name="email-form" data-name="Email Form" action="{{ route('register') }}">
        @csrf
        <input type="text" class="form-field w-input" maxlength="256" name="name" data-name="Name" placeholder="Name" id="name" required="">
        @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        <input type="email" class="form-field w-input" maxlength="256" name="email" data-name="Email" placeholder="Email" id="email" required="">
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        <input type="password" class="form-field w-input" maxlength="256" name="password" data-name="Password" placeholder="Password" id="Password" required="">
        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        <input type="password" class="form-field w-input" maxlength="256" name="password_confirmation" data-name="Password" placeholder="Password" id="Password" required="">
        <button type="submit" class="button-2 signup w-button mt-4" style="display:block;margin:auto">
            {{ __('Register') }}
        </button>
      </form>
      <div class="w-form-done">
        <div>Thank you! Your submission has been received!</div>
      </div>
      <div class="w-form-fail">
        <div>Oops! Something went wrong while submitting the form.</div>
      </div>
    </div>
  </div>
</div>
</div>
</div>
@endsection
