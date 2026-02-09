@extends('layouts.app_index')

@section('content')
    <!-- Page content-->
    <div class="col-lg-9 pt-4 pb-2 pb-sm-4">
      <div class="d-flex align-items-center mb-4">
        <h1 class="h2 mb-0">Tenders</h1>
      </div>
      @include('layouts.flash')
      <div class="card border-0 py-1 p-md-2 p-xl-3 p-xxl-4">
          <div class="card-body pb-4">

              <div class="table-responsive">
                  <table class="table">
                      <thead>
                      <tr>
                          <th>Name</th>
                          <th>Status</th>
                          <th>Open</th>
                          <th>Close</th>
                          <th>Action</th>
                      </tr>
                      </thead>

                      <tbody>
            <!-- Order-->
            <?php $a=1;?>
            @if (count($tenders) > 0)
                @foreach ($tenders as $tender)
                <div class="">

                    <tr>

                        <td>{{$tender->name}}</td>
                        <td>
                            @if ($tender->status == 'Open')
                                <span class="badge  fs-xs border bg-primary text-white">Open</span>
                            @elseif ($tender->status == 'Draft')
                                <span class="badge  fs-xs border bg-warning text-white">Draft</span>
                            @elseif ($tender->status == 'Closed')
                                <span class="badge text-nav fs-xs border bg-danger">Closed</span>
                            @endif
                        </td>
                        <td>{{date('M d, Y', strtotime($tender->open_date))}}</td>
                        <td>{{date('M d, Y', strtotime($tender->close_date))}}</td>

                        <td>

                            <a href="{{route('app_job_info', ['id'=>$tender->id])}}" class="nav-link text-normal fs-sm text-success fw-normal py-1 pe-0 ps-1 ms-2">View</a>
                        </td>
                    </tr>


                </div>
                @endforeach
            @else
                <div class="accordion-item border-top mb-0" style="text-align: center">
                  <h5>No tender related to your category found.</h5>
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
