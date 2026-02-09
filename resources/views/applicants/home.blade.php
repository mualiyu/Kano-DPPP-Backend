@extends('layouts.app_index')

@section('content')
<!-- Page content-->
<div class="col-lg-9 pt-4 pb-2 pb-sm-4">
  <h3 class="h3 mb-4">Welcome to Kano State E-Procurement Vendor Portal</h3>
  <!-- Basic info-->
  <?php
  $per = 0;
  if (!$applicant->name == Null) {
    $per = $per + 11.11;
  }
  if (!$applicant->email == Null) {
    $per = $per + 11.11;
  }
  if (!$applicant->phone == Null) {
    $per = $per + 11.11;
  }
  if (!$applicant->ownership_type == Null) {
    $per = $per + 11.11;
  }
  if (!$applicant->directors == Null) {
    $per = $per + 11.11;
  }
  if (!$applicant->vat_number == Null) {
    $per = $per + 11.11;
  }
  if (!$applicant->address == Null) {
    $per = $per + 11.11;
  }
  if (!$applicant->mobile == Null) {
    $per = $per + 11.11;
  }
  // if (!$applicant->photo == url('/storage/applicant/default.png')) {
  //   $per = $per + 11.11;
  // }
  $per = $per + 11.12;
  ?>
  @include('layouts.flash')
  <section class="card border-0 py-1 p-md-2 p-xl-3 p-xxl-4 mb-4">
    <div class="card-body">
      <div class="d-flex align-items-center mt-sm-n1 pb-4 mb-0 mb-lg-1 mb-xl-3">
        <h2 class="h4 mb-0">{{$applicant->name}}</h2><a class="btn btn-sm btn-secondary ms-auto" href="{{route('app_profile')}}"><i class="ai-edit ms-n1 me-2"></i>Edit info</a>
      </div>
      <div class="d-md-flex align-items-center mb-3">
        <div class="d-sm-flex align-items-center">
          <div class="pt-3 pt-sm-0 ps-sm-">
              <table class="table mb-0">
                  <tr>
                      <td class="border-0 text-muted py-1 px-0">Email:</td>
                      <td class="border-0 text-dark fw-medium py-1 ps-3">{{$applicant->email}}</td>
                  </tr>

                  <tr>
                      <td class="border-0 text-muted py-1 px-0">Phone:</td>
                      <td class="border-0 text-dark fw-medium py-1 ps-3">{{$applicant->phone}}</td>
                  </tr>
                  <tr>
                      <td class="border-0 text-muted py-1 px-0">Address:</td>
                      <td class="border-0 text-dark fw-medium py-1 ps-3">{{$applicant->address ?? "No Address"}}</td>
                  </tr>
                  @if ($applicant->type == 'company')
                  <tr>
                      <td class="border-0 text-muted py-1 px-0">Ownership type:</td>
                      <td class="border-0 text-dark fw-medium py-1 ps-3">{{$applicant->ownership_type ?? "No Address"}}</td>
                  </tr>
                  @endif


              </table>
          </div>
        </div>
        <div class="w-100 pt-3 pt-md-0 ms-md-auto" style="max-width: 212px;">
          <div class="d-flex justify-content-between fs-sm pb-1 mb-2">Profile completion<strong class="ms-2">{{$per}}%</strong></div>
          <div class="progress" style="height: 5px;">
            <div class="progress-bar" role="progressbar" style="width: {{$per}}%" aria-valuenow="{{$per}}" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
        </div>

      </div>
        <hr>
      <div class="row py-4 mb-2 mb-sm-3 pt-3">
        <div class="col-md-12 mb-4 mb-md-0">

            <dl class="row">
              @if ($applicant->type == 'company')
              <dt class="col-sm-3">Directors:</dt>
              <dd class="col-sm-9">
                  @if (count($applicant->directors)>0)
                      @foreach ($applicant->directors as $d)
                          <p class="mb-1">{{$d->name}}</p>
                      @endforeach
                  @else
                      <span>No Directors</span>
                  @endif
              </dd>
              <dt class="col-sm-3">Previous Engagements:</dt>
              <dd class="col-sm-9">
                  @if (count($applicant->experiences)>0)
                      @foreach ($applicant->experiences as $e)
                          <p class="mb-1"><span class="bold text-dark">{{$e->name}} </span>({{date('M d, Y', strtotime($e->start))}} - {{date('M d, Y', strtotime($e->end))}}) </p>
                      @endforeach
                  @else
                      <span>No Experience</span>
                  @endif
              </dd>
              @endif

            </dl>
        </div>
      </div>
      {{-- <div class="alert alert-info d-flex mb-0" role="alert"><i class="ai-circle-info fs-xl"></i>
        <div class="ps-2">Fill in the information 100% to receive more suitable offers.<a class="alert-link ms-1" href="account-settings.html">Go to settings!</a></div>
      </div> --}}
    </div>
  </section>

  <!-- Orders-->
  <section class="card border-0 py-1 p-md-2 p-xl-3 p-xxl-4">
    <div class="card-body">
      <div class="d-flex align-items-center mt-sm-n1 pb-4 mb-0 mb-lg-1 mb-xl-3">
        <h2 class="h4 mb-0">My Bids</h2>
      </div>
      <!-- Orders accordion-->
      {{-- <div class="accordion accordion-alt accordion-orders" id="orders">
      </div> --}}
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
                            @if ($app->status == 'Approved')
                                <span class="badge  fs-xs border bg-primary text-white">{{$app->status}}</span>
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
                  <h5>No bids found. Please submit one.</h5>
                </div>
            @endif

            </tbody>
                  </table>

          </div>
    </div>
  </section>
</div>
@endsection
