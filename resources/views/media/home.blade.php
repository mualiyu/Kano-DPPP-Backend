@extends('layouts.m_index')

@section('content')
<!-- Page content-->
<div class="col-lg-9 pt-4 pb-2 pb-sm-4">
  <h3 class="h3 mb-4">Welcome to Kano State E-Procurement Media Portal</h3>
  <!-- Basic info-->
 
  @include('layouts.flash')
 
  <!-- Orders-->
  <section class="card border-0 py-1 p-md-2 p-xl-3 p-xxl-4">
    <div class="card-body">
      <div class="d-flex align-items-center mt-sm-n1 pb-4 mb-0 mb-lg-1 mb-xl-3">
        <h2 class="h4 mb-0">News</h2>
      </div>
      <!-- Orders accordion-->
      <div class="accordion accordion-alt accordion-orders" id="orders">
        <!-- Order-->
            {{-- @if (count($jobs) > 0)
                @foreach ($jobs as $j)
                <div class="accordion-item border-top mb-0">
                  <div class="accordion-header"><a class="accordion-button d-flex fs-4 fw-normal text-decoration-none py-3 collapsed" href="#orderOne" data-bs-toggle="collapse" aria-expanded="false" aria-controls="orderOne">
                      <div class="d-flex justify-content-between w-100" style="max-width: 550px;">
                        <div class="me-3 me-sm-3">
                          <div class="fs-sm text-muted mb-2">Title</div>
                          <div class="fs-sm fw-medium text-dark">{{$j->name}}</div>
                        </div>
                        <div class="me-3 me-sm-3">
                          <div class="fs-sm text-muted">Status</div>
                          <span class="badge bg-faded-info text-info fs-xs">{{$j->status}}</span>
                        </div>
                        <div class="me-3 me-sm-3">
                          <div class="d-none d-sm-block fs-sm text-muted mb-2">Open date</div>
                          <div class="d-sm-none fs-sm text-muted mb-2">Date</div>
                          <div class="fs-sm fw-medium text-dark">{{date('M d, Y', strtotime($j->open_date))}}</div>
                        </div>
                        <div class="me-3 me-sm-3">
                          <div class="d-none d-sm-block fs-sm text-muted mb-2">Close date</div>
                          <div class="d-sm-none fs-sm text-muted mb-2">Date</div>
                          <div class="fs-sm fw-medium text-dark">{{date('M d, Y', strtotime($j->close_date))}}</div>
                        </div>
                      </div>
                      <div class="accordion-button-img d-none d-sm-flex ms-auto">
                        <button data-bs-toggle="modal" data-bs-target="#modalId{{$j->id}}" class="nav-link text-normal fs-xl fw-normal py-1 pe-0 ps-1 ms-2" data-bs-toggle="tooltip" aria-label="Edit"><i class="ai-edit-alt"></i></button>
                        <button onclick="event.preventDefault(); document.getElementById('b-form').submit();" class="nav-link text-danger fs-xl fw-normal py-1 pe-0 ps-1 ms-2" type="button" data-bs-toggle="tooltip" aria-label="Delete"><i class="ai-trash"></i></button>


                      </div>
                    </a>
                    </div>

                    <div class="modal fade" id="modalId{{$j->id}}" tabindex="-1" role="dialog">
                      <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title">{{$j->name}}</h4>
                            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <article class="card border-0 bg-secondary">
                              <div class="card-body pb-4">
                                <div class="d-flex align-items-center mb-4 mt-n1">
                                  <span class="fs-sm text-muted">{{date('M d, Y', strtotime($j->open_date))}} .</span>
                                  <span class="fs-sm text-muted"> To  {{date('M d, Y', strtotime($j->close_date))}}</span>
                                  <span class="fs-xs opacity-20 mx-3">|</span>
                                  <a href="#" class="badge text-nav fs-xs border">{{$j->status}}</a>
                                </div>
                                @if ($j->job_contents)
                                    @foreach ($j->job_contents as $jc)
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
                                      @if ($j->job_contents)
                                        @foreach ($j->job_milestones as $jm)
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
                            </article>
                          </div>
                          <div class="modal-footer">
                            <button class="btn btn-secondary w-100 w-sm-auto mb-3 mb-sm-0" type="button" data-bs-dismiss="modal">Close</button>
                            <button class="btn btn-primary w-100 w-sm-auto ms-sm-3" type="button">Edit Job</button>
                          </div>
                        </div>
                      </div>
                    </div>

                </div>
                @endforeach
            @else
                <div class="accordion-item border-top mb-0" style="text-align: center">
                  <h5>No Tenders Yet</h5>
                </div>
            @endif --}}

      </div>
    </div>
  </section>
</div>
@endsection
