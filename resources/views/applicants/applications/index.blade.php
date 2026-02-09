@extends('layouts.app_index')

@section('content')
    <!-- Page content-->
    <div class="col-lg-9 pt-4 pb-2 pb-sm-4">
      <div class="d-flex align-items-center mb-4">
        <h1 class="h2 mb-0">My Bids</h1>
      </div>
      @include('layouts.flash')
      <div class="card border-0 py-1 p-md-2 p-xl-3 p-xxl-4">
        <div class="card-body pb-4">
            <div class="table-responsive">
                  <table class="table">
                      <thead>
                      <tr>
                          <th>Tender</th>
                          <th>Status</th>
                          <th>Date Submitted</th>
                          <th>Action</th>
                      </tr>
                      </thead>
                      <tbody>
            <?php $a=1;?>
            @if (count($applications) > 0)
                @foreach ($applications as $app)
                     <tr>
                        <td>{{$app->job->name}}</td>
                        <td>
                            @if ($app->status == 'Accepted')
                                <span class="badge  fs-xs border bg-primary text-white">{{$app->status}}</span>
                            @elseif ($app->status == 'Approved')
                                <span class="badge  fs-xs border bg-info text-white">{{$app->status}}</span>
                            @elseif ($app->status == 'Rejected')
                                <span class="badge  fs-xs border bg-danger text-white">{{$app->status}}</span>
                            @else
                                <span class="badge text-nav fs-xs border bg-warning">{{$app->status}}</span>
                            @endif
                        </td>
                        <td>{{date('M d, Y', strtotime($app->created_at))}}</td>
                        <td>
                            <a href="{{route('app_application_info', ['id'=>$app->id])}}" class="nav-link text-normal fs-sm text-success fw-normal py-1 pe-0 ps-1 ms-2">View</a>
                        </td>
                    </tr>
                @endforeach
            @else
                <div class="accordion-item border-top mb-0" style="text-align: center">
                  <h5>No application found. Please apply for one</h5>
                </div>
            @endif
            </tbody>
                  </table>
          </div>
        </div>

          <div class="d-sm-flex align-items-center pt-4 pt-sm-5">
                <nav class="order-sm-2 ms-sm-auto mb-4 mb-sm-0" aria-label="Orders pagination">
                    {{$applications->links()}}
                </nav>
            </div>
        </div>
      </div>
    </div>
@endsection
