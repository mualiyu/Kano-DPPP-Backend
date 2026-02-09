@extends('layouts.main.index1')

@section('title')
    About Us
@endsection

@section('content')

    <section class="container  mt-3 mb-xl-0 mb-xxl-0">
        <div class="row ">
            <!-- Text + CTA button-->
            <div class="col-lg-6 d-flex flex-column mb-4 mb-lg-0 pb-sm-3 pb-lg-0">
                <h1 class="display-2 text-uppercase fw-bold pt-5 mb-2 text-primary">Africa   <span class='fw-normal text-dark'>Minigrids</span> Program<br>
                    <span class="d-none d-md-inline-block align-middle ms-4" style="width: 190px; height: 5px; background-color: currentColor;"></span><p class="fs-6 text-dark ">About us</p></h1>

            </div>
            <!-- Services (grid of cards)-->
            <div class="col-lg-6" >
                <!-- Fade transition-->
                <section class="card border-0 mb-4" id="carousel-fade">

                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="preview4" role="tabpanel">
                                <div class="swiper " data-swiper-options="{
              &quot;effect&quot;: &quot;fade&quot;,
              &quot;loop&quot;: true,
              &quot;navigation&quot;: {
                &quot;prevEl&quot;: &quot;.btn-prev&quot;,
                &quot;nextEl&quot;: &quot;.btn-next&quot;
              }
            }">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide bg-light">
                                            <div class="ratio ratio-4x3">
                                                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center display-5">   <img src="{{asset('assets/img/images/AMP-61.jpg')}}" class="figure-img" alt="..."></div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide ">
                                            <div class="ratio ratio-4x3 ">
                                                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center display-5"><img src="{{asset('assets/img/images/AMP-6.jpg')}}" class="figure-img" alt="..."></div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide">
                                            <div class="ratio ratio-4x3 ">
                                                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center display-5"><img src="{{asset('assets/img/images/AMP-87.jpg')}}" class="figure-img" alt="..."></div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide">
                                            <div class="ratio ratio-4x3 ">
                                                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center display-5"><img src="{{asset('assets/img/images/AMP-15.jpg')}}" class="figure-img" alt="..."></div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide">
                                            <div class="ratio ratio-4x3 ">
                                                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center display-5"><img src="{{asset('assets/img/images/AMP-36.jpg')}}" class="figure-img" alt="..."></div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide">
                                            <div class="ratio ratio-4x3 ">
                                                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center display-5"><img src="{{asset('assets/img/images/AMP-45.jpg')}}" class="figure-img" alt="..."></div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide">
                                            <div class="ratio ratio-4x3 ">
                                                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center display-5"><img src="{{asset('assets/img/images/AMP-47.jpg')}}" class="figure-img" alt="..."></div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide">
                                            <div class="ratio ratio-4x3 ">
                                                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center display-5"><img src="{{asset('assets/img/images/AMP-67.jpg')}}" class="figure-img" alt="..."></div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide">
                                            <div class="ratio ratio-4x3 ">
                                                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center display-5"><img src="{{asset('assets/img/images/AMP-70.jpg')}}" class="figure-img" alt="..."></div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide">
                                            <div class="ratio ratio-4x3 ">
                                                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center display-5"><img src="{{asset('assets/img/images/AMP-117.jpg')}}" class="figure-img" alt="..."></div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide">
                                            <div class="ratio ratio-4x3 ">
                                                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center display-5"><img src="{{asset('assets/img/images/AMP-114.jpg')}}" class="figure-img" alt="..."></div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide">
                                            <div class="ratio ratio-4x3 ">
                                                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center display-5"><img src="{{asset('assets/img/images/AMP-110.jpg')}}" class="figure-img" alt="..."></div>
                                            </div>
                                        </div>

                                    </div>

                                    <button class="btn btn-prev btn-icon btn-sm btn-primary rounded-circle" type="button"><i class="ai-arrow-left "></i></button>
                                    <button class="btn btn-next btn-icon btn-sm btn-primary rounded-circle" type="button"><i class="ai-arrow-right"></i></button>

                                </div>
                            </div>
                            <div class="tab-pane fade" id="html4" role="tabpanel">
                  <pre class="line-numbers"><code class="lang-html">&lt;!--
                          Slider with fade transition between slides --&gt;
