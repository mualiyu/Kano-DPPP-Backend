@extends('layouts.auth')

@section('content')
    <!-- Page wrapper-->
    <main class="page-wrapper">
      <!-- Page content-->
      <div class="d-lg-flex position-relative h-100">
        <!-- Home button-->
        <a class="text-nav btn btn-icon bg-light border rounded-circle position-absolute top-0 end-0 p-0 mt-3 me-3 mt-sm-4 me-sm-4" href="/" data-bs-toggle="tooltip" data-bs-placement="left" title="Back to home"><i class="ai-home"></i></a>
        <!-- Sign in form-->
        <div class="d-fleqx flex-column align-items-center w-lg-50 h-100 px-3 px-lg-5 pt-5">

          @include('layouts.flash')
          <div class="w-100 mt-auto pt-5" style="max-width: 526px;">
              <img src="{{ asset('assets/img/images/kano-logo.png') }}" width="72" alt="Kano State Government">
            <h3 class="pt-4 text-primary">Media Admin Sign In</h3>
            {{-- <p class="pb-3 mb-3 mb-lg-4 text-dark">Login below or <a href='{{route('app_show_register')}}'>register</a> with us for the future opportunities with the Africa Minigrids Program</p> --}}
            <form class="needs-validation" novalidate method="POST" action="{{ route('m_login') }}">
              @csrf
              <div class="pb-3 mb-3">
                <div class="position-relative"><i class="ai-mail fs-lg position-absolute top-50 start-0 translate-middle-y ms-3"></i>
                  <input class="form-control form-control-lg ps-5" name="email" type="text" placeholder="Email address/Phone" value="{{ old('user') }}" autocomplete="email" required>
                </div>
              </div>
              @error('user')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
              <div class="mb-4">
                <div class="position-relative"><i class="ai-lock-closed fs-lg position-absolute top-50 start-0 translate-middle-y ms-3"></i>
                  <div class="password-toggle">
                    <input class="form-control form-control-lg ps-5" name="password" type="password" placeholder="Password" required>
                    <label class="password-toggle-btn" aria-label="Show/hide password">
                      <input class="password-toggle-check" type="checkbox"><span class="password-toggle-indicator"></span>
                    </label>
                  </div>
                </div>
              </div>
              @error('password')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
              <div class="d-flex flex-wrap align-items-center justify-content-between pb-4">

                <form-check class="my-1">
                  <input class="form-check-input" type="checkbox" name="remember" id="keep-signedin" {{ old('remember') ? 'checked' : '' }}>
                  <label class="form-check-label ms-1" for="keep-signedin">Keep me signed in</label>
                </form-check>
                <a class="fs-sm fw-semibold text-decoration-none my-1" href="{{route('m_show_forgot_pass')}}">Forgot password?</a>
              </div>
              <button class="btn btn-lg btn-primary  w-100 mb-4" type="submit">Sign in</button>

            </form>
          </div>
        </div>
        <!-- Cover image-->
        <div class="w-50 bg-size-cover bg-repeat-0 bg-position-center" style="background-image: url({{asset('assets/img/images/login.png')}});"></div>
      </div>
    </main>
@endsection
