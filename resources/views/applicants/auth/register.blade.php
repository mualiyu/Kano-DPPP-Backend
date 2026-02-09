@extends('layouts.auth')

@section('content')
   <!-- Page wrapper-->
    <main class="page-wrapper">
      <!-- Page content-->
      <div class="d-lg-flex position-relative h-100">
        <!-- Home button--><a class="text-nav btn btn-icon bg-light border rounded-circle position-absolute top-0 end-0 p-0 mt-3 me-3 mt-sm-4 me-sm-4" href="{{url('/')}}" data-bs-toggle="tooltip" data-bs-placement="left" title="Back to home"><i class="ai-home"></i></a>
        <!-- Sign up form-->
        <div class="d-flex flex-column align-items-center w-lg-50 h-100 px-3 px-lg-5 pt-5">

          <div class="w-100 mt-auto" style="max-width: 526px;">
              <img src="{{ asset('assets/img/images/kano-logo.png') }}" width="72" alt="Kano State Government">
            <h3 class="pt-4 text-primary">Register as a Vendor</h3>
            <p class="pb-2 mb-1 mb-lg-4">Already registered?&nbsp;&nbsp;<a href='{{route('app_show_login')}}'>Sign in here</a>.</p>
            @include('layouts.flash')
            <div class="row my-2 align-items-center pb-2 mb-1 mb-lg-3" style="text-align: center;">
                <div class="col-12 col-sm-12 col-md-12 d-sm-flex align-items-center">
                  <div class="form-check form-check-inline mb-0">
                    <input class="form-check-input" type="radio" name="optt" value="company" checked="" id="female">
                    <label class="form-check-label" for="female">Company</label>
                  </div>
                  <div class="form-check form-check-inline mb-0">
                    <input class="form-check-input" type="radio" name="optt" value="individual" id="other">
                    <label class="form-check-label" for="other">Individual</label>
                  </div>
                </div>
            </div>
            <form class="needs-validation company lll" method="POST" action="{{route('app_register_company')}}">
                @csrf
                <div class="row row-cols-1 row-cols-sm-2">
                <div class="col mb-4">
                  <input class="form-control form-control-lg" name="name" type="text" placeholder="Company name" required>
                </div>
                <div class="col mb-4">
                  <input class="form-control form-control-lg" name="email" type="email" placeholder="Company Email address" required>
                </div>
              </div>
              <div class="row row-cols-1">
                <div class="col-6 mb-4">
                  <input class="form-control form-control-lg" name="phone" type="number" placeholder="Company Tel" required>
                </div>
                <div class="col-6 mb-4">
                  <input class="form-control form-control-lg" name="username" type="text" placeholder="UserName" required>
                </div>
              </div>
              
              <div class="row row-cols-1 pb-5">
                <div class="col-12 mb-4">
                  <input class="form-control form-control-lg" name="cac_number" type="number" placeholder="Company Registration Number" required>
                </div>
              </div>
              {{-- <div class="row row-cols-1">
                <div class="col-12 mb-4">
                    <select name="b_category" class="form-control form-control-lg" required>
                        <option selected disabled >Select Business Category</option>
                        @foreach ($b_categories as $b)
                            <option value="{{$b->id}}">{{$b->name}}</option>
                        @endforeach
                    </select>
                </div>
              </div> --}}
{{--              <div class="pb-4">--}}
{{--                <div class="form-check my-2">--}}
{{--                  <input class="form-check-input" type="checkbox" id="terms">--}}
{{--                  <label class="form-check-label ms-1" for="terms">I agree to <a href="#">Terms &amp; Conditions</a></label>--}}
{{--                </div>--}}
{{--              </div>--}}
              <button class="btn btn-lg btn-primary w-100 mb-5" type="submit">Register</button>
            </form>

            {{-- individual --}}
            <form class="needs-validation individual lll" style="display: none;" method="POST" action="{{route('app_register_individual')}}">
                @csrf
                <div class="row row-cols-1">
                    <div class="col-12 mb-4">
                      <input class="form-control form-control-lg" name="name" type="text" placeholder="Full name" required>
                    </div>
                </div>
                <div class="row row-cols-1">
                  <div class="col-12 mb-4">
                  <input class="form-control form-control-lg" name="username" type="text" placeholder="UserName" required>
                </div>
                </div>
                <div class="row row-cols-1 row-cols-sm-2">
                  <div class="col mb-4">
                    <input class="form-control form-control-lg" name="email" type="email" placeholder="Email address" required>
                  </div>
                <div class="col mb-4 pb-5">
                  <input class="form-control form-control-lg" name="phone" type="number" placeholder="Phone" required>
                </div>
              </div>
              {{-- <div class="row row-cols-1">
                <div class="col-12 mb-4">
                    <select name="b_category" class="form-control form-control-lg" required>
                        <option selected disabled >Select Business Category</option>
                        @foreach ($b_categories as $b)
                            <option value="{{$b->id}}">{{$b->name}}</option>
                        @endforeach
                    </select>
                </div>
              </div> --}}
{{--              <div class="pb-4">--}}
{{--                <div class="form-check my-2">--}}
{{--                  <input class="form-check-input" type="checkbox" id="terms">--}}
{{--                  <label class="form-check-label ms-1" for="terms">I agree to <a href="#">Terms &amp; Conditions</a></label>--}}
{{--                </div>--}}
{{--              </div>--}}
              <button class="btn btn-lg btn-primary w-100 mb-5" type="submit">Register</button>
            </form>

          </div>
        </div>
        <!-- Cover image-->
        <div class="w-50 bg-size-cover bg-repeat-0 bg-position-center" style="background-image: url({{asset('assets/img/images/login.png')}});"></div>
      </div>
    </main>
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
$(document).ready(function() {

    $("input[name$='optt']").click(function() {
        var test = $(this).val();

        $(".lll").hide();
        $("." + test).show();
    });
});
</script>
@endsection
