@extends('layouts.main.index1')

@section('title')
    Energising Agriculture Programme
@endsection

@section('content')
    <!-- Hero-->
      <section class="container  mt-3 mb-xl-0 mb-xxl-0">
        <div class="row pt-2">
          <!-- Text + CTA button-->
          <div class="col-lg-6 d-flex flex-column mb-4 pt-xxl-5 mb-lg-0 pb-sm-3 pb-lg-0">
            <h1 class="display-2 text-uppercase fw-bold pt-3 mb-2 text-primary">Energising   <span class='fw-normal text-dark'>Agriculture</span> Programme<span class="d-none d-md-inline-block align-middle ms-4" style="width: 190px; height: 5px; background-color: currentColor;"></span></h1>
                        <p class="fs-6 text-dark pb-md-2 mb-lg-5">Enhancing the viability of mini-grids and the impact of electrification through agriculture.</p>


          </div>
          <!-- Services (grid of cards)-->
            <div class="col-lg-6" >                 <div class="">

                <img src="{{asset('assets/img/images/FeNYWUwXwAAB4sx.jpeg')}}" style="height: 430px;" class="figure-img" alt="...">
                </div>
            </div>
        </div>
      </section>
      <!-- About-->
      <section class="container  ">

    <div class="row pt-1 pt-sm-3 pt-md-4 pb-0 ">
          <div class="col-md-11 col-lg-9 col-xl-12 pb-1 pb-sm-3 pb-md-4">
            <h3 class="h4 pb-sm-2 pb-lg-3 text-primary">Energizing Agriculture Programme (EAP) - Objectives</h3>
            <p class="mb-3 fs-lg">Agriculture is the largest sector in rural areas and across Nigeria and is, hitherto, yet to be explicitly targeted by electrification efforts.</p>
        <p class="mb-3 fs-lg">The EAP aims to stimulate the productive use of minigrid electricity in agriculture by enabling market-led solutions and breaking the silos separating electrification and agricultural development programmes.  The programme will build upon existing agriculture and electrification initiatives in Nigeria and then accelerate the deployment and adoption of the most effective solutions for rural communities across the country. It will do this by bringing together teams of local partners to test commercially led business models, debug appliances, and scale proven solutions.</p>
            <ul class="mb-0 pb-5 fs-lg">
              <li>Accelerate deployment of agriculture electrification interventions by convening teams to test business models and debug appliances across minigrid sites.</li>
              <li>Scale proven solutions to 200 communities by supporting participating businesses raise financing and identifying growth opportunities.</li>
              <li>Break agriculture and electrification silos to create a pipeline of agriculture energy projects and develop pilot projects.</li>
              <li>Ensure local ownership of solutions and scaling by partnering and sharing insights broadly.</li>

            </ul>


          </div>
          </div>
      </section>
    <section class="container pt-">
        <div class="row justify-content-center pt-xxl-">
            <div class="col-lg-9 col-xl-8">
                <img src="{{asset('assets/img/images/AMP Nigeria_Overview1.svg')}}" class="d-block rounded-0 align-content-center text-center mb-5" alt="Image caption" style="width: 950px;">
                <iframe style="height: 540px;" src="https://www.youtube.com/embed/Fdq_ORPHDXo" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        </div>
    </section>
    <section class="container pt-5 my-lg-3 my-xl-4 my-xxl-5 mb-3">
        <div class="row row-cols-2 row-cols-md-2 g-2 g-md-4 pb-2 ">

            <div class="col text-center mb-3"><span class="fs-sm fw-bold fw-bold text-dark">In collaboration with:</span>
                <img class="d-block pt-3 mx-auto text-center" src="{{asset('assets/img/images/3.png')}}" width="80" >
            </div>

            <div class="col text-center mb-3"> <span class="fs-sm mx-auto  fw-bold text-dark">Supported by:</span>
                <img class="d-block d-dark-mode-none mx-auto pt-3" src="{{asset('assets/img/images/4.png')}}" style="width: 250px;" >
            </div>

        </div>
    </section>


 <section class="pt- mt-lg-3 mt-xl-4 mt-xxl-5 pb-5">
        <div class="container  mt-md-2">
            <p class="mb-3 pt- fs-lg">Agriculture is the economic backbone of rural Nigerian communities where minigrids are the least-cost electrification option.  Experts estimate that Nigeria’s agricultural sector, which provides nearly one quarter of the country’s GDP and employs two-thirds of the labor force, has the potential to generate $40 billion in exports. In a 2020 feasibility study, RMI and the U.S. Agency for International Development (USAID) found an immediate opportunity to power cassava, rice, and cereal grain processing with minigrid electricity, allowing equipment owners to earn attractive rates of return over the lifetime of the equipment.  Using electricity to power opportunities like these can drive a virtuous cycle for rural development by increasing incomes and community resilience and improving the financial performance of the minigrid utility.</p>


            <div class="row">
            <!-- Sticky sidebar-->
            <div class="col-md-5 col-xl-4 mb-5 mb-md-0" style="margin-top: -125px;">
              <div class="position-sticky top-0" style="padding-top: 125px;">
                <h2 class="h4 pb-2 pb-lg-3 text-primary">Setting the Context – AMP in REA's Strategy</h2>
                <div class="row">
                  <div class="col-md-10">
                    <p class="mb-4">Four priority areas in REA’s 5-year Vision and Strategic Roadmap</p>
                  </div>
                </div>

              </div>
            </div>
            <!-- Pricing list-->
            <div class="col-md-7 offset-xl-1">
              <div class="ps-md-4 ps-xxl-5">
                <!-- Pricing card-->
                <div class="card border-0 bg-secondary rounded-4 position-relative mb-3">
                  <div class="card-body d-sm-flex align-items-start  text-sm-start">
                    <div class="w-100 pe-sm-4 mb-3 mb-sm-0" style="max-width: 27rem;">
                      <h5 class="mb-2 text-primary">1. Implement and Coordinate</h5>
                      <p class=" mb-0">Increasing Sector Coordination</p>
                    </div>

                  </div>
                </div>
                <!-- Pricing card-->
                <div class="card border-0 bg-secondary rounded-4 position-relative mb-3">
                  <div class="card-body d-sm-flex align-items-start  text-sm-start">
                    <div class="w-100 pe-sm- mb-3 mb-sm-0" style="max-width: rem;">
                      <h5 class="mb-2 text-primary">02. Promote a Sustainable Market</h5>
                      <p class="mb-0">Enabling Electricity Markets</p>
                    </div>

                  </div>
                </div>
                <!-- Pricing card-->
                <div class="card border-0 bg-primary rounded-4 position-relative mb-3">
                  <div class="card-body d-sm-flex align-items-start  text-sm-start ">
                    <div class="w-100 pe-sm-4 mb-3 mb-sm-0" style="max-width: rem;">
                      <h5 class="mb-2 text-white">03. Focus on the Unserved and Underserved</h5>
                      <p class=" mb-0 text-white">Reaching Communities and Increasing Economic Opportunity</p>
                    </div>

                  </div>
                </div>
                <!-- Pricing card-->
                <div class="card border-0 bg-secondary rounded-4 position-relative">
                  <div class="card-body d-sm-flex align-items-start  text-sm-start">
                    <div class="w-100 pe-sm-4 mb-3 mb-sm-0" style="max-width: rem;">
                      <h5 class="mb-2 text-primary">04. Excellence in Delivery and Talent</h5>
                      <p class="mb-0">Shaping REA into a Top-Tier Agency</p>
                    </div>

                  </div>
                </div>
              </div>
            </div>
              </div>


        </div>
      </section>

    <section class="container pt-">
        <div class="row justify-content-center pt-xxl-">
            <div class="col-lg-9 col-xl-8">
                <img src="{{asset('assets/img/images/AMP Nigeria_Overview.svg')}}" class="d-block rounded-0 align-content-center text-center mb-5" alt="Image caption" style="width: 950px;">
                <iframe style="height: 540px;" src="https://www.youtube.com/embed/oOHRHIIQthk?start=797" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        </div>
    </section>

@endsection


