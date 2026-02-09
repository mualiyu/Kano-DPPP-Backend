@extends('layouts.index')

@section('content')
    <!-- Page content-->
    <div class="col-lg-9 pt-4 pb-2 pb-sm-4">
      <div class="d-flex align-items-center mb-4">
        <h1 class="h2 mb-0">Tenders</h1>

          <div class="ms-auto">

              <a class="btn btn-sm btn-primary ms-auto" style="float: right;" href="{{route('show_create_job')}}">Create new tender</a>
          </div>

      </div>
      @include('layouts.flash')
      <div class="card border-0 py-1 p-md-2 p-xl-3 p-xxl-4">
        <div class="card-body pb-4">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Tender Number</th>
                        <th>Name</th>
                        <th>MDA</th>
                        <th>Status</th>
                        <th>Open</th>
                        <th>Close</th>
                        <th>Action</th>
                    </tr>
                    </thead>


                    <tbody>

            <?php $a=1;?>
            @if (count($jobs) > 0)
                @foreach ($jobs as $job)


                    <tr>
                        <td>
                            <span class="badge bg-secondary">{{$job->tender_number ?? 'N/A'}}</span>
                        </td>
                        <td>{{$job->name}}</td>
                        <td>{{$job->mda->name ?? 'N/A'}}</td>
                        <td>
                            @if ($job->status == 'Open')
                                <span class="badge  fs-xs border bg-primary text-white">Open</span>
                            @elseif ($job->status == 'Draft')
                                    <span class="badge  fs-xs border bg-warning text-white">Draft</span>
                            @elseif ($job->status == 'Closed')
                                <span class="badge text-nav fs-xs border bg-danger">Closed</span>
                            @endif
                        </td>
                        <td>{{date('M d, Y', strtotime($job->open_date))}}</td>
                        <td>{{date('M d, Y', strtotime($job->close_date))}}</td>

                        <td>
                            <a onclick="event.preventDefault(); window.location.href='/admin/jobs/{{$job->id}}/job-info';" class="nav-link text-default fs-sm fw-normal text-primary py-1 pe-0 ps-1 ms-2" type="button" data-bs-toggle="tooltip" aria-label="View">
                                View
                            </a>
                            <a onclick="event.preventDefault(); window.location.href='/admin/jobs/{{$job->id}}/edit-job';" class="nav-link text-default fs-sm fw-normal text-info py-1 pe-0 ps-1 ms-2" type="button" data-bs-toggle="tooltip" aria-label="View">
                                Edit
                            </a>
                            <a onclick="event.preventDefault(); if(window.confirm('Note: If you proceed, this will delete {{$job->name}} Tender together with its Bids.\n\n{{count($job->bids)}} bids will be deleted. \n\nThank you!')){document.getElementById('delete-form-{{$a}}').submit()};" class="nav-link text-danger fs-sm fw-normal text-primary py-1 pe-0 ps-1 ms-2" type="button" data-bs-toggle="tooltip" aria-label="delete">
                                Delete
                            </a>
                            <form id="delete-form-{{$a}}" action="{{ route('delete_job', ['job'=>$job->id]) }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </td>
                    </tr>
                    <?php $a++;?>
                @endforeach
            @else
                <div class="  mb-0" style="text-align: center">
                    <h5>No Tenders Posted Yet</h5>
                </div>
            @endif


            </tbody>
            </table>
        </div>


          <div class="d-sm-flex align-items-center pt-4 pt-sm-5">
                <nav class="order-sm-2 ms-sm-auto mb-4 mb-sm-0" aria-label="Orders pagination">
                    {{$jobs->links()}}
                </nav>
            </div>

        </div>
      </div>

    </div>


@endsection
