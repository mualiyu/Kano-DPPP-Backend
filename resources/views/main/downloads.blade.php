@extends('layouts.main.index1')

@section('title')
    Downlooads
@endsection
@section('content')
    </section >

          <section class="py- mt- pt- mb-md-2 mb-lg-3 mb-xl-4">

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


                    <li class="nav-item active">
                      <a href="{{url("/downloads")}}" class="nav-link ">Downloads</a>
                    </li>
                      <li class="nav-item">
                          <a href="{{url("/faq")}}" class="nav-link text-white">FAQ's</a>
                      </li>

                  </ul>

                </nav>

              </div>
            </div>

        </div>

        </section>
      <section class="container pt-1 pb-5">
        @if (count($downs)>0)
            @foreach ($downs as $d)
            <div class="card card-body border-0 bg-secondary mt-1">
              <div class="d-flex align-items-center pb-1 mb-1">
                
                <div class="ps-3">
                  <h4 class="mb-0">{{$d->title}}</h4>
                  <span class="fs-sm text-muted">{{date('d M Y', strtotime($d->created_at))}}</span>
                </div>
              </div>
              <p class="mx-3">{{$d->description}}</p>
              <p class="mx-4 mb-0"><a target="blank" href="{{route('main_down_doc', ['download'=>$d->id])}}" style="font-size: 20px;" class="fw-bold text-decoration-none">Download</a></p>
            </div>
            @endforeach
          {{$downs->links()}}
        @else
        <div class="me-xl-5 m-2">
        <h3 class="pt-">No download post. Come back later</h3>
        <br>
        </div>
        @endif


      </section>

@endsection