&lt;div class=&quot;swiper&quot; data-swiper-options='{
  &quot;effect&quot;: &quot;fade&quot;,
  &quot;loop&quot;: true,
  &quot;navigation&quot;: {
    &quot;prevEl&quot;: &quot;.btn-prev&quot;,
    &quot;nextEl&quot;: &quot;.btn-next&quot;
  }
}'&gt;
  &lt;div class=&quot;swiper-wrapper&quot;&gt;

    &lt;!-- Item --&gt;
    &lt;div class=&quot;swiper-slide bg-light&quot;&gt;
      &lt;div class=&quot;ratio ratio-16x9 bg-faded-info&quot;&gt;
        &lt;div class=&quot;position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center display-5&quot;&gt;First&lt;/div&gt;
      &lt;/div&gt;
    &lt;/div&gt;

    &lt;!-- Item --&gt;
    &lt;div class=&quot;swiper-slide bg-light&quot;&gt;
      &lt;div class=&quot;ratio ratio-16x9 bg-faded-danger&quot;&gt;
        &lt;div class=&quot;position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center display-5&quot;&gt;Second&lt;/div&gt;
      &lt;/div&gt;
    &lt;/div&gt;

    &lt;!-- Item --&gt;
    &lt;div class=&quot;swiper-slide bg-light&quot;&gt;
      &lt;div class=&quot;ratio ratio-16x9 bg-faded-warning&quot;&gt;
        &lt;div class=&quot;position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center display-5&quot;&gt;Third&lt;/div&gt;
      &lt;/div&gt;
    &lt;/div&gt;
  &lt;/div&gt;

  &lt;!-- Prev button --&gt;
  &lt;button type=&quot;button&quot; class=&quot;btn btn-prev btn-icon btn-sm btn-outline-primary rounded-circle&quot;&gt;
    &lt;i class=&quot;ai-arrow-left&quot;&gt;&lt;/i&gt;
  &lt;/button&gt;

  &lt;!-- Next button --&gt;
  &lt;button type=&quot;button&quot; class=&quot;btn btn-prev btn-icon btn-sm btn-outline-primary rounded-circle&quot;&gt;
    &lt;i class=&quot;ai-arrow-rigsht&quot;&gt;&lt;/i&gt;
  &lt;/button&gt;
&lt;/div&gt;</code>
                  </pre>
                            </div>
                            <div class="tab-pane fade" id="pug4" role="tabpanel">
                  <pre class="line-numbers"><code class="lang-pug">// Slider with fade transition between slides
.swiper.swiper-nav-onhover(
  data-swiper-options=`{
    &quot;effect&quot;: &quot;fade&quot;,
    &quot;loop&quot;: true,
    &quot;navigation&quot;: {
      &quot;prevEl&quot;: &quot;.btn-prev&quot;,
      &quot;nextEl&quot;: &quot;.btn-next&quot;
    }
  }`
)
  .swiper-wrapper

    // Item
    .swiper-slide.bg-light
      .ratio.ratio-16x9.bg-faded-info
        .position-absolute.top-0.start-0.w-100.h-100.d-flex.align-items-center.justify-content-center.display-5
          | First

    // Item
    .swiper-slide.bg-light
      .ratio.ratio-16x9.bg-faded-danger
        .position-absolute.top-0.start-0.w-100.h-100.d-flex.align-items-center.justify-content-center.display-5
          | Second

    // Item
    .swiper-slide.bg-light
      .ratio.ratio-16x9.bg-faded-warning
        .position-absolute.top-0.start-0.w-100.h-100.d-flex.align-items-center.justify-content-center.display-5
          | Third

  // Prev button
  button(type=&quot;button&quot;).btn.btn-prev.btn-icon.btn-sm.btn-outline-primary.rounded-circle
    i.ai-arrow-left

  // Next button
  button(type=&quot;button&quot;).btn.btn-next.btn-icon.btn-sm.btn-outline-primary.rounded-circle
    i.ai-arrow-right
