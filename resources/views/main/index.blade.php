@extends('layouts.main.index')

@section('title')
    Home
@endsection
@section('content')
    <!-- Hero-->
      <section class="bg-primary dark-mode d-flex min-vh-100 position-relative overflow-hidden py-">
        <div class="container d-flex flex-column justify-content-center position-relative zindex-2 pt-sm-3 pt-md-4 pt-xl- pb-1 pb-sm-3 pb-lg-4 pb-xl-5">
          <div class="row flex-lg-nowrap align-items-center pb-1 pt-2 pt-lg-4 pt-xl-0 mt-lg-4 mt-xl-0">
            <div class="col-lg-7 order-lg-2 ms-lg-4 mb-2 mb-lg-0">
                <iframe class="" width="100%" height="455" src=" https://www.youtube.com/embed/SC9pCQG-2PQ?si=fIQadyQ2pMp1s7NO"  allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

                {{--              <div class="parallax order-lg-2 mx-auto" style="max-width: 740px;">--}}
{{--                <div class="parallax-layer" data-depth="0.05"><img src="{{asset('assets/img/images/hero.png')}}" ></div>--}}
{{--                <div class="parallax-layer" data-depth="-0.05"><img src="{{asset('assets/img/images/02.png')}}" style="animation: rotate-cw 100s linear infinite;" ></div>--}}

