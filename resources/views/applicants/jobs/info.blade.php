@extends('layouts.app_index')

@section('content')
    <!-- Page content-->
    <div class="col-lg-9 pt-4 pb-2 pb-sm-4">
      <div class="d-flex align-items-center mb-4">
        <a onclick="history.back()" class="btn btn-sm btn-outline-dark  w-sm-auto " type="button" data-bs-dismiss="modal">Back</a>
          @if ($job->tor)
          <a class="btn btn-sm btn-success ms-auto" style="float: right;" a href="{{route('job_download_doc', ['id'=>$job->id])}}" target="blank">Terms of Reference</a>
          @endif
      </div>
      @include('layouts.flash')
      <div class="card border-0 py-1 p-md-2 p-xl-3 p-xxl-4 ">
        <div class="card-body pb-1">
          <div class="d-flex align-items-center mt-sm-n1 pb-1 mb-0 mb-lg-1 mb-xl-3 ">
            <h2 class="h4 mb-3 ">{{$job->name}}</h2>
          </div>
          <div>
                <article class="card border-0 bg-default">
                  <div class="card-body2 pb-4">
                      <dl class="row">
                          <dt class="col-sm-3">Open Date:</dt>
                          <dd class="col-sm-9">{{date('M d, Y', strtotime($job->open_date))}}  </dd>
                          <dt class="col-sm-3">Close Date:</dt>
                          <dd class="col-sm-9">{{date('M d, Y', strtotime($job->close_date))}}</dd>
                          <dt class="col-sm-3">Consultancy Type:</dt>
                          <dd class="col-sm-9">{{$job->consultancy_type ?? "Not Specified"}}</dd>
                          <dt class="col-sm-3">Status:</dt>
                          <dd class="col-sm-3">
                          @if ($job->status == 'Open')
                              <span class=" badge  fs-xs border bg-primary text-white">{{$job->status}}</span>
                          @else
                              <span class=" badge text-nav fs-xs border bg-warning">{{$job->status}}</span>
                          @endif
                              </dd>
                      </dl>
                    @if ($job->job_contents)
                    @foreach ($job->job_contents as $jc)
                    <h5 class=" card-title" style="">
                     {{$jc->heading}}
                    </h5>
                              <p class="  " style="white-space: pre-wrap;">{{$jc->content}}</p>
                    @endforeach
                    @endif


                    </div>
                    <div class="table-responsive w-100 mx-2 table-borderless">
                      @if (count($job->job_milestones)>0)
                      <table class="table table-borderless">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Deliverables / outputs</th>
                            {{-- <th>Due Date</th> --}}
                          </tr>
                        </thead>
                        <tbody>

                        <?php $mmn=1; ?>
                            @foreach ($job->job_milestones as $jm)
                          <tr>
                            <th scope="row">{{$mmn}}</th>
                            <td class="border-0">

                                  <h4 class="h6 mb-2">{{$jm->heading}}</h4>

                                <p class=" fs-sm " style="white-space: pre-wrap;">{{$jm->content}}</p>

                            </td>
                              {{-- <td><h4 class="h6 mb-2">{{date('M d, Y', strtotime($jm->due_date))}}</h4></td> --}}
                          </tr>
                          <?php $mmn++; ?>
                           @endforeach


                          </tbody>
                        </table>

                        @endif
                    </div>
                    <div class="card-body3 pb-4">
                        @if (count($job->job_reports)>0)
                            @foreach ($job->job_reports as $r)
                                <h5 class="h4 card-title pt-" style="font-size: 20px;">
                                 {{$r->heading}}
                                </h5>
                                <p class="  " style="white-space: pre-wrap;">{{$r->content}}</p>
                            @endforeach
                        @endif
                    </div>
                </article>
          </div>
        </div>
      </div>
<br>
                    <section class="card border-0 py-1 p-md-2 p-xl-3 p-xxl-4 mb-4 pt-3">
                    <div class="card-body pb-4">
                        <div class="mb-3">
                            {{-- <i class="ai-cart text-primary lead pe-1 me-2"></i> --}}
                            <h2 class="h4 mb-3 ">How to apply</h2>
                            <p> All applicants are required to mandatorily fill and the complete online application form including employment and educational history, motivational segment and technical competency questions. We will be thoroughly reviewing the application forms only for all the required details. Forms that are incomplete in any respect will not be considered while shortlisting for the next stage</p>

                            <p>Applicants are required to provide the following information:</p>

                        </div>

                    @if (count($job->job_requirements)>0)
                    <div class="col-12 mb-1">

                    </div>
                    <div class="row">
                      <div class="col-sm-12">
                        <ol>
                          @if ($job->p_e_r == 1)
                            <li>
                              <p >Previous Job experiences</p>
                            </li>
                          @endif
                          @if ($job->e_b == 1)
                            <li>
                              <p >Educational background</p>
                            </li>
                          @endif
                      @foreach ($job->job_requirements as $jr)
                        <li>
                          <p >{{$jr->sys_requirement->name}} </p>
                        </li>
                        @endforeach
                      </ol>
                        </div>
                    </div>
                    @endif
                        @if (count($job->job_docs)>0)
                            <h4 class=" pt-1">
                                <h6>Document Required for The Job</h6>
                                <ol>
                                    @foreach ($job->job_docs as $jdoc)
                                        <li>
                                            <p>{{$jdoc->name}}</p>

                                        </li>

                                    @endforeach
                                </ol>
                            </div>
                        @endif

                    <div class="row">
                        <div class="col-sm-12" align="right">
                            <button class="btn btn-secondary w-100 w-sm-auto mb-3 mb-sm-0" type="button" onclick="history.back()">Close</button>
                            @if (count($app)>0)
                                <button class="btn btn-info w-100 w-sm-auto ms-sm-3" disabled="disabled">Already Applied</button>
                            @else
                                @if ($job->status == 'Open')
                                <a class="btn btn-primary w-100 w-sm-auto ms-sm-3" href="{{route('show_apply_job', ['id'=>$job->id])}}" type="button">Apply</a>
                                @endif

                            @endif
                        </div>
                    </div>
                    </section>
    </div>
@endsection
