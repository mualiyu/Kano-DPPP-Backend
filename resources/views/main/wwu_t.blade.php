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
            <img src="{{asset('assets/img/images/AMP-116.jpg')}}" class="figure-img" alt="...">
          </div>
        </div>
      </section>


      @if (count($tenders)>0)
      <section class="container pt-1" >
          <div class="card border-0 py-1 p-md-2 p-xl-3 p-xxl-4">
              <h3 class="p-0 ">Available Tenders below</h3>
          <div class="card-body3 pb-1">
              <div class="table-responsive">
                  <table class="table">
                      <thead>
                      <tr>
                          <th>Name</th>
                          <th>Status</th>
                          <th>Open</th>
                          <th>Close</th>
                          <th>Action</th>
                      </tr>
                      </thead>
                      <tbody>
            <!-- Order-->
            <?php $a=1;?>
            @if (count($tenders) > 0)
                @foreach ($tenders as $tender)
                <div class="">
                    <tr>
                        <td>{{$tender->name}}</td>
                        <td>
                            @if ($tender->status == 'Open')
                                <span class="badge  fs-xs border bg-primary text-white">Open</span>
                            @elseif ($tender->status == 'Draft')
                                <span class="badge  fs-xs border bg-warning text-white">Draft</span>
                            @elseif ($tender->status == 'Closed')
                                <span class="badge text-nav fs-xs border bg-danger">Closed</span>
                            @endif
                        </td>
                        <td>{{date('M d, Y', strtotime($tender->open_date))}}</td>
                        <td>{{date('M d, Y', strtotime($tender->close_date))}}</td>
                        <td>
                            <a href="{{route('main_job_info', ['job'=>$tender->id])}}" class="nav-link text-normal fs-sm text-success fw-normal py-1 pe-0 ps-1 ms-2">View</a>
                        </td>
                    </tr>
                </div>
                @endforeach

            @else
                <div class="accordion-item border-top mb-0" style="text-align: center">
                  <h5>No Job related to your category found.</h5>
                </div>
            @endif
                      </tbody>
                  </table>

          </div>

          <div class="d-sm-flex align-items-center pt-1 pt-sm-2">
                <nav class="order-sm-2 ms-sm-auto mb-4 mb-sm-0" aria-label="Orders pagination">
                    {{$tenders->links()}}
                </nav>
            </div>
          </div>
      </div>
      </section>
      @else
      <section class="container pt-5" >
        <h5>There are currently no open opportunities. Sign up below to get notified on future opportunities. </h5>
    </section>
      @endif


    {{-- @if (count($tenders)>0)
    <div class="container pt-1 pb-lg-1 pb-md-1 pb-1 my-5">
      <h3>Available Tenders below</h3>
        <div class="masonry-grid mb-1 mb-md-2 pb-lg-1 rounded-0" data-columns="3">
            <!-- Blog item-->
            @foreach ($tenders as $tenderob)
            <article class="masonry-grid-item rounded-0">
                <div class="card border-0 bg-secondary rounded-0">

                    <div class="card-body pb-4 rounded-0">
                        <div class="d-flex align-items-center mb-4 mt-n1">
                          <span class="fs-sm text-muted">{{date('M d, Y', strtotime($tenderob->open_date))}} - {{date('M d, Y', strtotime($tenderob->close_date))}}</span>
                          <span class="fs-xs opacity-20 mx-3">|</span>
                          @if ($tenderob->status == 'Open')
                              <span class="badge text-white fs-xs border bg-primary">Open</span>
                          @else
                              <span class=" badge text-nav fs-xs border bg-warning">{{$tenderob->status}}</span>

                          @endif
                        </div>
                        <h3 class="h5 text-dark card-title">
                          <a href="{{route('app_job_info', ['id'=>$tenderob->id])}}">
                            {{$tenderob->name}}
                          </a>
                        </h3>
                        @if (count($tenderob->job_contents)>0)
                        <?php
                          $pieces = explode(" ", $tenderob->job_contents[0]->content);
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