{{--              </div>--}}
            </div>
            <div class="col-lg-5 order-lg-1 text-center text-lg-start me-xl-5">

                <span class="badge bg-faded-warning text-warning fs-sm">For greater impact&nbsp; 🚀</span>
              <h1 class="display-4 py-3 my-2 mb-xl-3">Powering Rural Communities and Agricultural value Chains</h1>
            </div>
          </div>

        </div>
      </section>

    <section class="container py-5 mt-2 mt-sm-3 mt-md-4 pt-5">
       <div class="row align-items-lg-center">
            <!-- Accordion-->
            <div class="col-md-6 col-lg-5 pb-2 pb-lg-0 mb-4 mb-md-0">
                <div class="ps-md-3 ps-lg-0">
{{--                    <img class="d-block d-dark-mode-none mb-2 mb-lg-3" src="assets/img/portfolio/brands/champion-blue-dark.svg" alt="Champion"><img class="d-none d-dark-mode-block mb-2 mb-lg-3" src="assets/img/portfolio/brands/champion-blue-light.svg" alt="Champion">--}}
                    <h2 class="h3 display-4 text-primary">Supporting Local Energy Grids</h2>
                    <p class="fs-lg mb-5">The Africa Minigrids Program is supporting access to clean energy by increasing the financial viability, and promoting scaled-up commercial investment, in renewable energy minigrids in Africa, with a focus on cost-reduction levers and innovative business models.</p>
{{--                    <img class="mb-5" src="{{asset('assets/img/images/12.svg')}}"  >--}}
                    <a class="btn btn-sm btn-outline-dark rounded-pill" href="{{url("about-us")}}">Learn more</a>

                </div>
            </div>

            <div class="col-md-6 col-lg-7 col-xl-6 offset-xl-1 pt-3">
                <div class="ps-lg-4 ps-xl-0">
                    <iframe class="" width="100%" height="415" src="https://www.youtube.com/embed/5AvrfIN1HwE"  allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

                </div>
            </div>
        </div>
    </section>
    <section class="container py- my-lg-3 my-xl-4 my-xxl-5">
        <div class="row row-cols-3 row-cols-md-5 g-2 g-md-4 pb-2 ">
            <div class="col text-center mb-3"> <span class="fs-sm mx-auto  fw-bold text-dark">Implementing Partner:</span>
                <img
                  class="d-block d-dark-mode-none mx-auto pt-3"
                  src="{{ asset('assets/img/images/kano-logo.png') }}"
                  width="96"
                  alt="Kano State Government"
                >
            </div>
            <div class="col text-center mb-3"><span class="fs-sm text-center fw-bold text-dark">Supported by:</span>
                <img class="d-block mx-auto pt-3" src="{{asset('assets/img/images/1.svg')}}" width="80" ></div>
            <div class="col text-center mb-3"><span class="fs-sm text-center fw-bold text-dark">Led by:</span>
                <img class="d-block mx-auto pt-3" src="{{asset('assets/img/images/2.svg')}}" width="80" ></div>

            <div class="col text-center mb-3"><span class="fs-sm fw-bold fw-bold text-dark">In partnership with:</span>
                <img class="d-block pt-3 mx-auto text-center" src="{{asset('assets/img/images/3.png')}}" width="80" >
            </div>

            <div class="col mb-3"><span class="fs-sm fw-bold  text-dark"><br></span>
                <img class="d-block pt-3 mx-auto" src="{{asset('assets/img/images/afdb.png')}}" style="width: 180px;" >
            </div>
        </div>
    </section>



    <section class="container py-md-4 py-lg-2 mb-xl-3 mb-xxl-5 pt-">
        <div class="row pt-sm-2 pb-3">
            <div class="col-xl-6 text-primary">
                <p class=" display-6  pb-md-2 mb-lg-5  text-primary">AMP at a Glance</p>
            </div>


        </div>


        <div class="row ">
            <div class="col-4 mb-3 text-center">
                <div class="">
                <img class="" src="{{asset('assets/img/images/icons/6.png')}}" style="height: 50px;">
                </div>
                <h3 class="h4 mb-0 mb-sm-1 text-center">70,063</h3><span class="fs-sm fw-bold">Direct Beneficiaries</span>
            </div>
            <div class="col-4 mb-3 text-center">
                <img class="" src="{{asset('assets/img/images/icons/7.png')}}" style="height: 50px;">
                <h3 class="h4 mb-0 mb-sm-1 ">34,599</h3><span class="fs-sm fw-bold">Women Beneficiaries</span>
            </div>
            <div class="col-4 mb-2 mb-sm-3 text-center">
                <img class="" src="{{asset('assets/img/images/icons/8.png')}}" style="height: 50px;">
                <h3 class="h4 mb-0 mb-sm-1">74.2 <span class="fs-lg">ktCO2e</span> </h3><span class="fs-sm fw-bold">Lifetime Global Environmental Benefit</span>
            </div>
        </div>

    </section>




      <section class="container pt-5">

        <div class="">

        <h3 class="text-primary display-3">Powering the Rural Agriculture Value Chains</h3>
        <p class="fs-lg pb-3 pb-lg-4 mb-3">The Africa Minigrids Program (AMP) is designed as an enabler project of the REA’s Energising Agriculture Programme (EAP) which aims to advance one of REA’s strategic priorities of focusing on the unserved and underserved to increase economic opportunities through agriculture and productive sectors in rural communities across the country</p><a class="btn btn-lg btn-link px-0" href="{{url('/energising-agriculture-programme')}}">Learn More<i class="ai-arrow-right ms-2"></i></a>


        </div>
        <div class="container-start pe-0 pt-4">
            <div class="row ">

                <div class="col-md-4 col-sm-2 mb-3">
                    <div class="card rounded-0" >
                        <img class="card-img-top rounded-0" src="{{asset('assets/img/images/farmer.jpeg')}}" alt="Card image ">
                        <div class="card-img-overlay">
                            <h4 class="card-title bg-primary bg-opacity-75 text-white col-1">1.</h4>
                            <h5 class="card-title bg-primary text-white bg-opacity-75">Increase productivity of farmers</h5>

                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-sm-2 mb-3">
                    <div class="card rounded-0" >
                        <img class="card-img-top rounded-0" src="{{asset('assets/img/images/cost.jpeg')}}" alt="Card image">
                        <div class="card-img-overlay">
                            <h4 class="card-title bg-primary text-white bg-opacity-75 col-1">2.</h4>
                            <h5 class="card-title bg-primary text-white bg-opacity-75">Lower cost and improve efficiency </h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-2 mb-3">
                    <div class="card" >
                        <img class="card-img-top rounded-0" src="{{asset('assets/img/images/produce.jpeg')}}" alt="Card image">
                        <div class="card-img-overlay rounded-0">
                            <h4 class="card-title bg-primary bg-opacity-75 text-white col-1">3.</h4>
                            <h5 class="card-title bg-primary text-white bg-opacity-75">Improve the Value of agric products</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-2 mb-3">
                    <div class="card" >
                        <img class="card-img-top rounded-0" src="{{asset('assets/img/images/cold-storage.jpeg')}}" >
                        <div class="card-img-overlay rounded-0">
                            <h4 class="card-title bg-primary bg-opacity-75 text-white col-1">4.</h4>
                            <h5 class="card-title bg-primary text-white bg-opacity-75">Reduction of losses through cold storage</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-2 mb-3">
                    <div class="card rounded-0" >
                        <img class="card-img-top rounded-0" src="{{asset('assets/img/images/AdobeStock_552514375.jpeg')}}" >
                        <div class="card-img-overlay">
                            <h4 class="card-title bg-primary bg-opacity-75 text-white col-1">5.</h4>
                            <h5 class="card-title bg-primary text-white bg-opacity-75">Diversification of end-user products</h5>
                        </div>
                    </div>
                </div>
            </div>




        </div>
      </section>

    <section class=" bg-primary  mt-lg-3 mt-xl-4 mt-xxl-5">
        <div class="rounded-0 overflow-hidden mt-2 mt-sm-4 mt-lg-5 container">
            <div class="row position-relative zindex-2 align-items-center">
                <div class="col-md-6 col-lg-6 offset-lg-">
                    <div class="text-center text-md-start py-5 px-4 px-sm-5 pe-md-0 ps-lg-4 ps-xl-5">
                        <div class="d-flex align-items-center justify-content-center justify-content-md-start mb-2"><span class="bg-white opacity-70 me-2 d-none d-md-block" style="width: 40px; height: 1px; margin-top: -1px;"></span><span class="fs-xs fw-semibold text-white opacity-70 text-uppercase"></span></div>
                        <h2 class=" display-5 text-white pb-2 pb-sm-3">Transforming Rural Energy Market</h2>
                    </div>
                </div>
                <div class="col-md-6 ">
                    <iframe class="pt-5 pb-5"  height="455" src="https://www.youtube.com/embed/C7mLSus6qlw"  allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        </div>
        </div>
    </section>




      <section class="container pt-5">

        <div class="me-xl-5 m-2">

        <h3 class="text-primary display-3">Latest Updates</h3>
        <hr>

        {{-- News --}}
        @if ($news)
            <h5 class="pt-5">{{$news->title}}</h5>
            <div class="d-flex align-items-center mb-4 mt-n1"><span class="fs-sm text-muted">{{date('M d, Y', strtotime($news->created_at))}}</span><span class="fs-xs opacity-20 mx-3">|</span><a class="badge text-white bg-primary fs-xs border" href="#">News</a></div>
            <p>{{$news->description}}</p>
            <a class="btn btn-lg btn-link px-0" href="{{route('main_single_news', ['news'=>$news->id])}}">Learn More<i class="ai-arrow-right ms-2"></i></a>
            <hr>
        @endif

        {{-- Press Release --}}
        @if ($press)
            <h5 class="pt-5">{{$press->title}}</h5>
            <div class="d-flex align-items-center mb-4 mt-n1"><span class="fs-sm text-muted">{{date('M d, Y', strtotime($press->created_at))}}</span><span class="fs-xs opacity-20 mx-3">|</span><a class="badge text-white bg-primary fs-xs border">Press Release</a></div>
            <p>{{$press->description}}</p>
            <a class="btn btn-lg btn-link px-0" href="{{route('main_single_press', ['press'=>$press->id])}}">Learn More<i class="ai-arrow-right ms-2"></i></a>
            <hr>
        @endif

        {{--
        @if ($down)
            <h5 class="pt-5">{{$down->title}}</h5>
            <div class="d-flex align-items-center mb-4 mt-n1"><span class="fs-sm text-muted">{{date('M d, Y', strtotime($down->created_at))}}</span><span class="fs-xs opacity-20 mx-3">|</span><a class="badge text-white bg-primary fs-xs border" >Resources</a></div>
            <p>{{$down->description}}</p>
            <a class="btn btn-lg btn-link px-0" href="{{route('main_down_doc', ['download'=>$down->id])}}">Download<i class="ai-arrow-right ms-2"></i></a>
            <hr>
        @endif

        @if ($vid)
            <h5 class="pt-5">{{$vid->title}}</h5>
            <div class="d-flex align-items-center mb-4 mt-n1"><span class="fs-sm text-muted">{{date('M d, Y', strtotime($down->created_at))}}</span><span class="fs-xs opacity-20 mx-3">|</span><a class="badge text-white bg-primary fs-xs border" >Video</a></div>
            <p>{{$vid->description}}</p>
            <a class="btn btn-lg btn-link px-0" href="{{route('main_videos')}}">View More<i class="ai-arrow-right ms-2"></i></a>
            <hr>
        @endif

        @if ($g)
            <h5 class="pt-5">{{$g->name}}</h5>
            <div class="d-flex align-items-center mb-4 mt-n1"><span class="fs-sm text-muted">{{date('M d, Y', strtotime($g->created_at))}}</span><span class="fs-xs opacity-20 mx-3">|</span><a class="badge text-white bg-primary fs-xs border" href="#">Gallery</a></div>
            <p>{{$g->description}}</p>
            <a class="btn btn-lg btn-link px-0" href="{{route('main_single_gallery', ['gallery'=>$g->id])}}">View<i class="ai-arrow-right ms-2"></i></a>
            <hr>
        @endif
        --}}
        </div>
      </section>


    <section class="container pt-5 mt-lg-3 mt-xl-4 mt-xxl-5">
        <div class="bg-primary rounded-0 overflow-hidden mt-2 mt-sm-4 mt-lg-5"><img class="position-absolute top-50 start-0 translate-middle-y d-none d-md-block" src="{{asset('assets/img/images/AMP-grid-overlay-1-1.png')}}" width="186">
            <div class="row position-relative zindex-2 align-items-center">
                <div class="col-md-6 col-lg-5 offset-lg-1">
                    <div class="text-center text-md-start py-5 px-4 px-sm-5 pe-md-0 ps-lg-4 ps-xl-5">
                        <div class="d-flex align-items-center justify-content-center justify-content-md-start mb-2"><span class="bg-white opacity-70 me-2 d-none d-md-block" style="width: 40px; height: 1px; margin-top: -1px;"></span><span class="fs-xs fw-semibold text-white opacity-70 text-uppercase">Work with us</span></div>
                        <h2 class="h1 text-white pb-2 pb-sm-3">For Consultancy Opportunities</h2><a class="btn btn-outline-light fs-base" href="{{url('/work-with-us')}}">Get Started</a>
                    </div>
                </div>
                <div class="col-md-6"><img class="d-block mx-auto mx-md-0 mt-n4 mt-md-0" src="{{asset('assets/img/images/conts-bg.png')}}" width="534" ></div>
            </div>
        </div>
    </section>


@endsection
