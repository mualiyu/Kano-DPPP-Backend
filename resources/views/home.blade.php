@extends('layouts.index')

@section('content')
<!-- Page content-->
<div class="col-lg-9 pt-4 pb-2 pb-sm-4">
  <h1 class="h3 mb-4">Welcome to Digital Public Procurement Platform</h1>
  <!-- Basic info-->
  <section class="card border-0 py-1 p-md-2 p-xl-3 p-xxl-4 mb-4">
    <div class="card-body">

        <div class="row g-3 g-xl-4">
            <div class="col-md-4 col-sm-6">
                <div class="h-100 bg-secondary rounded-3 text-center p-4">
                    <h2 class="h6 pb-2 mb-1">Bids</h2>
                    <div class="h2 text-primary mb-2">{{$t_bids ? count($t_bids) : 0}}</div>
                    {{-- <p class="fs-sm text-muted mb-0">Total bids submitted</p> --}}
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="h-100 bg-secondary rounded-3 text-center p-4">
                    <h2 class="h6 pb-2 mb-1">Tenders</h2>
                    <div class="h2 text-primary mb-2">{{$t_tenders ? count($t_tenders) : 0}}</div>
                    {{-- <p class="fs-sm text-muted mb-0">Total tenders published</p> --}}
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="h-100 bg-secondary rounded-3 text-center p-4">
                    <h2 class="h6 pb-2 mb-1">Vendors</h2>
                    <div class="h2 text-primary mb-2">{{$t_vendors ? count($t_vendors) : 0}}</div>
                    {{-- <p class="fs-sm text-muted mb-0">Registered vendors</p> --}}
                </div>
            </div>
        </div>

    </div>
  </section>
@include('layouts.flash')
  <!-- Tenders-->
  <section class="card border-0 py-1 p-md-2 p-xl-3 p-xxl-4">
    <div class="card-body">
      <div class="d-flex align-items-center mt-sm-n1 pb-4 mb-0 mb-lg-1 mb-xl-3">
        {{-- <i class="ai-cart text-primary lead pe-1 me-2"></i> --}}
        <h2 class="h4 mb-0">Recent Tenders</h2>
        <a class="btn btn-sm btn-secondary ms-auto" href="{{route('jobs')}}">View all</a>
      </div>

         <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Opening Date</th>
                        <th>Closing Date</th>
                        <th>Action</th>
                    </tr>
                    </thead>


                    <tbody>


        <?php $a=1;?>
            @if ($tenders && count($tenders) > 0)
                @foreach ($tenders as $tender)

                    <tr>

                        <td>{{$tender->name}}</td>
                        <td>
                            @if ($tender->status == 'open')
                                <span class="badge  fs-xs border bg-primary text-white">Open</span>
                            @elseif ($tender->status == 'draft')
                                <span class="badge  fs-xs border bg-warning text-white">Draft</span>
                            @elseif ($tender->status == 'closed')
                                <span class="badge text-nav fs-xs border bg-danger">Closed</span>
                            @elseif ($tender->status == 'awarded')
                                <span class="badge text-nav fs-xs border bg-success">Awarded</span>
                            @endif
                        </td>
                        <td>{{$tender->opening_date ? date('M d, Y', strtotime($tender->opening_date)) : 'N/A'}}</td>
                        <td>{{$tender->closing_date ? date('M d, Y', strtotime($tender->closing_date)) : 'N/A'}}</td>

                        <td>
                            <a onclick="event.preventDefault(); window.location.href='/admin/jobs/{{$tender->id}}/job-info';" class="nav-link text-default fs-sm fw-normal text-primary py-1 pe-0 ps-1 ms-2" type="button" data-bs-toggle="tooltip" aria-label="View">
                                View
                            </a>
                            <a onclick="event.preventDefault(); window.location.href='/admin/jobs/{{$tender->id}}/edit-job';" class="nav-link text-default fs-sm fw-normal text-info py-1 pe-0 ps-1 ms-2" type="button" data-bs-toggle="tooltip" aria-label="View">
                                Edit
                            </a>
                        </td>
                    </tr>

                @endforeach
            @else
                <div class=" mb-0" style="text-align: center">
                  <h5>No Tenders Yet</h5>
                </div>
            @endif
            </tbody>
            </table>
        </div>

      {{-- </div> --}}
    </div>
  </section>
</div>
@endsection
