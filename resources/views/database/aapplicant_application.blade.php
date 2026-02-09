@extends('layouts.index')

@section('content')
    <!-- Page content-->
    <div class="col-lg-9 pt-4 pb-2 pb-sm-4">
      <div class="d-flex align-items-center mb-4">
        {{-- <h1 class="h2 mb-0">Bids</h1> --}}
        {{-- <select class="form-select ms-auto" style="max-width: 200px;">
          <option value="All tme">For all time</option>
          <option value="Last week">Last week</option>
          <option value="Last month">Last month</option>
          <option value="Last month">Last month</option>
          <option value="In progress">In progress</option>
          <option value="Canceled">Canceled</option>
          <option value="Delivered">Delivered</option>
        </select> --}}
      </div>
      <div class="card border-0 py-1 p-md-2 p-xl-3 p-xxl-4">
        <div class="card-body pb-4">
          <div class="d-flex align-items-center mt-sm-n1 pb-4 mb-0 mb-lg-1 mb-xl-3">
            {{-- <i class="ai-cart text-primary lead pe-1 me-2"></i> --}}
           <h4 class="h3 mb-0">List of Bids from {{$applicant->name}}</h4>
            {{-- <a class="btn btn-sm btn-secondary ms-auto" style="float: right;" href="{{route('show_create_job')}}">Create Job</a> --}}
          </div>
          <!-- Orders accordion-->
          <div class="accordion accordion-alt accordion-orders" id="orders">

            <!-- Order-->
            <?php $a=1;?>
            @if (count($applications) > 0)
                @foreach ($applications as $app)
                <div class="accordion-item border-top mb-0">
                  <div class="accordion-header"><a class="accordion-button d-flex fs-4 fw-normal text-decoration-none py-3 collapsed" href="#orderOne" data-bs-toggle="collapse" aria-expanded="false" aria-controls="orderOne">
                      <div class="d-flex justify-content-between w-100" style="max-width: 750px;">
                        <div class="me-3 me-sm-3">
                          <div class="fs-sm text-muted mb-2">Job Title</div>
                          <div class="fs-sm fw-medium text-dark">{{$app->job->name}}</div>
                        </div>
                        <div class="me-3 me-sm-3">
                          <div class="fs-sm text-muted">Application Status</div>
                          <span class="badge bg-{{$app->status == 'Approved' ? 'faded-info':'warning'}} text-info fs-xs">{{$app->status}}</span>
                        </div>
                        <div class="me-3 me-sm-3">
                          <div class="d-none d-sm-block fs-sm text-muted mb-2">Docs Required</div>
                          <div class="d-sm-none fs-sm text-muted mb-2">docs</div>
                          <div class="fs-sm fw-medium text-dark">
                              @if (count($app->job->job_docs)>0)
                                  @foreach ($app->job->job_docs as $d)
                                  <span>{{$d->name}}, </span>
                                  @endforeach
                              @endif
                        </div>
                        </div>
                        <div class="me-3 me-sm-3">
                          <div class="d-none d-sm-block fs-sm text-muted mb-2">Date</div>
                          <div class="d-sm-none fs-sm text-muted mb-2">Docs</div>
                          <div class="fs-sm fw-medium text-dark">
                              {{$app->job->date}}
                          </div>
                        </div>
                      </div>
                      <div class="accordion-button-img d-none d-sm-flex ms-auto">
                         <button data-bs-toggle="modal" data-bs-target="#modalId{{$app->id}}" class="nav-link text-normal fs-xl fw-normal py-1 pe-0 ps-1 ms-2" data-bs-toggle="tooltip" aria-label="Edit"><i class="ai-edit-alt"></i></button>

                      </div>
                    </a>
                    </div>

                    <div class="modal fade" id="modalId{{$app->id}}" tabindex="-1" role="dialog">
                      <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title">{{$app->job->name}}</h4>
                            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <article class="card border-0 bg-default">
                              <div class="card-body pb-4">
                                <div class="d-flex align-items-center mb-4 mt-n1">
                                  <span class="fs-sm text-muted">{{date('M d, Y', strtotime($app->job->open_date))}} .</span>
                                  <span class="fs-sm text-muted"> To  {{date('M d, Y', strtotime($app->job->close_date))}}</span>
                                  <span class="fs-xs opacity-20 mx-3">|</span>
                                  <a href="#" class="badge text-nav fs-xs border">{{$app->job->status}}</a>
                                </div>
                                @foreach ($app->job->business_sub_categories as $bsc)
                                <div>
                                      <p>{{$bsc->name}}</p>
                                </div>
                                @endforeach
                                @if ($app->job->job_contents)
                                    @foreach ($app->job->job_contents as $jc)
                                    <h3 class="h4 card-title" style="font-size: 20px;">
                                      <a href="#">{{$jc->heading}}</a>
                                    </h3>
                                    <p class="card-text" style="font-size: 15px;">{{$jc->content}}</p>
                                    @endforeach
                                    @endif
                                </div>
                                <div class="table-responsive w-50 mx-4">
                                  <table class="table">
                                    <thead>
                                      <tr>
                                        <th>#</th>
                                        <th>MileStone</th>
                                        <th>Due Date</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      @if ($app->job->job_milestones)
                                        @foreach ($app->job->job_milestones as $jm)
                                      <tr>
                                        <th scope="row">1</th>
                                        <td class="border-0 py-1 px-0">
                                          <div class="d-flex align-items-center">
                                            <div class="ps-3 ps-sm-4">
                                              <h4 class="h6 mb-2"><a href="shop-single.html">{{$jm->heading}}</a></h4>
                                              <div class="text-muted fs-sm me-3"><p class="text-dark fw-medium">{{$jm->content}}</p></div>
                                            </div>
                                          </div>
                                        </td>
                                        <td>{{date('M d, Y', strtotime($jm->due_date))}}</td>
                                      </tr>
                                       @endforeach
                                    @endif
                                    </tbody>
                                  </table>
                                </div>
                                <div class="row">
                                    @if ($app->job->job_docs)
                                    <div class="col-6">
                                        <div class="d-none d-sm-block fs-sm mb-2">Document Required for The Job</div>
                                        <ul class="list-group list-group-horizontal-sm">
                                            @foreach ($app->job->job_docs as $jdoc)
                                            <li class="list-group-item">{{$jdoc->name}}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @endif
                                    @if ($app->job->job_docs)
                                    <div class="col-6">
                                        <div class="d-none d-sm-block fs-sm mb-2">Document Submited</div>
                                        <ul class="list-group list-group-horizontal-sm">
                                            @foreach ($app->application_documents as $app_doc)
                                            <li class="list-group-item">{{$app_doc->job_doc->name}}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @endif
                                </div>
                            </article>
                          </div>
                          <div class="modal-footer">
                            <button class="btn btn-secondary w-100 w-sm-auto mb-3 mb-sm-0" type="button" data-bs-dismiss="modal">Close</button>
                            <a class="btn btn-primary w-100 w-sm-auto ms-sm-3" href="{{route('show_apply_job', ['id'=>$app->id])}}" type="button">Cancel Application</a>
                          </div>
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

          </div>
          <!-- Pagination-->
          {{-- <div class="d-sm-flex align-items-center pt-4 pt-sm-5">
            <nav class="order-sm-2 ms-sm-auto mb-4 mb-sm-0" aria-label="Orders pagination">
              <ul class="pagination pagination-sm justify-content-center">
                <li class="page-item active" aria-current="page"><span class="page-link">1<span class="visually-hidden">(current)</span></span></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">4</a></li>
              </ul>
            </nav>
          </div> --}}
        </div>
      </div>
    </div>
@endsection
