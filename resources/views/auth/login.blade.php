@extends('layouts.app')

@section('content')

<div class="login-sec login-light">
  <div class="w-container">
    <div>
      <div class="w-row">
        <div class="sign-in-col col-change w-col w-col-12">
          <div class="login-div bg-color blue-height">
            <h1 class="heading-5">Welcome Back!</h1>
            <div class="w-form">
              <form class="px-5" id="email-form" name="email-form" data-name="Email Form"  action="{{ route('login') }}" method="post">
                  @csrf
                <input type="email" class="form-field w-input" maxlength="256" name="email" data-name="Email 4" placeholder="Email" id="email-4" required="">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <input type="password" class="form-field w-input" maxlength="256" name="password" data-name="Email 2" placeholder="Password" id="email-2" required="">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                {{-- <div class="text-block _1">Forgot your Password?</div> --}}
                <input style="margin:auto;display:block;" type="submit" value="Sign in" data-wait="Please wait..." class="button-2 sign-in-button white w-button mt-4"></form>
              <div class="w-form-done">
                <div>Thank you! Your submission has been received!</div>
              </div>
              <div class="w-form-fail">
                <div>Oops! Something went wrong while submitting the form.</div>
              </div>
            </div>
          </div>
        </div>
        {{-- <div class="sign-up-col orange w-col w-col-6">
          <div class="login-div _2 height">
            <h1 class="heading-5 heading-2">Create Account</h1><a href="#" class="link-block-5 w-inline-block"></a><a href="#" class="link-block-6 w-inline-block"></a><a href="#" class="link-block-7 w-inline-block"></a>
            <div class="text-block">Or Use your email for registration.</div>
            <div class="w-form">
              <form id="email-form2" name="email-form" data-name="Email Form">
                <input type="text" class="form-field w-input" maxlength="256" name="name" data-name="Name" placeholder="Name" id="name2" required="">
                <input type="email" class="form-field w-input" maxlength="256" name="email" data-name="Email" placeholder="Email" id="email2" required="">
                <input type="password" class="form-field w-input" maxlength="256" name="Password" data-name="Password" placeholder="Password" id="Password2" required="">
                <input type="submit" value="Sign Up" data-wait="Please wait..." class="button-2 signup w-button"></form>
              <div class="w-form-done">
                <div>Thank you! Your submission has been received!</div>
              </div>
            </div>
          </div>
        </div> --}}

      </div>
    </div>
  </div>
</div>
@endsection
