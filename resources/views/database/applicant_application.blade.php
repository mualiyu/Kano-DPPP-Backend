@extends('layouts.index')

@section('content')
    <!-- Page content-->
    <div class="col-lg-9 pt-4 pb-2 pb-sm-4">
      <div class="d-flex align-items-center mb-4">
        {{-- <h1 class="h2 mb-0">{{$job->name}} Bids</h1> --}}
         <h4 class="h3 mb-0">Bids from {{$applicant->name}}</h4>
        {{-- <a class="btn btn-primary ms-auto" style="max-width: 200px;" href="{{route('job_export_applications', ['id'=>$job->id])}}">
          Export Application
        </a> --}}
      </div>
      @include('layouts.flash')
      <div class="card border-0 py-1 p-md-2 p-xl-3 p-xxl-4">
        <div class="card-body pb-4">
          <!-- Orders accordion-->
          {{-- <div class="accordion accordion-alt accordion-orders" id="orders"> --}}
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        {{-- <th>Applicant</th> --}}
                        <th>Job Title</th>
                        <th>Application Status</th>
                        <th>Date Submitted</th>
                        <th>Action</th>
                    </tr>
                    </thead>

                    <tbody>
            <!-- Order-->
            <?php $a=1;?>
            @if (count($bids) > 0)
                @foreach ($bids as $bid)
