@extends('layouts.index')

@section('content')
    <!-- Page content-->
    <div class="col-lg-9 pt-4 pb-2 pb-sm-4">
      <div class="d-flex align-items-center mb-4">
        <h1 class="h2 mb-0">Vendors</h1>

      </div>
      @include('layouts.flash')
      <div class="card border-0 py-1 p-md-2 p-xl-3 p-xxl-4">
        <div class="card-body pb-4">
          <div class="d-flex align-items-center mt-sm-n1 pb-4 mb-0 mb-lg-1 mb-xl-3">

          </div>

        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Type</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
                <?php $i=1;?>
                @if (count($applicants) > 0)
                    @foreach ($applicants as $a)
                    <tr>
                      <th scope="row">{{$i}}</th>
                      <td>{{$a->name}}</td>
                      <td>{{$a->email}}</td>
                      <td>{{$a->phone}}</td>
                      <td>{{$a->type}}</td>
                      <td>
                          @if ($a->status == 'accepted')
                          <span class="badge text-white fs-xs border bg-primary">Accepted</span>
                          @else
                          <span class="badge text-nav fs-xs border bg-warning">Await</span>
                          @endif
                      </td>
                      <td>
                          <a href="{{route('admin_applicant_profile', ['id'=>$a->id])}}" class="nav-link text-default fs-xl fw-normal py-1 pe-0 ps-1 ms-2" type="button" data-bs-toggle="tooltip" aria-label="View">
                              <i class="ai-edit"></i>
                          </a>
                      </td>
                  </tr>
                  <?php $i++; ?>
                    @endforeach
                @else
                    <div class="accordion-item border-top mb-0" style="text-align: center">
                      <h5>No Applicants Yet</h5>
                    </div>
                @endif
            </tbody>
          </table>
        </div>

                  <!-- Pagination-->
                  <div class="d-sm-flex align-items-center pt-4 pt-sm-5">
                    <nav class="order-sm-2 ms-sm-auto mb-4 mb-sm-0" aria-label="Orders pagination">
                      {{-- <ul class="pagination pagination-sm justify-content-center">
                        <li class="page-item active" aria-current="page"><span class="page-link">1<span class="visually-hidden">(current)</span></span></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">4</a></li>
                      </ul> --}}
                      {{$applicants->links()}}
                    </nav>

                  </div>
                </div>
              </div>
            </div>
@endsection
