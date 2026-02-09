@extends('layouts.main.index1')

@section('title')
    FAQ's
@endsection
@section('content')
    </section >

          <section class=" mb-md-2 mb-lg-3 mb-xl-4">

        <div class="bg-primary">
          <div class="container">

              <div class="col-lg-8 pb- pb-lg-0 mb-4 mb-lg-0 pt-5">
            <h2 class="display-4 pb- pb-lg- text-white">Resources</h2>
                    </div>

          </div>
            <!-- Inline list -->
            <div class="navbar navbar-expand-lg  pb-3">
              <div class="container">

                <button type="button" class="navbar-toggler btn btn-secondary w-100 bg-secondary" data-bs-toggle="collapse" data-bs-target="#navbarCollapse1">
                Menu
                </button>

                <nav class="collapse navbar-collapse bg-primary border-0 " id="navbarCollapse1">
                  <ul class="navbar-nav me-auto">


                    <li class="nav-item ">
                      <a href="{{url("/downloads")}}" class="nav-link text-white">Downloads</a>
                    </li>
                      <li class="nav-item active">
                          <a href="{{url("/faq")}}" class="nav-link">FAQ</a>
                      </li>
                  </ul>

                </nav>

              </div>
            </div>
        </div>
        </section>
    <section class="container pt-1 pb-2">
      @if (count($faqs)>0)
      <div class="accordion" id="accordionDefault">
        <?php $i=1;?>
        @foreach ($faqs as $f)
        <!-- Faq -->
        <div class="accordion-item">
          <h3 class="accordion-header" id="headingOne{{$i}}">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne{{$i}}" aria-expanded="true" aria-controls="collapseOne{{$i}}">{{$f->title}}</button>
          </h3>
          <div class="accordion-collapse collapse" id="collapseOne{{$i}}" aria-labelledby="headingOne{{$i}}" data-bs-parent="#accordionDefault">
            <div class="accordion-body fs-sm">
              {{$f->content}}
            </div>
          </div>
        </div>
        <?php $i++;?>
        @endforeach
      </div>
      @else
      <div class="me-xl-5 m-2">
          <h3 class="pt-">No FAQ post</h3>
          <br>
      </div>
      @endif
    </section>

@endsection