<?php
  $per = 0;
  if (!$bid->vendor->name == Null) {
    $per = $per + 11.11;
  }
  if (!$bid->vendor->email == Null) {
    $per = $per + 11.11;
  }
  if (!$bid->vendor->phone == Null) {
    $per = $per + 11.11;
  }
  if (!$bid->vendor->ownership_type == Null) {
    $per = $per + 11.11;
  }
  if (!$bid->vendor->directors == Null) {
    $per = $per + 11.11;
  }
  if (!$bid->vendor->vat_number == Null) {
    $per = $per + 11.11;
  }
  if (!$bid->vendor->address == Null) {
    $per = $per + 11.11;
  }
  if (!$bid->vendor->mobile == Null) {
    $per = $per + 11.11;
  }

  $per = $per + 11.12;
  ?>
                <tr>
                  {{-- <div class="accordion-header"><a class="accordion-button d-flex fs-4 fw-normal text-decoration-none py-3 collapsed" href="#orderOne" data-bs-toggle="collapse" aria-expanded="false" aria-controls="orderOne">
                      <div class="d-flex justify-content-between w-100" style="max-width: 750px;">
                        <div class="me-3 me-sm-3">
                          <div class="fs-sm text-muted mb-2">Company</div>
                          <div class="fs-sm fw-medium text-dark">{{$bid->vendor->name}}</div>
                        </div>
                        <div class="me-3 me-sm-3">
                          <div class="fs-sm text-muted mb-2">Job Title</div>
                          <div class="fs-sm fw-medium text-dark"></div>
                        </div>
                        <div class="me-3 me-sm-3">
                          <div class="fs-sm text-muted">Application Status</div>
                          <span class="badge bg-{{$bid->status == 'approved' ? 'faded-info':'warning'}} text-info fs-xs">{{$bid->status}}</span>
                        </div>
                        <div class="me-3 me-sm-3">
                          <div class="d-none d-sm-block fs-sm text-muted mb-2">Docs Submited</div>
                          <div class="d-sm-none fs-sm text-muted mb-2">Docs</div>
                          <div class="fs-sm fw-medium text-dark">
                              @if (count($bid->bid_documents)>0)
                                  @foreach ($bid->bid_documents as $bid_doc)
                                  <span>{{$bid_doc->tender_doc->name}}, </span>
                                  @endforeach
                              @endif
                          </div>
                        </div>
                        <div class="me-3 me-sm-3">
                          <div class="d-none d-sm-block fs-sm text-muted mb-2">Date Submited</div>
                          <div class="d-sm-none fs-sm text-muted mb-2">Date</div>
                          <div class="fs-sm fw-medium text-dark">{{date('M d, Y - h:ma', strtotime($bid->created_at))}}</div>
                        </div>
                      </div>
                      <div class="accordion-button-img d-none d-sm-flex ms-auto">
                         <button data-bs-toggle="modal" data-bs-target="#modalId{{$bid->id}}" class="nav-link text-normal fs-xl fw-normal py-1 pe-0 ps-1 ms-2" data-bs-toggle="tooltip" aria-label="Edit"><i class="ai-edit-alt"></i></button>

                      </div>
                    </a>
                    </div> --}}

                    {{-- <td>{{$bid->vendor->name}}</td> --}}
                            <td>{{$bid->tender->name}}</td>
                            <td>
                                @if ($bid->status == 'approved')
                                    <span class="badge  fs-xs border bg-primary text-white">{{$bid->status}}</span>
                                @else
                                    <span class="badge text-nav fs-xs border bg-warning">{{$bid->status}}</span>
                                @endif
                            </td>
                            <td>{{date('M d, Y - h:ma', strtotime($bid->created_at))}}</td>
                            <td>
                                <button data-bs-toggle="modal" data-bs-target="#modalId{{$bid->id}}" class="nav-link text-default fs-sm fw-normal text-primary py-1 pe-0 ps-1 ms-2" type="button" data-bs-toggle="tooltip" aria-label="View">
                                    View
                                </button>
                            </td>
                </tr>
                    <div class="modal fade" id="modalId{{$bid->id}}" tabindex="-1" role="dialog">
                      <div class="modal-dialog modal-fullscreen" role="document">
                        <div class="modal-content">
                          <div class="modal-header ">
                            <h4 class="modal-title align-self-start">{{$bid->vendor->name}}</h4>

                            <button class="btn-close align-self-end" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">

                              @if ($bid->status == 'approved')
                                  <span class="badge  fs-lg border bg-primary text-white">{{$bid->status}}</span>
                              @else
                                  <span class="badge text-nav fs-lg border bg-warning">{{$bid->status}}</span>
                              @endif
{{--                              <div class="btn btn-dark rounded-pill align-self-end">{{$bid->status}}</div>--}}
                              <div class="row pt-4">
                                  <div class="col-12 col-sm-6">
                                      <article class="">
                                        <div class=" ">
                                            <!-- Description list alignment -->
                                            <dl class="row">
                                                <dt class="col-sm-3">Job Name&nbsp;</dt>
                                                <dd class="col-sm-9 text-bold">{{$bid->tender->name}}</dd>
                                                <dt class="col-sm-3">Start Date</dt>
                                                <dd class="col-sm-9">{{date('M d, Y', strtotime($bid->tender->opening_date))}} </dd>
                                                <dt class="col-sm-3">End Date</dt>
                                                <dd class="col-sm-9"> {{date('M d, Y', strtotime($bid->tender->closing_date))}}</dd>
                                                <dt class="col-sm-3 ">Status</dt>
                                                <dd class="col-sm-9">
                                                    @if ($bid->tender->status == 'open')
                                                        <span class="badge  fs-xs border bg-primary text-white">Open</span>
                                                    @elseif ($bid->tender->status == 'draft')
                                                        <span class="badge  fs-xs border bg-warning text-white">Draft</span>
                                                    @elseif ($bid->tender->status == 'closed')
                                                        <span class="badge text-nav fs-xs border bg-danger">Closed</span>
                                                    @endif

                                                  </dd>
                                            </dl>
                                          @if (count($bid->tender->tender_contents)>0)
                                              @foreach ($bid->tender->tender_contents as $jc)
                                              <h4 class="h5" style="font-size: 15px;">
                                               {{$jc->heading}}
                                              </h4>
                                              <p class="" style="font-size: 15px; white-space: pre-wrap;">{{$jc->content}}</p>
                                              @endforeach
                                          @endif
                                          </div>
                                          @if (count($bid->tender->tender_milestones)>0)
                                          {{-- <div class="table w-100 mx-4" style="font-size: 15px;"> --}}
                                            <div class="row">
                                              <div class="col-sm-1 h6 mb-2">
                                                #
                                              </div>
                                              <div class="col-sm-11 h6 mb-2">
                                                MileStone
                                              </div>
                                              {{-- <div class="col-sm-3 h6 mb-2">
                                                Due Date
                                              </div> --}}
                                            </div>
                                            <?php $mmn=1; ?>
                                            @foreach ($bid->tender->tender_milestones as $jm)
                                            <div class="row">
                                              <div class="col-sm-1">
                                              {{$mmn}}
                                              </div>
                                              <div class="col-sm-11">
                                                <div class="d-flex align-items-center">
                                                  <div class="ps-3 ps-sm-4">
                                                    <p class="h7">{{$jm->heading}}</p>
                                                    <div class="text-muted fs-sm me-3"><p class="fw-medium">{{$jm->content}}</p></div>
                                                  </div>
                                                </div>
                                              </div>
                                              {{-- <div class="col-sm-3">
                                                {{date('M d, Y', strtotime($jm->due_date))}}
                                              </div> --}}
                                            </div>
                                            <?php $mmn++; ?>
                                            @endforeach
                                            @endif

                                          <div class="pb-4">
                                              @if (count($bid->tender->tender_reports)>0)
                                                  @foreach ($bid->tender->tender_reports as $r)
                                                      <h3 class="h4 card-title pt-5" style="font-size: 15px;">
                                                          {{$r->heading}}
                                                      </h3>
                                                      <p class="  " style="white-space: pre-wrap; font-size: 15px;">{{$r->content}}</p>
                                                  @endforeach
                                          </div>
                                          @endif
                                            <br>
                                          <hr>

                                          @if (count($bid->tender->tender_requirements)>0)
                                          <div class="row pt-5">
                                            <div class="col-12 mb-3">
                                               <div class="d-none text-dark d-sm-block fs-lg mb-2 display-3">Application Requirements</div>
                                            </div>
                                            <div class="row">
                                              <div class="col-sm-12">
                                                <ul>
                                              @foreach ($bid->tender->tender_requirements as $jr)
                                                <li>
                                                  <label class="form-label" for="heading">{{$jr->sys_requirement->name}}</label>
                                                </li>
                                                @endforeach
                                              </ul>
                                                </div>
                                            </div>
                                          </div>
                                          @endif

                                          <div class="row">
                                              @if ($bid->tender->tender_docs)
                                                  <div class="">
                                                      <div class="d-none d-sm-block fs-sm mb-2 display-3">Documents</div>
                                                      <ul class="">
                                                          @foreach ($bid->tender->tender_docs as $jdoc)
                                                              <li class="">
                                                                  <label class="form-label" for="heading">  {{$jdoc->name}}</label>
                                                              </li>
                                                          @endforeach
                                                      </ul>
                                                  </div>
                                              @endif
                                          </div>
                                      </article>
                                  </div>
                                  <div class="col-12 col-sm-6">
                                      <article class=" border-0 bg-default">
                                        <div class="pb-4">
                                            <div class="row">
                                                <div class="col-12">

                                                    <dl class="row">
                                                        <dt class="col-sm-3 text-muted">Company Name:&nbsp;</dt>
                                                        <dd class="col-sm-9 text-dark">{{$bid->vendor->name}}</dd>
                                                        <dt class="col-sm-3 text-muted">Submission Date:</dt>
                                                        <dd class="col-sm-9 text-dark " >{{date('M d, Y - h:ma', strtotime($bid->created_at))}} </dd>

                                                        <dt class="col-sm-3 text-muted">Email:</dt>
                                                        <dd class="col-sm-9 text-dark">{{$bid->vendor->email}} </dd>
                                                        <dt class="col-sm-3 text-muted">Phone:</dt>
                                                        <dd class="col-sm-9 text-dark"> {{$bid->vendor->phone ?? "Not Available"}}</dd>
                                                    </dl>

                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-12">

                                                    <dl class="row pt-5">
                                                        <dt class="col-sm-3 text-muted">Directors:&nbsp;</dt>
                                                        <dd class="col-sm-9 text-dark">
                                                          @if (count($bid->vendor->directors)>0)
                                                                @foreach ($bid->vendor->directors as $d)
                                                                    <p class="mb-2">{{$d->name}}</p>
                                                                @endforeach
                                                            @else
                                                              <span>No Directors</span>
                                                            @endif
                                                        </dd>
                                                        <dt class="col-sm-3 text-muted">Previous Jobs:</dt>
                                                        <dd class="col-sm-9 text-dark " >
                                                          @if (count($bid->vendor->experiences)>0)
                                                                @foreach ($bid->vendor->experiences as $e)
                                                                    <dl class="row">
                                                                        <dd class="col-sm-4">{{$e->name}}</dd>
                                                                        <dd class="col-sm-8">{{date('M d, Y', strtotime($e->start))}} - {{date('M d, Y', strtotime($e->end))}}</dd>
                                                                    </dl>@endforeach
                                                            @else
                                                              <span>No Experience</span>
                                                            @endif
                                                        </dd>

                                                        <dt class="col-sm-3 text-muted">Ownership Type:</dt>
                                                        <dd class="col-sm-9 text-dark">{{$bid->vendor->ownership_type}}</dd>
                                                    </dl>

                                                </div>
                                            </div>

                                             <div class="dropdown-divider"></div>


                                          <hr>
                                          <div class="row pt-4">
                                              @if (count($bid->bid_requirements)>0)
                                              <div class="col-12" >
                                              <div class="fs-lg mb-3 text-dark">Applicant Submission:</div>
                                              </div>
                                              @foreach ($bid->bid_requirements as $ar)
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
                                                      <textarea class="form-control" rows="10" disabled>{{$ar->value}}</textarea>
                                                      @endif
                                                    </div>
                                                </div>
                                              @endforeach
                                              @endif

                                          </div>
                                          <hr>
                                            <div class="row pt-4">
                                                @if (count($bid->bid_documents)>0)
                                                    <div class="col-12" >
                                                        <div class="d-sm-block fs-sm mb-3">Document Submitted:</div>
                                                        @foreach ($bid->bid_documents as $bid_doc)
                                                            <div class="input-group">
                                                                <input type="text" disabled class="form-control" value="{{$bid_doc->tender_doc->name}}.pdf">
                                                                <a href="{{route('download_doc', ['id'=>$bid_doc->id])}}" target="blank" class="btn btn-primary">Download</a>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @endif

                                            </div>
                                            @if (count($bid->experiences)>0)
                                            <hr>
                                          {{-- <div class="table w-100 mx-4" style="font-size: 15px;"> --}}
                                            <div class="row pt-4">
                                              <div class="col-sm-6 h6 mb-2">
                                                Experience
                                              </div>
                                              <div class="col-sm-3 h6 mb-2">
                                                Started on
                                              </div>
                                              <div class="col-sm-3 h6 mb-2">
                                                Ended
                                              </div>
                                            </div>
                                            <?php $mmn=1; ?>
                                            @foreach ($bid->experiences as $exp)
                                            <div class="row">
                                              <div class="col-sm-6">
                                                <div class="d-flex align-items-center">
                                                  <div class="ps-3 ps-sm-4">
                                                    <p>{{$exp->role}} @ {{$exp->name}}</p>
                                                    {{-- <div class="text-muted fs-sm me-3"><p class="fw-medium">{{$jm->content}}</p></div> --}}
                                                  </div>
                                                </div>
                                              </div>
                                              <div class="col-sm-3">
                                                {{date('M d, Y', strtotime($exp->start))}}
                                              </div>
                                              <div class="col-sm-3">
                                                @if ($exp->currently == 1)
                                                    <small>Current.</small>
                                                @else
                                                {{date('M d, Y', strtotime($exp->end))}}
                                                @endif
                                              </div>
                                            </div>
                                            <?php $mmn++; ?>
                                            @endforeach
                                            @endif

                                        </div>
                                      </article>
                                  </div>
                              </div>
                          </div>
                          <div class="modal-footer">
                            <button class="btn btn-secondary w-100 w-sm-auto mb-3 mb-sm-0" type="button" data-bs-dismiss="modal">Close</button>
                            <button class="btn btn-primary w-100 w-sm-auto ms-sm-3" data-bs-toggle="modal" data-bs-target="#modalUpdate{{$bid->id}}" type="button">Decision</button>
                          </div>
                        </div>
                      </div>
                    </div>

                    <!-- Modal with tabs and forms -->
