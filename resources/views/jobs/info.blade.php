@extends('layouts.index')

@section('content')
    <!-- Page content-->
    <div class="col-lg-9 pt-4 pb-2 pb-sm-4">
      <div class="d-flex align-items-center mb-4">
        {{-- <h1 class="h2 mb-0">Job</h1> --}}
        <a onclick="history.back()" class="btn btn-sm btn-outline-dark  w-sm-auto " type="button" data-bs-dismiss="modal">Back</a>


            <a class="btn btn-sm btn-primary ms-auto" style="float: right;" href="{{route('show_edit_job', ['job'=>$job->id])}}">Edit Tender</a>
        </div>
      @include('layouts.flash')
      <div class="card border-0 py-1 p-md-2 p-xl-3 p-xxl-4 ">
        <div class="card-body pb-4">
          <div class="d-flex align-items-center mt-sm-n1 pb-4 mb-0 mb-lg-1 mb-xl-3 container">
            {{-- <i class="ai-cart text-primary lead pe-1 me-2"></i> --}}
            <div>
              <h2 class="h4 mb-0 ">{{$job->name}}</h2>
              <p class="text-muted mb-0">Tender Number: <span class="badge bg-secondary">{{$job->tender_number ?? 'N/A'}}</span></p>
            </div>
          </div>


          <div>
                <article class="card border-0 bg-default">
                  <div class="card-body pb-4">

                      <dl class="row">
                          @if($job->description)
                          <dt class="col-sm-3">Description:</dt>
                          <dd class="col-sm-9">{{$job->description}}</dd>
                          @endif
                          <dt class="col-sm-3">MDA:</dt>
                          <dd class="col-sm-9">{{$job->mda->name ?? 'Not Specified'}}</dd>
                          @if($job->requisition)
                          <dt class="col-sm-3">Requisition:</dt>
                          <dd class="col-sm-9">{{$job->requisition->title}} ({{$job->requisition->requisition_number}})</dd>
                          @endif
                          @if($job->estimated_value)
                          <dt class="col-sm-3">Estimated Value:</dt>
                          <dd class="col-sm-9">{{number_format($job->estimated_value, 2)}} {{$job->currency ?? 'NGN'}}</dd>
                          @endif
                          @if($job->tender_type)
                          <dt class="col-sm-3">Tender Type:</dt>
                          <dd class="col-sm-9">{{$job->tender_type}}</dd>
                          @endif
                          <dt class="col-sm-3">Open Date:</dt>
                          <dd class="col-sm-9">{{date('M d, Y', strtotime($job->open_date))}}  </dd>
                          <dt class="col-sm-3">Close Date:</dt>
                          <dd class="col-sm-9">{{date('M d, Y', strtotime($job->close_date))}}</dd>
                          @if($job->opening_date && $job->opening_date != $job->open_date)
                          <dt class="col-sm-3">Opening Date:</dt>
                          <dd class="col-sm-9">{{date('M d, Y', strtotime($job->opening_date))}}</dd>
                          @endif
                          @if($job->closing_date && $job->closing_date != $job->close_date)
                          <dt class="col-sm-3">Closing Date:</dt>
                          <dd class="col-sm-9">{{date('M d, Y', strtotime($job->closing_date))}}</dd>
                          @endif
                          <dt class="col-sm-3">Consultancy Type:</dt>
                          <dd class="col-sm-9">{{$job->consultancy_type ?? "Not Specified"}}</dd>
                          <dt class="col-sm-3">Status:</dt>
                          <dd class="col-sm-9">

                              @if ($job->status == 'Open')
                                  <span class="badge  fs-xs border bg-primary text-white">Open</span>
                              @elseif ($job->status == 'Draft')
                                  <span class="badge  fs-xs border bg-warning text-white">Draft</span>
                              @elseif ($job->status == 'Closed')
                                  <span class="badge text-nav fs-xs border bg-danger">Closed</span>
                              @endif
                          </dd>
                          @if($job->bid_security_amount)
                          <dt class="col-sm-3">Bid Security:</dt>
                          <dd class="col-sm-9">{{number_format($job->bid_security_amount, 2)}} {{$job->currency ?? 'NGN'}}</dd>
                          @endif
                          @if($job->performance_security_amount)
                          <dt class="col-sm-3">Performance Security:</dt>
                          <dd class="col-sm-9">{{number_format($job->performance_security_amount, 2)}} {{$job->currency ?? 'NGN'}}</dd>
                          @endif
                          @if($job->contract_duration_days)
                          <dt class="col-sm-3">Contract Duration:</dt>
                          <dd class="col-sm-9">{{$job->contract_duration_days}} days</dd>
                          @endif
                          <dt class="col-sm-6">
                            <span class="badge text-nav fs-xs border bg-secondary text-white"><a href="{{route('job_download_doc', ['id'=>$job->id])}}" target="blank">Download ToR</a></span></dt>
                          <dd class="col-sm-6"></dd>
                          @if($job->special_conditions)
                          <dt class="col-sm-3">Special Conditions:</dt>
                          <dd class="col-sm-9" style="white-space: pre-wrap;">{{$job->special_conditions}}</dd>
                          @endif
                      </dl>

                    @if ($job->job_contents)
                    @foreach ($job->job_contents as $jc)
                    <h3 class="h4 card-title" style="font-size: 20px;">
                      <a href="#">{{$jc->heading}}</a>
                    </h3>
                              <p class="  " style="white-space: pre-wrap;">{{$jc->content}}</p>
                    @endforeach
                    @endif


                    </div>
                    <div class="table-responsive w-100 mx-4 table-borderless">
                      @if (count($job->job_milestones)>0)
                      <table class="table table-borderless">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>MileStone</th>
                            {{-- <th>Due Date</th> --}}
                          </tr>
                        </thead>
                        <tbody>
                          <?php $mmn=1; ?>
                            @foreach ($job->job_milestones as $jm)
                          <tr>
                            <th scope="row">{{$mmn}}</th>
                            <td class="border-0 py-1 px-0">
                              <div class="d-flex align-items-center">
                                <div class="ps-3 ps-sm-4">
                                  <h4 class="h6 mb-2">{{$jm->heading}}</h4>
                                  <div class="text-muted fs-sm me-3">
                                       {{$jm->content}}</blockquote></div>
                                </div>
                              </div>
                            </td>
                            {{-- <td>{{$jm->due_date ? date('M d, Y', strtotime($jm->due_date)):""}}</td> --}}
                          </tr>
                          <?php $mmn++; ?>
                           @endforeach

                          </tbody>
                        </table>
                        {{-- @else
                            <div class="  mb-0" style="text-align: center">
                                <h5>No milestones</h5>
                            </div> --}}
                        @endif
                    </div>
                    <div class="card-body pb-4">
                    @if (count($job->job_reports)>0)

                          @foreach ($job->job_reports as $r)
                            <h3 class="h4 card-title pt-5" style="font-size: 20px;">
                              {{$r->heading}}
                            </h3>
                            <p class="  " style="white-space: pre-wrap;">{{$r->content}}</p>

                          @endforeach

                    </div>
                    @endif

                    <hr>

                    <div class="card-body pb-4">



                    @if (count($job->job_requirements)>0)
                    <div class="col-12 mb-3">
                      <h3 class="mb-0">Application Requirements</h3>
                    </div>
                    <div class="row">
                      <div class="col-sm-12">
                        <ul>
                          @if ($job->p_e_r == 1)
                          <li>
                            <label class="form-label" for="heading">Previous Job experiences</label>
                          </li>
                          @endif
                          @if ($job->e_b == 1)
                          <li>
                            <label class="form-label" for="heading">Educational background</label>
                          </li>
                          @endif
                      @foreach ($job->job_requirements as $jr)
                        <li>
                          <label class="form-label" for="heading">{{$jr->sys_requirement->name}} </label>

                        </li>
                        @endforeach
                      </ul>
                        </div>
                    </div>
                        @endif

                        @if (count($job->job_docs)>0)
                            <div class=" pt-5 pb-5">
                                <h6 class="mb-0" >Documents</h6>

                                <ol class="list-group-numbered pt-3">
                                    @foreach ($job->job_docs as $jdoc)
                                        <li class="list-group-item">
                                        <label class="form-label" for="heading">{{$jdoc->name}}</label>
                                        </li>
                                    @endforeach
                                </ol>
                            </div>
                        @endif
        </div>


                </article>


          </div>
        </div>
      </div>
    </div>
@endsection
