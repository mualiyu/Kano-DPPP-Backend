@extends('layouts.main.index1')

@section('title')
    Press Realese
@endsection
@section('content')



    <section class=" mb-md-2 mb-lg-3 mb-xl-4">

        <div class="bg-primary">
            <div class="container">

                <div class="col-lg-8 pb- pb-lg-0 mb-4 mb-lg-0 pt-5">
                    <h2 class="display-4 pb- pb-lg- text-white">News Center</h2>
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
                                <a href="{{url("/news")}}" class="nav-link text-white">News</a>
                            </li>

                            <li class="nav-item active ">
                                <a href="{{url("/press-release")}}" class="nav-link ">Press Release</a>
                            </li>
                            <li class="nav-item ">
                                <a href= "{{url("/gallery")}}" class="nav-link text-white">Gallery</a>
                            </li>
                            <li class="nav-item ">
                                <a href="{{url("/videos")}}" class="nav-link text-white">Videos</a>
                            </li>

                        </ul>

                    </nav>

                </div>
            </div>





        </div>



    </section>
    <!-- Page header-->
    <section class="container pt-5 pb-5">
        @if (count($press)>0)

        <div class="me-xl-5 m-2">
          @foreach ($press as $n)
          <div class="row">
            <div class="col-lg-8">

        <h5 class="pt-">{{$n->title}}</h5>
        <div class="d-flex align-items-center mb-4 mt-n1">
          <span class="fs-sm text-muted">{{date('M d, Y', strtotime($n->created_at))}}</span>
          <span class="fs-xs opacity-20 mx-3">|</span>
          <span class="badge text-white bg-primary fs-xs border" >Pres Release</span>
        </div>
        <p> {{$n->description}}</p>
        <a class="btn btn-lg btn-link px-0" href="{{route('main_single_press', ['press'=>$n->id])}}">Learn More<i class="ai-arrow-right ms-2"></i></a>

        </div>
        @if (!$n->image==Null)
        <img src="/storage/press/{{$n->image}}" class="col-lg-4 bg-repeat-0 bg-size-cover bg-position-center rounded-0" style=" max-height: 14rem">
        @endif

        </div>

        <br>
          @endforeach
        <hr>

        </div>

        <div class="pt-4 d-flex align-items-end">
            {{$press->links()}}
        </div>

        @else
        <div class="me-xl-5 m-2">
            <h3 class="pt-">No press release post. Come back later</h3>
            <br>
        </div>
        @endif
    </section>
@endsection
