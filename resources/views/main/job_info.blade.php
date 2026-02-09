@extends('layouts.main.index1')
@section('title')
    Job Info
@endsection
@section('content')
        <section class="mb-md-2 mb-lg-3 mb-xl-4">
        <div class="bg-primary">
          <div class="container">
              <div class="col-lg-12 pb-2 pb-lg-0 mb-4 mb-lg-0 pt-5">
                @if ($job->status == 'Open')
                    <span class="badge text-primary bg-secondary fs-xs border" >Open</span>
                @else
                    <span class=" badge text-nav fs-xs border bg-warning">Closed</span>
                @endif
                <h3 class="display-6 pb- pb-lg-1 text-white">{{$job->name}}</h3>
                <p class="fs-sm fw-bold text-white pb-4">{{date('d M, Y', strtotime($job->open_date))}}</p>
              </div>
          </div>
           </div>
        </section>
        <section class="container pt-0 mt-md-2 mt-lg-3 mt-xl-4">
        @include('layouts.flash')
          <div class="row justify-content-center pt-xxl-2">
              <div class="col-lg-10 col-xl-10">
                    @if (count($job->job_contents)>0)
                    @foreach ($job->job_contents as $nc)
                        <p class="text-dark fw-bold py-2 pt-2 h4"> {{$nc->heading}}</p>
                        <p style="white-space: pre-wrap;"> {{$nc->content}}</p>
                    @endforeach
                    @endif
                    <div class="table-responsive mx-0 table-borderless pb-3">
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
                              @foreach ($job->job_milestones as $jm)
                                <tr>
                                  <th scope="row">1</th>
                                  <td class="border-0 py-1 px-0">
                                    <div class="d-flex align-items-center">
                                      <div class="ps-3 ps-sm-4">
                                        <h4 class="h6 mb-2">{{$jm->heading}}</h4>
                                        <div class="text-muted fs-sm me-3">
                                             {{$jm->content}}</blockquote></div>
                                      </div>
                                    </div>
                                  </td>
                                  {{-- <td>{{date('M d, Y', strtotime($jm->due_date))}}</td> --}}
                                </tr>
                                 @endforeach
                                </tbody>
                              </table>
                              {{-- @else
                                  <div class="  mb-0" style="text-align: center">
                                      <h5>No milestones</h5>
                                  </div> --}}
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

                    <section class="card border-0 py-0 p-md-2 p-xl-3 p-xxl-1 mb-4 pt-3">
                    <div class="card-body3 pb-4">
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
                        @endif
                    </div>

                    <div class="row">
                        <div class="col-sm-12" align="right">
                            <button class="btn btn-secondary w-100 w-sm-auto mb-3 mb-sm-0" type="button" onclick="history.back()">Close</button>
                            @if ($job->status == 'Open')
                                <a class="btn btn-primary w-100 w-sm-auto ms-sm-3" href="{{route('show_apply_job', ['id'=>$job->id])}}" type="button">Apply</a>
                            @endif
                        </div>
                    </div>
                    </section>

                    </div>
              </div>

      </section>
@endsection
