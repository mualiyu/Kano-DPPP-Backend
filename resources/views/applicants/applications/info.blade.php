@extends('layouts.app_index')

@section('content')
    <!-- Page content-->
    <div class="col-lg-9 pt-4 pb-2 pb-sm-4">
      <div class="d-flex align-items-center mb-4">
        {{-- <h1 class="h2 mb-0">Job</h1> --}}
        <a onclick="history.back()" class="btn btn-sm btn-outline-dark  w-sm-auto " type="button" data-bs-dismiss="modal">Back</a>


            {{-- <a class="btn btn-sm btn-primary ms-auto" style="float: right;" href="{{route('show_edit_job', ['job'=>$job->id])}}">Edit Job</a> --}}
        </div>
      @include('layouts.flash')
      <div class="card border-0 py-1 p-md-2 p-xl-3 p-xxl-4 ">
        <div class="card-body pb-4">
          <div class="d-flex align-items-center mt-sm-n1 pb-4 mb-0 mb-lg-1 mb-xl-3 container">
            {{-- <i class="ai-cart text-primary lead pe-1 me-2"></i> --}}
            <h2 class="h4 mb-0 ">{{$app->job->name}}</h2>


          </div>


          <div>
                <article class="card border-0 bg-default">
                  <div class="card-body4 pb-4">

                    <dl class="row">
                        <dt class="col-sm-3">Open Date:</dt>
                        <dd class="col-sm-9">{{date('M d, Y', strtotime($app->job->open_date))}}  </dd>
                        <dt class="col-sm-3">Close Date:</dt>
                        <dd class="col-sm-9">{{date('M d, Y', strtotime($app->job->close_date))}}</dd>
                        <dt class="col-sm-3">Job Status:</dt>
                        <dd class="col-sm-9">
                            @if ($app->job->status == 'Open')
                                <span class=" badge  fs-xs border bg-primary text-white">{{$app->job->status}}</span>
                            @else
                                <span class=" badge text-nav fs-xs border bg-warning">{{$app->job->status}}</span>
                            @endif
                        </dd>
                        <dt class="col-sm-3">Application Status:</dt>
                        <dd class="col-sm-9">
                            @if ($app->status == 'Successful')
                                <span class=" badge  fs-xs border bg-primary text-white">{{$app->status}}</span>
                            @elseif ($app->status == 'Approved')
                                <span class="badge  fs-xs border bg-info text-white">{{$app->status}}</span>
                            @elseif ($app->status == 'Unsuccessful')
                                <span class="badge  fs-xs border bg-danger text-white">{{$app->status}}</span>
                            @else
                                <span class=" badge text-nav fs-xs border bg-warning">{{$app->status}}</span>
                                {{-- @endifclass="col-sm-2 badge  fs-xs border text-dark"> --}}
                            @endif
                        </dd>
                        <dt class="col-sm-3">ToR:</dt>
                        <dd class="col-sm-9">
                                <a href="{{route('app_job_download_doc', ['id'=>$app->job->id])}}" class=" badge  fs-xs border bg-primary text-white">Download</a>
                        </dd>
                    </dl>

                    @if ($app->job->job_contents)
                    @foreach ($app->job->job_contents as $jc)
                    <h3 class="h4 card-title" style="font-size: 20px;">
                      <a href="#">{{$jc->heading}}</a>
                    </h3>
                              <p class="  " style="white-space: pre-wrap;">{{$jc->content}}</p>
                    @endforeach
                    @endif


                    </div>
                    <div class="table-responsive w-100 mx-4 table-borderless">
                      @if (count($app->job->job_milestones)>0)
                      <table class="table table-borderless">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>MileStone</th>
                            {{-- <th>Due Date</th> --}}
                          </tr>
                        </thead>
                        <tbody>

                            <?php $ii=1; ?>
                            @foreach ($app->job->job_milestones as $jm)
                          <tr>
                            <th scope="row">{{$ii}}</th>
                            <?php $ii++;?>
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