</code>
                  </pre>
                            </div>
                        </div>
                    </div>
                </section>
{{--                <img src="{{asset('assets/img/images/AMP-61.jpg')}}" class="figure-img" alt="...">--}}

            </div>
        </div>
    </section>





    <section class="container pt-3 mt-md-2 mt-lg-3 mt-xl-4">
        <div class="row justify-content-center pt-xxl-2">
            <div class="col-lg-9 col-xl-8">
                <h2 class="h4 mb-lg-4 pt-3 pt-md-4 pt-xl-5 text-primary">About the Africa Minigrids Program</h2>
                <p class="fs-lg">The Africa Minigrids Program (AMP) is a country-led technical assistance program for minigrids, active in an initial 21 African countries and complemented by a ‘<a href="https://www.undp.org/energy/our-flagship-initiatives/africa-minigrids-program">regional platform</a>’ acting as the advocacy, coordination and knowledge management hub for the program.</p>

                <p class="fs-lg">AMP is expressly targeting early-stage minigrid markets, seeking to establish the enabling environment for subsequent private investment at scale. The program’s objective is to support access to clean energy by increasing the financial viability, and promoting scaled up commercial investment, in renewable energy minigrids in Africa, with a focus on cost-reduction levers and innovative business models. </p>




                <figure class="figure"><img class="figure-img rounded-2 mb-3" src="{{asset('assets/img/images/architecture.png')}}" alt="">
                    <figcaption class="figure-caption">AMP Architecture</figcaption>
                </figure>
                <h2 class="h4 mb-lg-4 pt-3 pt-md-4 pt-xl-5 text-primary">Supported Countries</h2>
                <iframe height="830px" name="energy-dashboard" src="https://amp-seh-v2.netlify.app/" width="100%" id="energy-dashboard"></iframe>

                <p class="fs-lg">The Program is funded by the United Nations Global Environment Facility (GEF) and led by the United Nations Development Programme (UNDP).
                </p>

                <figure class="figure pt-2"><img class="figure-img rounded-2 mb-3" src="{{asset('assets/img/images/funding.png')}}" alt="">

                </figure>

                <iframe class="pb-5" width="100%" height="515" src="https://www.youtube.com/embed/oOHRHIIQthk?start=554"  allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>


                <hr>

                <h2 class="h4 mb-lg-4 pt-3 pt-md-4 pt-xl-5 text-primary"> Africa Mini-Grids Program – Nigeria National Project</h2>
                <p class="fs-lg">The Africa Minigrids Program in Nigeria is designed as an enabler project of the REA’s Energising Agriculture Programme (EAP) which aims to advance one of REA’s strategic priorities of focusing on the unserved and underserved to increase economic opportunities through agriculture and productive sectors in rural communities across the country. This objective is in line with the mandate of the REA to catalyse economic growth and improve quality of life for rural Nigerians.</p>

                <p class="fs-lg">To enhance the viability of mini-grids and the impact on livelihoods of beneficiaries, the programme will support commercially-oriented business models that are underpinned by cost reduction levers to increase the affordability to renewable electricity, including reducing financing and hardware costs through a de-risking approach. This will be achieved through three outcomes: </p>

                <figure class="figure pt-5"><img class="figure-img rounded-2 mb-3" src="{{asset('assets/img/images/about-1.svg')}}" alt="">
                    <figcaption class="figure-caption">AMP Key Outcomes</figcaption>
                </figure>
            </div>
        </div>

    </section>




    <section class="container pt-1 mt-md-2 mt-lg-3 mt-xl-4">
        <div class="row justify-content-center pt-xxl-2">
            <div class="col-lg-9 col-xl-8">

                <p class="fs-lg"> Thus, the programme will (1) deploy pilot mini-grids to ground-truth the electrification of agricultural value chains and establish the most appropriate solutions and business model(s) for scaling up, and (2) amplify the knowledge with digital support through networking, lessons learnt dissemination, database of potential sites and a roadmap and financing scheme for rapid deployment.</p>

                <p class="fs-lg">The Africa Minigrids Program (AMP) in Nigeria will contribute to the following Sustainable Development Goals:</p>

                <div class="order-lg-1 w-100 mx-auto mx-lg-0 pt-3" >
                    <div class="row row-cols-3 g-3 g-sm-4 g-lg-3 g-xl-4">
                        <div class="col">
                            <div class="bg-light rounded-3" data-aos="zoom-in" data-aos-easing="ease-out-back" data-aos-delay="300"><img src="{{asset('assets/img/images/Sustainable_Development_Goal_5.png')}}" alt=""></div>
                        </div>
                        <div class="col">
                            <div class="bg-light rounded-3" data-aos="zoom-in" data-aos-easing="ease-out-back" data-aos-delay="500"><img src="{{asset('assets/img/images/Sustainable_Development_Goal_7.png')}}" alt=""></div>
                        </div>
                        <div class="col">
                            <div class="bg-light rounded-3" data-aos="zoom-in" data-aos-easing="ease-out-back" data-aos-delay="200"><img class="d-dark-mode-none" src="{{asset('assets/img/images/Sustainable_Development_Goal_13.png')}}" alt="">
                            </div>
                        </div>


                    </div>



                </div>
                <iframe class="pt-5" width="100%" height="515" src="https://www.youtube.com/embed/oOHRHIIQthk?start=728" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>

        </div>
    </section>

    <section class=" pt-5 mt-lg-3 mt-xl-4 mt-xxl-5">
        <div class="bg-primary rounded-0 overflow-hidden mt-2 mt-sm-4 mt-lg-5">
{{--            <img class="position-absolute top-50 start-0 translate-middle-y d-none d-md-block" src="{{asset('assets/img/images/AMP-grid-overlay-1-1.png')}}" width="186">--}}
            <div class="row position-relative zindex-2 align-items-center">
                <div class="col-md-6 col-lg-7 offset-lg-1">
                    <div class="text-center text-md-start py-5 px-4 px-sm-5 pe-md-0 ps-lg-4 ps-xl-5">
                        <div class="d-flex align-items-center justify-content-center justify-content-md-start mb-2"><span class="bg-white opacity-70 me-2 d-none d-md-block" style="width: 40px; height: 1px; margin-top: -1px;"></span><span class="fs-xs fw-semibold text-white opacity-70 text-uppercase">Resources</span></div>
                        <h2 class="h1 text-white pb-2 pb-sm-3">Our Brochure</h2><a class="btn btn-outline-light fs-base" href="{{asset('assets/download/AMP-brochure-Nov2022-EN.pdf')}}" target="_blank">Download</a>
                    </div>
                </div>
                <div class="col-md-2 align-content-center text-center">
                    <img class="d-block mx-auto mx-md-0 mt-n4 mt-md-0" src="{{asset('assets/img/images/amp 2.png')}}" style="height: 300px;" alt="Image"></div>
            </div>
        </div>
    </section>



@endsection
