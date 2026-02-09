@extends('layouts.main.index1')

@section('title')
    Work With Us
@endsection

@section('content')
    <section class="container mt-3 mb-xl-0 mb-xxl-0">
        <div class="row pt-">

          <div class="col-lg-6 d-flex flex-column mb-4 mb-lg-0 pb-sm-3 pb-lg-0">
              <h1 class="display-2 text-uppercase fw-bold mt-auto mb-2"><span class=' text-primary'>Work</span>   <span class='fw-normal'>With</span> <span class=' text-primary'>US</span><span class="d-none text-primary d-md-inline-block align-middle ms-4" style="width: 120px; height: 2px; background-color: currentColor;"></span></h1>
            {{-- <p class="fs-6 text-dark pb-md-2 mb-lg-5">Opportunities within the AMP Financed Projects</p> --}}
          </div>
          <!-- Services (grid of cards)-->
          <div class="col-lg-6" >
            <img src="{{asset('assets/img/images/AMP-129.jpg')}}" class="figure-img" alt="...">
          </div>
        </div>
      </section>

      <section class="container pt-5" >
        <h5>There are currently no open opportunities. Sign up below to get notified on future opportunities. </h5>
    </section>
    {{-- @if (count($tenders)>0)
    <div class="container pt-1 pb-lg-1 pb-md-1 pb-1 my-5">
      <h3>Available Tenders below</h3>
        <div class="masonry-grid mb-1 mb-md-2 pb-lg-1 rounded-0" data-columns="3">
            <!-- Blog item-->
            @foreach ($tenders as $tender)
            <article class="masonry-grid-item rounded-0">
                <div class="card border-0 bg-secondary rounded-0">

                    <div class="card-body pb-4 rounded-0">
                        <div class="d-flex align-items-center mb-4 mt-n1">
                          <span class="fs-sm text-muted">{{date('M d, Y', strtotime($tender->open_date))}} - {{date('M d, Y', strtotime($tender->close_date))}}</span>
                          <span class="fs-xs opacity-20 mx-3">|</span>
                          @if ($tender->status == 'Open')
                              <span class="badge text-white fs-xs border bg-primary">Open</span>
                          @else
                              <span class=" badge text-nav fs-xs border bg-warning">{{$tender->status}}</span>
                          @endif
                        </div>
                        <h3 class="h5 text-dark card-title">
                          <a href="{{route('app_job_info', ['id'=>$tender->id])}}">
                            {{$tender->name}}
                          </a>
                        </h3>
                        @if (count($tender->job_contents)>0)
                        <?php
                          $pieces = explode(" ", $tender->job_contents[0]->content);
                          $first_part = implode(" ", array_splice($pieces, 0, 10));
                        ?>
                        <p class="card-text">{{$first_part}}....</p>
                        @else
                        <p class="card-text"><br><br></p>
                        @endif
                    </div>
                </div>
            </article>
            @endforeach
        </div>
        <div class="pt-4 d-flex align-items-end" style="float: right;">
            {{$tenders->links()}}
        </div>
      </div>
    @else
    <section class="container pt-5" >
        <h5>There are currently no open opportunities. Sign up below to get notified on future opportunities. </h5>
    </section>
    @endif --}}

    <section class="container pt-1" >
        <div class="card border-0  position-relative py-lg-4 py-xl-5">
            <div class="card-body position-relative zindex-2 py-5">
                    <h2 class="h3 card-title text-center pb-4">Sign up form</h2>
                    @include('layouts.flash')
                            <div class="row g-4">
                                <div class="col-sm-12 text-center d-sm-flex">
                                  <div class="form-check form-check-inline mb-0">
                                    <input class="form-check-input" type="radio" name="optt" value="company" checked="" id="female">
                                    <label class="form-check-label" for="female">Company</label>
                                  </div>
                                  <div class="form-check form-check-inline mb-0">
                                    <input class="form-check-input" type="radio" name="optt" value="individual" id="other">
                                    <label class="form-check-label" for="other">Individual</label>
                                  </div>
                                </div>
                                {{-- <div class="col-sm-6">
                                    <label class="form-label fs-base" for="name">Name</label>
                                    <input class="form-control form-control-lg" type="text" placeholder="Your name" required id="name">
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label fs-base" for="company">Company</label>
                                    <input class="form-control form-control-lg" type="text" placeholder="Your company name" id="company">
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label fs-base" for="email">Email</label>
                                    <input class="form-control form-control-lg" type="email" placeholder="Email address" required id="email">
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label fs-base" for="phone">Phone</label>
                                    <input class="form-control form-control-lg" type="text" placeholder="Phone number" id="phone">
                                </div> --}}

                                {{-- <div class="col-sm-12 text-center pt-4">
                                    <button class="btn btn-lg btn-primary" type="submit">Submit</button>
                                </div> --}}

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
                                <div class="row row-cols-1 row-cols-sm-2">
                                      <div class="col mb-4">
                                        <input class="form-control form-control-lg" name="phone" type="number" placeholder="Company Tel" required>
                                      </div>
                                      <div class="col mb-4">
                                        <input class="form-control form-control-lg" name="username" type="text" placeholder="UserName" required>
                                      </div>
                                    {{-- <div class="col mb-1">
                                      <input class="form-control form-control-lg" name="cac_number" type="number" placeholder="CAC Number" required>
                                    </div> --}}
                                  </div>
                                  <div class="col-sm-12 text-center pt-2">
                                      <button class="btn btn-lg btn-primary mb-1" type="submit">Sign up</button>
                                  </div>
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
                                  <div class="col-sm-12 text-center pt-2">
                                      <button class="btn btn-lg btn-primary mb-5" type="submit">Sign up</button>
                                  </div>
                                </form>
                            </div>
                    </div>
                </div>
            </section>

@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
$(document).ready(function() {

    $("input[name$='optt']").click(function() {
        var test = $(this).val();
        // console.log(test);
        $(".lll").hide();
        $("." + test).show();
    });
});
</script>
@endsection