<div class="modal" id="modalUpdate{{$bid->id}}"  tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <ul class="nav nav-tabs flex-nowrap text-nowrap mb-n2" role="tablist">
          <li class="nav-item">

              <h3 class="d-none d-sm-inline">Update Application Status</h3>
          </li>
        </ul>
        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body tab-content">
        <form method="POST" action="{{route('update_apply', ['id'=>$bid->id])}}" class="tab-pane fade show active mt-n2" id="signin" autocomplete="off">
            @csrf
            <input type="hidden" name="app_id" value="{{$bid->id}}">
            <div class="mb-3 mb-sm-4">
              <label for="status" class="form-label">Status Label</label>
              <select class="form-control" name="status" id="status">
                  <option value="{{$bid->status}}">{{$bid->status}}</option>
                  <option disabled>--------------------------</option>
                  <option value="Approved">Approved</option>
                  <option value="Queried">Queried</option>
                  <option value="Under Review">Under Review</option>
              </select>
            </div>
          <div class="mb-3 mb-sm-4">
            <label for="comment" class="form-label">Comment</label>
            <textarea type="comment" name="comment" class="form-control" id="comment" placeholder="Write your comment here...."></textarea>
          </div>
          <button type="submit" class="btn btn-primary w-100">Update</button>
        </form>
      </div>
    </div>
  </div>
</div>
                @endforeach
            @else
                <div class="accordion-item border-top mb-0" style="text-align: center">
                  <h5>No application found. Please apply for one</h5>
                </div>
            @endif

          </tbody>
            </table>
        </div>

          {{-- <div class="d-sm-flex align-items-center pt-4 pt-sm-5">
                <nav class="order-sm-2 ms-sm-auto mb-4 mb-sm-0" aria-label="Orders pagination">
                    {{$bids->links()}}
                </nav>
            </div> --}}
        </div>
      </div>
    </div>
@endsection
