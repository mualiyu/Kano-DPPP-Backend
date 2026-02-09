@extends('layouts.index')

@section('content')
     <!-- Page content-->
          <div class="col-lg-9 pt-4 pb-2 pb-sm-4">
            <h1 class="h2 mb-4">Applicant Profile</h1>
            <!-- Basic info-->
            @include('layouts.flash')
            <section class="card border-0 py-1 p-md-2 p-xl-3 p-xxl-4 mb-4">
              <form action="{{route('admin_app_update_profile', ['id'=> $applicant->id])}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="d-flex align-items-center mt-sm-n1 pb-4 mb-0 mb-lg-1 mb-xl-3"><i class="ai-user text-primary lead pe-1 me-2"></i>
                    <h2 class="h4 mb-0">Profile info</h2>
                    <div class="d-flex ms-auto">
                      @if ($applicant->status=="accepted")
                      <button class="badge text- fs-xs border pt-1" style="background: green; color:white;">Accepted</button> &nbsp;
                      @else
                      <button onclick="event.preventDefault(); window.location.href='/admin/database/accept-aplicant-registration/{{$applicant->id}}';" class="btn btn-sm btn-primary ms-auto" type="button" style="float: right;">Accept Applicant</button> &nbsp;
                      @endif
                      <button onclick="event.preventDefault(); window.location.href='/admin/database/{{$applicant->id}}/applicant/application';" class="btn btn-sm btn-secondary ms-auto" type="button" style="float: right;">View Applied Jobs</button>
                    </div>
                  </div>
                  {{-- <div class="d-flex align-items-center">
                    <div class="dropdown">
                       <a class="d-flex flex-column justify-content-end position-relative overflow-hidden rounded-circle bg-size-cover bg-position-center flex-shrink-0" href="#" data-bs-toggle="dropdown" aria-expanded="false" style="width: 80px; height: 80px; background-image: url({{$applicant->photo}});">
                        <span class="d-block text-light text-center lh-1 pb-1" style="background-color: rgba(0,0,0,.5)"><i class="ai-camera"></i></span>
                      </a>
                      <div class="dropdown-menu my-1">
                        <a class="dropdown-item fw-normal" href="#">
                          <i class="ai-camera fs-base opacity-70 me-2"></i>
                          <input class="form-control form-control-sm" name="image" type="file" placeholder="Upload New Photo">
                        </a>
                        <a class="dropdown-item text-danger fw-normal" href="{{ route('app_delete_profile_pic', ["id"=>$applicant->id]) }}"  onclick="event.preventDefault(); document.getElementById('delete-pic-form').submit();">
                          <i class="ai-trash fs-base me-2"></i>Delete photo
                        </a>
                        </div>
                    </div>
                    <div class="ps-3">
                      <h3 class="h6 mb-1">Profile picture</h3>
                      <p class="fs-sm text-muted mb-0">PNG or JPG no bigger than 1000px wide and tall.</p>
                    </div>
                  </div> --}}
                  <div class="row g-3 g-sm-4 mt-0 mt-lg-2">
                    <div class="col-sm-6">
                      <label class="form-label" for="fn">Name</label>
                      <input class="form-control" type="text" name="name" value="{{$applicant->name}}" id="fn" required>
                    </div>
                    <div class="col-sm-6">
                      <label class="form-label" for="email">Email address</label>
                      <input class="form-control" disabled type="email" value="{{$applicant->email}}" id="email">
                    </div>
                    <div class="{{$applicant->type == "company" ? 'col-sm-6':'col-sm-12'}}">
                      <label class="form-label" for="phone">Phone</label>
                      <input class="form-control" name="phone" value="{{$applicant->phone}}" type="tel" data-format="{&quot;numericOnly&quot;: true, &quot;delimiters&quot;: [&quot;+1 &quot;, &quot; &quot;, &quot; &quot;], &quot;blocks&quot;: [0, 3, 3, 2]}" placeholder="+234 ___ ___ __" id="phone">
                    </div>
                    @if ($applicant->type == "company")
                    <div class="col-sm-6">
                      <label class="form-label" for="cac_number">CAC Number</label>
                      <input class="form-control" name="cac_number" value="{{$applicant->cac_number}}" type="number" placeholder="__ __ __" id="cac_number">
                    </div>
                    @endif

                      <hr>

                     <div class="col-12">
                         <h6 class=" mb-0" style="float: left">Legal Information</h6>
                      <span class="btn btn-primary" style="float: right;" onclick="add_director()">Add</span>
                    </div>
                    <div class="row dirrr">
                      <?php $s =1;?>
                      @if (count($applicant->directors)>0)
                      @foreach ($applicant->directors as $d)
                      <input type="hidden" name="dir_id[{{$s}}]" value="{{$d->id}}">
                      <div class="col-sm-6">
                        <label class="form-label" for="directors">Name</label>
                        <input class="form-control" disabled type="text" value="{{$d->name}}" id="director" name="director[{{$d->id}}]">
                      </div>
                      <?php $s++;?>
                      @endforeach
                      @endif
                    </div>
                    <hr>
                    <div class="col-sm-6">
                      <label class="form-label" for="ownership_type">Ownership Type</label>
                      <input class="form-control" name="ownership_type" value="{{$applicant->ownership_type}}" type="text" placeholder="Ownership type" id="ownership_type">
                    </div>

                    <div class="col-sm-6">
                      <label class="form-label" for="vat_number">Vat Number</label>
                      <input class="form-control" name="vat_number" value="{{$applicant->vat_number}}" type="text" placeholder="Vat number" id="vat_number">
                    </div>
                    <div class="ps-3">
                      <h3 class="h6 mb-1">Contact Address</h3>
                    </div>
                    <div class="col-sm-6">
                      <label class="form-label" for="address">Address</label>
                      <input class="form-control" name="address" value="{{$applicant->address}}" type="text" placeholder="address" id="address">
                    </div>

                    <div class="col-sm-6">
                      <label class="form-label" for="mobile">Mobile</label>
                      <input class="form-control" name="mobile" value="{{$applicant->mobile}}" type="text" placeholder="mobile" id="mobile">
                    </div>



                    <div class="ps-3">
                      <h3 class="h6 mb-1">Business</h3>
                    </div>
                    <div class="col-12">
                      <p class="form-label mb-0" style="float: left">Experience:</p>
                      <span class="btn btn-primary" style="float: right;" onclick="add_experience()">Add</span>
                    </div>


                    <div class="row expp">
                      <?php $r =1;?>
                      @if (count($applicant->experiences)>0)
                      @foreach ($applicant->experiences as $e)
                      <div class="col-sm-4">
                        <input type="hidden" name="exp_id[{{$r}}]" value="{{$e->id}}">
                        <label class="form-label" for="heading">Experience</label>
                        <input disabled class="form-control" type="text" value="{{$e->name}}" id="experience" name="e_name[{{$e->id}}]">
                      </div>
                      <div class="col-sm-4">
                        <label class="form-label" for="heading">Start</label>
                        <input disabled class="form-control" type="date" value="{{$e->start}}" id="start_date" name="start_date[{{$e->id}}]">
                      </div>
                      <div class="col-sm-4">
                        <label class="form-label" for="heading">End</label>
                        <input disabled class="form-control" type="date" value="{{$e->end}}" id="end_date" name="end_date[{{$e->id}}]">
                      </div>
                      <?php $r++;?>
                      @endforeach
                      @endif
                    </div>

                    <div class="col-12 d-flex justify-content-end pt-3">
                      <button class="btn btn-secondary" type="button">Cancel</button>
                      <button class="btn btn-primary ms-3" type="submit">Update changes</button>
                    </div>
                  </div>
                </div>
              </form>
            </section>

            <!-- Delete account-->
            <section class="card border-0 py-1 p-md-2 p-xl-3 p-xxl-4">
              <div class="card-body">
                <div class="d-flex align-items-center pb-4 mt-sm-n1 mb-0 mb-lg-1 mb-xl-3"><i class="ai-trash text-primary lead pe-1 me-2"></i>
                  <h2 class="h4 mb-0">Deactivated account</h2>
                </div>
                <div class="alert alert-warning d-flex mb-4"><i class="ai-triangle-alert fs-xl me-2"></i>
                  <p class="mb-0">When you deactivate this account, His public profile will be deactivated immediately.</p>
                </div>
                <form action="{{route('deactivate_applicant', ['id'=>$applicant->id])}}" method="POST">
                  @csrf
                  <div class="form-check">
                    <input name="confirm_d" class="form-check-input" type="checkbox" id="confirm">
                    <label class="form-check-label text-dark fw-medium" for="confirm">Yes, I want to deactivate this account</label>
                  </div>
                  <div class="d-flex flex-column flex-sm-row justify-content-end pt-4 mt-sm-2 mt-md-3">
                    <button class="btn btn-danger" type="submit"><i class="ai-trash ms-n1 me-2"></i>Deactivate account</button>
                  </div>
                </form>
              </div>
            </section>
          </div>

@endsection