{{--                    @if ($app->job->job_docs)--}}
{{--                        <div class=" pt-5 mx-4">--}}
{{--                            <div class="d-none d-sm-block fs-sm mb-2 display-3">Document Required for The Job</div>--}}
{{--                            <ol class="list-group list-group-numbered list-group-flush">--}}
{{--                                @foreach ($app->job->job_docs as $jdoc)--}}
{{--                                    <li class="list-group-item">{{$jdoc->name}}</li>--}}
{{--                                @endforeach--}}
{{--                            </ol>--}}
{{--                        </div>--}}
{{--                    @endif--}}

                   @if (count($app->application_documents) > 0)
                       <div class=" pt-5 mx-4">
                           <div class="d-none d-sm-block fs-sm mb-2 display-3">Document Submitted for The Job</div>
                           <ol class="list-group list-group-numbered list-group-flush">
                               @foreach ($app->application_documents as $app_doc)
                                   <li class="list-group-item">{{$app_doc->job_doc->name}}
                                       <a href="{{route('app_download_doc', ['id'=>$app_doc->id])}}" style="float: right;">Download</a>
                                   </li>
                               @endforeach
                           </ol>
                       </div>
                   @endif

                    <hr>
                    <div class=" pt-4">
                        @if ($app->app_requirements)
                        <div class="col-12" >
                        <h5 class="mb-3">Submitted application summary:</h5>
                        </div>

                        @foreach ($app->app_requirements as $ar)
                          <div class="col-sm-12 d-sm-block">
                              <div class="mb-3">
                                <label for="file-input" class="form-label">{{$ar->name}}: </label>
                                @if ($ar->type == "TextInput")
                                <input class="form-control" disabled type="text" value="{{$ar->value}}">
                                @elseif($ar->type == "NumericInput")
                                <input disabled class="form-control"  type="number" value="{{$ar->value}}">
                                @elseif($ar->type == "CheckBox")
                                <input disabled {{$ar->value == null ? "":"checked"}} type="checkbox">
                                 @elseif($ar->type == "Yes/No")
                                  @if ($ar->value == 1)
                                  <br>
                                    <label for="y">Yes: </label>
                                    <input disabled checked type="radio">
                                    <br>
                                    <label for="n">No: </label>
                                    <input disabled type="radio">
                                  @else
                                  <br>
                                    <label for="y">Yes: </label>
                                    <input disabled type="radio">
                                    <br>
                                    <label for="n">No: </label>
                                    <input disabled checked type="radio">
                                  @endif
                                @elseif($ar->type == "Textarea")
                                <textarea class="form-control"  rows="10" disabled>{{$ar->value}}</textarea>
                                @endif
                              </div>
                          </div>
                        @endforeach
                        @endif

                        @if ($app->job->p_e_r == 1)
                          <?php $r =1;?>
                          <div class="row">
                            <div class="col-12 d-sm-block">
                                <h6 class="h6 mb-0" style="float: left">Previous Jobs</h6>
                                <br>
                            </div>
                          </div>
                            <div class="row expp pb-5 my-3">
                              @if (count($app->experiences)>0)
                              @foreach ($app->experiences as $e)
                              <div class="col-sm-12 mb-3">
                                <span>Experience ({{$r}})</span>
                              </div>
                              <div class="col-sm-6 mb-3">
                                <input type="hidden" name="exp_id[{{$r}}]" value="{{$e->id}}">
                                <label class="form-label" for="heading">Employer Name:</label>
                                <input disabled class="form-control" type="text" value="{{$e->name}}" id="experience" name="e_name[{{$e->id}}]">
                              </div>
                              <div class="col-sm-6 mb-3">
                                <input type="hidden" name="exp_id[{{$r}}]" value="{{$e->id}}">
                                <label class="form-label" for="heading">Role:</label>
                                <input disabled class="form-control" type="text" value="{{$e->role}}" id="role" name="e_role[{{$e->id}}]">
                              </div>
                              <div class="col-sm-6">
                                <label class="form-label" for="heading">Start</label>
                                <input disabled class="form-control" type="text" value="{{date('d M, Y', strtotime($e->start))}}" id="start_date" name="start_date[{{$e->id}}]">
                              </div>
                              @if ($e->currently==1)
                              <div class="col-sm-6">
                                <label class="form-label" for="heading"></label>
                                <br>
                                <p>Currently work Here</p>
                                {{-- <input disabled type="checkbox" value="1" {{$e->currently==1 ? "checked":""}} id="current" name="e_cerrent[{{$e->id}}]"> --}}
                              </div>
                              @else
                              <div class="col-sm-6">
                                <label class="form-label" for="heading">End</label>
                                <input disabled class="form-control" type="text" value="{{date('d M, Y', strtotime($e->end))}}" id="end_date" name="end_date[{{$e->id}}]">
                              </div>
                              @endif
                              <?php $r++; ?>
                              @endforeach
                              @else
                              <p>No Experince Submited!</p>
                              @endif
                            </div>
                        @endif

                        @if ($app->job->e_b == 1)
                          <?php $r =1;?>
                          <div class="row">
                            <div class="col-12 d-sm-block">
                                <h6 class="h6 mb-0" style="float: left">Educational Background</h6>
                                <br>
                            </div>
                          </div>
                            <div class="row expp pb-5 my-3">
                              @if (count($app->educations)>0)
                              @foreach ($app->educations as $e)
                              <div class="col-sm-12 mb-3">
                                <span>Education ({{$r}})</span>
                              </div>
                              <div class="col-sm-6 mb-3">
                                <input type="hidden" name="exp_id[{{$r}}]" value="{{$e->id}}">
                                <label class="form-label" for="heading">Degree:</label>
                                <input disabled class="form-control" type="text" value="{{$e->type}}" id="type" name="e_type[{{$e->id}}]">
                              </div>
                              <div class="col-sm-6 mb-3">
                                <input type="hidden" name="exp_id[{{$r}}]" value="{{$e->id}}">
                                <label class="form-label" for="heading">Major:</label>
                                <input disabled class="form-control" type="text" value="{{$e->major}}" id="role" name="e_role[{{$e->id}}]">
                              </div>
                              <div class="col-sm-12">
                                <label class="form-label" for="heading">Institude</label>
                                <input disabled class="form-control" type="text" value="{{$e->institute}}" id="ins" name="start_date[{{$e->id}}]">
                              </div>
                              <div class="col-sm-6">
                                <label class="form-label" for="heading">Start</label>
                                <input disabled class="form-control" type="text" value="{{date('d M, Y', strtotime($e->start))}}" id="start_date" name="start_date[{{$e->id}}]">
                              </div>
                              @if ($e->currently==1)
                              <div class="col-sm-6">
                                <label class="form-label" for="heading">End</label>
                                <input disabled type="input" class="form-control" value="Current">
                              </div>
                              @else
                              <div class="col-sm-6">
                                <label class="form-label" for="heading">End</label>
                                <input disabled class="form-control" type="text" value="{{date('d M, Y', strtotime($e->end))}}" id="end_date" name="end_date[{{$e->id}}]">
                              </div>
                              @endif
                              <?php $r++; ?>
                              @endforeach
                              @else
                              <p>No Experince Submited!</p>
                              @endif
                            </div>
                        @endif
                    
                    </div>

                    {{-- @if ($app->status == "Queried") --}}
                        @if (count($app->comments)>0)
                        <div class="pt-5 ">
                            <h6>Decision</h6>
                        </div>
                            <div class="table-responsive mx-0 w-100 mb-5">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Decision</th>
                                        <th>Comment</th>
                                        <th>Creation Time</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($app->comments as $a_c)
                                        <tr>
                                            <td>{{$a_c->type}}</td>
                                            <td>{{$a_c->comment}}</td>
                                            <td>{{date('M d, Y', strtotime($a_c->created_at))}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif

                    <div class="row">
                        <div class="col-sm-12" align="right">
                            <button onclick="history.back()" class="btn btn-secondary w-100 w-sm-auto mb-3 mb-sm-0" type="button" data-bs-dismiss="modal">Close</button>

                            <a class="btn btn-primary w-100 w-sm-auto ms-sm-3" href="{{route('app_show_update_app', ['id'=>$app->job->id])}}" type="button">Update Application</a>

                        </div>
                    </div>
                </article>


          </div>
        </div>
      </div>
    </div>
@endsection
