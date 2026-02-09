@extends('layouts.main.index1')

@section('title')
    Work With Us
@endsection

@section('content')

            <section class="container mt-3 mb-xl-0 mb-xxl-0">
        <div class="row pt-">

          <div class="col-lg-6 d-flex flex-column mb-4 mb-lg-0 pb-sm-3 pb-lg-0">
              <h1 class="display-2 text-uppercase fw-bold mt-auto mb-2"><span class=' text-primary'>Work</span>   <span class='fw-normal'>With</span> <span class=' text-primary'>US</span><span class="d-none text-primary d-md-inline-block align-middle ms-4" style="width: 120px; height: 2px; background-color: currentColor;"></span></h1>
            <p class="fs-6 text-dark pb-md-2 mb-lg-5">Opportunities within the AMP Financed Projects</p>
          </div>
          <!-- Services (grid of cards)-->
          <div class="col-lg-6" >

            <img src="{{asset('assets/img/images/AMP-129.jpg')}}" class="figure-img" alt="...">

          </div>
        </div>
      </section>


    <section class="container pt-5 mt-md-2 mt-lg-3 mt-xl-4">
        <div class="row justify-content-center pt-xxl-2">
            <div class="col-lg-9 col-xl-8">
                <h3 class="h4 pb-sm-2 pb-lg-3 text-primary">What is Consultants Portal?</h3>
                <p class=" mb-3">The E-portal maintains a roster of registered firms and individual consultants to be able to get firsthand and timely information on business opportunities within AMP financed projects.  </p>

                <p class=" mb-3">Many firms and individual consultants have expressed interest to participate in the business opportunities made available by the AMP. To better organise information on the potential consultants and firms interested in working on the AMP projects, REA is offering online registration to consultants and firms.  </p>

                <p class=" mb-3">The purpose of the online database is to maintain profiles of individuals and consulting firms that have adequate expertise and experience in specialised fields. To register in the system, companies/individuals must provide basic information about the company and its profile fulfil the basic criteria set by REA.  </p>

                <ul class=" mb-0">
                    <li>contact addresses</li>
                    <li>management details</li>
                    <li>legal details</li>


                </ul>
                <div class="pt-5 align-content-center text-center">
                    <h3 class="h4 pb-sm-2 pb-lg-3 text-primary">
                    Sign up now
                </h3>
                    <p>REA encourages firm/individual consultant to benefit from this opportunity and sign up this online platform for available opportunities.</p>
                    <a href="{{url('/applicant/signup')}}" class="btn btn-primary"> Sign up </a>
                </div>
                <div class="pt-5 align-content-center text-center">
                    <h3 class="h4 pb-sm-2 pb-lg-3 text-primary">
                        Login
                    </h3>
                    <p>If you already have an account please login here.</p>

                        <a href="{{url('/applicant/signin')}}"  class="btn btn-primary"> Login </a>
                </div>

            </div>
        </div>
    </section>

@endsection
