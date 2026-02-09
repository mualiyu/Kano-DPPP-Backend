@extends('layouts.main.index1')

@section('title')
    Videos
@endsection
@section('content')
<main>
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

                            <li class="nav-item ">
                                <a href="{{url("/press-release")}}" class="nav-link text-white">Press Release</a>
                            </li>
                            <li class="nav-item ">
                                <a href= "{{url("/gallery")}}" class="nav-link text-white">Gallery</a>
                            </li>
                            <li class="nav-item active">
                                <a href="{{url("/videos")}}" class="nav-link ">Videos</a>
                            </li>

                        </ul>

                    </nav>

                </div>
            </div>
        </div>
    </section>

    <section class="container pt-5 pb-5 col-lg-9 col-xl-8">
        @if (count($videos)>0)
              <?php $i=1;?>
              @foreach ($videos as $v)
                <div class="pt-3 pb-3">
                    <h4 >{{$v->title}}</h4>
                    <div class="d-flex align-items-center mb-4 mt-n1"><span class="fs-sm text-muted">{{date('M d, Y', strtotime($v->created_at))}}</span></div>
                    <p >{{$v->description}}</p>
                    <iframe class="pb-5" width="100%" height="515" src="{{$v->link}}"  allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    <hr>
                </div>
                <?php $i++;?>
              @endforeach
          @else
          <div class="me-xl-5 m-2">
              <h3 class="pt-">No video post. Come back later</h3>
              <br>
          </div>
          @endif
    </section>

      <!-- Page content-->
{{--      <div class="container pt-0 pb-lg-5 pb-md-4 pb-2 my-5">--}}

{{--        <div class="masonry-grid mb-2 mb-md-4 pb-lg-3" data-columns="3">--}}

{{--          <!-- Blog item-->--}}
{{--          <article class="masonry-grid-item">--}}
{{--            <div class="card border-0 "><a href="blog-single-v2.html"><img class="card-img-top rounded-0" src="assets/img/blog/grid/01.jpg" alt="Post image"></a>--}}
{{--              <div class="card-body pb-4">--}}
{{--                <div class="d-flex align-items-center mb-2 mt-n1 rounded-0"><span class="fs-sm text-muted">12 hours ago</span></div>--}}
{{--                <h5 class="h4 card-title"><a href="blog-single-v2.html">Top books for inspiration</a></h5>--}}

{{--              </div>--}}

{{--            </div>--}}
{{--          </article>--}}



{{--          <!-- Blog item-->--}}
{{--          <article class="masonry-grid-item">--}}
{{--            <div class="card border-0 "><a href="blog-single-v1.html"><img class="card-img-top rounded-0" src="assets/img/blog/grid/02.jpg" alt="Post image"></a>--}}
{{--              <div class="card-body pb-4">--}}
{{--                <div class="d-flex align-items-center mb-2 mt-n1 rounded-0"><span class="fs-sm text-muted">January 9, 2022</span></div>--}}
{{--                <h5 class="h5 card-title1"><a href="blog-single-v1.html">Ways to travel in 2022</a></h5>--}}

{{--              </div>--}}

{{--            </div>--}}
{{--          </article>--}}
{{--          <!-- Blog item-->--}}
{{--          <article class="masonry-grid-item">--}}
{{--            <div class="card border-0 rounded-0 "><a href="blog-single-v2.html"><img class="card-img-top rounded-0" src="assets/img/blog/grid/03.jpg" alt="Post image"></a>--}}
{{--              <div class="card-body pb-4 rounded-0">--}}
{{--                <div class="d-flex align-items-center mb-2 mt-n1"><span class="fs-sm text-muted">October 10, 2022</span></div>--}}
{{--                <h5 class="h4 card-title"><a href="blog-single-v2.html">Inspiration in quarantine</a></h5>--}}

{{--              </div>--}}
{{--            </div>--}}
{{--          </article>--}}

{{--        </div>--}}
{{--        <!-- Pagination-->--}}
{{--        <div class="row gy-3 align-items-center mb-md-2 mb-xl-4">--}}


{{--          <div class="order-md-3 order-2">--}}
{{--            <nav aria-label="Page navigation">--}}
{{--              <ul class="pagination pagination-sm justify-content-end">--}}
{{--                <li class="page-item active" aria-current="page"><span class="page-link">1<span class="visually-hidden">(current)</span></span></li>--}}
{{--                <li class="page-item"><a class="page-link" href="#">2</a></li>--}}
{{--                <li class="page-item"><a class="page-link" href="#">3</a></li>--}}
{{--                <li class="page-item"><a class="page-link" href="#">4</a></li>--}}
{{--                <li class="page-item"><a class="page-link" href="#">5</a></li>--}}
{{--              </ul>--}}
{{--            </nav>--}}
{{--          </div>--}}
{{--        </div>--}}
{{--      </div>--}}
    </main>

@endsection
