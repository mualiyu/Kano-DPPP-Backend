@extends('layouts.main.index1')

@section('title')
    Gallery
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

                        <li class="nav-item ">
                            <a href="{{url("/press-release")}}" class="nav-link text-white">Press Release</a>
                        </li>
                        <li class="nav-item active">
                            <a href= "{{url("/gallery")}}" class="nav-link">Gallery</a>
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




    <div class="container pt-1 pb-lg-5 pb-md-4 pb-2 my-5">
            @if (count($galleries)>0)
        <div class="masonry-grid mb-2 mb-md-4 pb-lg-3 rounded-0" data-columns="3">
            <!-- Blog item-->
            @foreach ($galleries as $g)
            <article class="masonry-grid-item rounded-0">
                <div class="card border-0 bg-secondary rounded-0"><a href="{{route('main_single_gallery', ['gallery'=>$g->id])}}"><img class="card-img-top rounded-0" src="/storage/gallery/{{$g->images[0]->image}}" alt="Post image"></a>
                    <div class="card-body pb-4 rounded-0">
                        <div class="d-flex align-items-center mb-4 mt-n1"><span class="fs-sm text-muted">{{$g->created_at}}</span><span class="fs-xs opacity-20 mx-3">|</span><a class="badge text-white fs-xs border bg-primary" >Gallery</a></div>
                        <h3 class="h5 text-dark card-title"><a href="{{route('main_single_gallery', ['gallery'=>$g->id])}}">{{$g->name}}</a></h3>
                        <p class="card-text">{{$g->description}}</p>
                    </div>

                </div>
            </article>
            @endforeach

        </div>
            @else
                <div class="me-xl-5 m-2">
                    <h3 class="pt-">No Gallery Found. Come back later</h3>
                    <br>
                </div>
            @endif
        {{-- <!-- Pagination-->
        <div class="row gy-3 align-items-center mb-md-2 mb-xl-4">
            <div class="col col-md-4 col-6 order-md-1 order-1">
                <div class="d-flex align-items-center"><span class="text-muted fs-sm">Show</span>
                    <select class="form-select form-select-flush w-auto">
                        <option value="6">6</option>
                        <option value="9" selected>9</option>
                        <option value="12">12</option>
                        <option value="24">24</option>
                    </select>
                </div>
            </div>
            <div class="col col-md-4 col-12 order-md-2 order-3 text-center">
                <button class="btn btn-primary w-md-auto w-100" type="button">Load more posts</button>
            </div>
            <div class="col col-md-4 col-6 order-md-3 order-2">
                <nav aria-label="Page navigation">
                    <ul class="pagination pagination-sm justify-content-end">
                        <li class="page-item active" aria-current="page"><span class="page-link">1<span class="visually-hidden">(current)</span></span></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">4</a></li>
                        <li class="page-item"><a class="page-link" href="#">5</a></li>
                    </ul>
                </nav>
            </div>
        </div> --}}
    </div>
    </main>

@endsection
