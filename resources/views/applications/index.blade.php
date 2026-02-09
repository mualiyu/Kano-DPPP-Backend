@extends('layouts.index')

@section('content')
    <!-- Page content-->
    <div class="col-lg-9 pt-4 pb-2 pb-sm-4">
      <div class="d-flex align-items-center mb-4">
        <h1 class="h2 mb-0">Bids</h1>

          <div class="ms-auto">

              {{-- <a class="btn btn-sm btn-primary ms-auto" style="float: right;" href="{{route('show_create_job')}}">Create new job</a> --}}
          </div>

      </div>
      @include('layouts.flash')
      <div class="card border-0 py-1 p-md-2 p-xl-3 p-xxl-4">
        <div class="card-body pb-4">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Tender Name</th>
                        <th>Bids</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>


                    <tbody>

            <?php $a=1;?>
            @if (count($tenders) > 0)
                @foreach ($tenders as $tender)
                        @if (count($tender->bids)>0)
                        <tr>
                            <td>{{$tender->name}}</td>
                            <td>{{count($tender->bids)}}</td>
                            <td>
                                @if ($tender->status == 'Open')
                                    <span class="badge  fs-xs border bg-primary text-white">Open</span>
                                @elseif ($tender->status == 'Draft')
                                    <span class="badge  fs-xs border bg-warning text-white">Draft</span>
                                @elseif ($tender->status == 'Closed')
                                    <span class="badge text-nav fs-xs border bg-danger">Closed</span>
                                @endif
                            </td>
                            <td>
                                <a onclick="event.preventDefault(); window.location.href='/admin/applications/{{$tender->id}}/job';" class="nav-link text-default fs-sm fw-normal text-primary py-1 pe-0 ps-1 ms-2" type="button" data-bs-toggle="tooltip" aria-label="View">
                                    View
                                </a>
                            </td>
                        </tr>
                        @endif

                @endforeach
            @else
                <div class="  mb" style="text-align: center">
                    <h5>No applied jobs</h5>
                </div>
            @endif


            </tbody>
            </table>
        </div>


          <div class="d-sm-flex align-items-center pt-4 pt-sm-5">
                <nav class="order-sm-2 ms-sm-auto mb-4 mb-sm-0" aria-label="Orders pagination">
                    {{$tenders->links()}}
                </nav>
            </div>

        </div>
      </div>

    </div>
@endsection
