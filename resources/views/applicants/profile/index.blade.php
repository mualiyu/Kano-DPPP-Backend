@extends('layouts.app_index')

@section('content')
     <!-- Page content-->
          <div class="col-lg-9 pt-4 pb-2 pb-sm-4">
            <h1 class="h2 mb-4">Profile</h1>
            <!-- Basic info-->
            @include('layouts.flash')
            <section class="card border-0 py-1 p-md-2 p-xl-3 p-xxl-4 mb-4">
              <form action="{{route('app_update_profile')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="d-flex align-items-center mt-sm-n1 pb-4 mb-0 mb-lg-1 mb-xl-3">
                    <i class="ai-user text-primary lead pe-1 me-2"></i>
                    <h2 class="h4 mb-0">Profile info</h2>
                  </div>
                  {{-- <div class="d-flex align-items-center">
                    <div class="dropdown">
                      <a class="d-flex flex-column justify-content-end position-relative overflow-hidden rounded-circle bg-size-cover bg-position-center flex-shrink-0" href="#" data-bs-toggle="dropdown" aria-expanded="false" style="width: 80px; height: 80px; background-image: url({{$applicant->photo}});">
                        <span class="d-block text-light text-center lh-1 pb-1" style="background-color: rgba(0,0,0,.5)"><i class="ai-camera"></i></span>
                      </a>
                      <div class="dropdown-menu my-1">
                        <a class="dropdown-item fw-normal" href="#">
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
                      <label class="form-label" for="cac_number">Company Registration Number</label>
                      <input class="form-control" name="cac_number" value="{{$applicant->cac_number}}" type="number" placeholder="Company Registration Number" id="cac_number">
                    </div>
                    <div class="col-sm-12 ">
                        <label class="form-label" for="ownership_type">Ownership Type</label>
                        <input class="form-control" name="ownership_type" value="{{$applicant->ownership_type}}" type="text" placeholder="Limited Liability Company" id="ownership_type">
                    </div>

                    {{-- <div class="col-sm-6">
                        <label class="form-label" for="vat_number">Vat Number</label>
                        <input class="form-control" name="vat_number" value="{{$applicant->vat_number}}" type="text" placeholder="Vat number" id="vat_number">
                    </div> --}}
                    @endif

                    <?php $s =1;?>
                    @if ($applicant->type == "company")
                    <div class="col-12 pb-0 pt-3">
                        <h6 class=" mb-0" style="float: left">Legal Information</h6>
                        <span class="btn btn-primary" style="float: right;" onclick="add_director()">Add Director</span>
                    </div>
                  <div class="row dirrr pb-">
                    @if (count($applicant->directors)>0)
                    @foreach ($applicant->directors as $d)
                    <input type="hidden" name="dir_id[{{$s}}]" value="{{$d->id}}">
                    <div class="col-sm-6 mb-5">
                      <label class="form-label" for="directors">Director's Name</label>
                      <input class="form-control" type="text" value="{{$d->name}}" id="director" name="director[{{$d->id}}]">
                    </div>
                    <?php $s++;?>
                    @endforeach
                    @endif
                  </div>
                    @endif


                    <div class="">
                      <h3 class="h6 mb-1 pt-">Contact Address</h3>
                    </div>
                    <div class="col-sm-6">
                      <label class="form-label" for="address">Address</label>

                        <input class="form-control" name="address" value="{{$applicant->address}}" type="text"  rows="10" placeholder="address" id="address">
                    </div>

                    <div class="col-sm-6">
                      <label class="form-label" for="mobile">Mobile</label>
                      <input class="form-control" name="mobile" value="{{$applicant->mobile}}" type="text" placeholder="mobile" id="mobile">
                    </div>

                    <?php $r =1;?>
                    @if ($applicant->type == "company")
                    <div class="col-12 pb-3 pt-3">
                        <h6 class=" mb-0" style="float: left">Previous Jobs</h6>
                        <span class="btn btn-primary" style="float: right;" onclick="add_experience()">Add Previous Jobs</span>
                    </div>

                  <div class="row expp">
                    @if (count($applicant->experiences)>0)
                    @foreach ($applicant->experiences as $e)
                    <div class="col-sm-4 mb-3">
                      <input type="hidden" name="exp_id[{{$r}}]" value="{{$e->id}}">
                      <label class="form-label" for="heading">Experience:</label>
                      <input class="form-control" type="text" value="{{$e->name}}" id="experience" name="e_name[{{$e->id}}]">
                    </div>
                    <div class="col-sm-4">
                      <label class="form-label" for="heading">Start</label>
                      <input class="form-control" type="date" value="{{$e->start}}" id="start_date" name="start_date[{{$e->id}}]">
                    </div>
                    <div class="col-sm-4">
                      <label class="form-label" for="heading">End</label>
                      <input class="form-control" type="date" value="{{$e->end}}" id="end_date" name="end_date[{{$e->id}}]">
                    </div>
                    <?php $r++;?>
                    @endforeach
                    @endif
                  </div>
                    @endif
                    <hr>
                    {{-- <div class="col-sm-12">
                      <label class="form-label" for="address">Business Category</label>
                      <select name="b_category" class="form-control" id="">
                        <option value="{{$applicant->b_category_id}}" selected>{{$applicant->business_category->name}}</option>
                        @foreach ($b_categories as $b)
                            <option value="{{$b->id}}">{{$b->name}}</option>
                        @endforeach
                      </select>
                    </div> --}}

                    <div class="col-12 d-flex justify-content-end pt-3">
                      <button class="btn btn-secondary" type="button">Cancel</button>
                      <button class="btn btn-primary ms-3" type="submit">Save changes</button>
                    </div>
                  </div>
                </div>
              </form>
              <form id="delete-pic-form" action="{{ route('app_delete_profile_pic', ["id"=>$applicant->id]) }}" method="POST" class="d-none">
                  @csrf
              </form>
            </section>

            @if ($applicant->type == "company")  
            <section class="card border-0 py-1 p-md-2 p-xl-3 p-xxl-4 mb-4">
              <form action="{{route('app_update_c_profile', ['applicant'=>$applicant->id])}}" method="POST">
                @csrf
                <div class="card-body">
                  <div class="d-flex align-items-center pb-4 mt-sm-n1 mb-0 mb-lg-1 mb-xl-3">
                    <i class="ai-user text-primary lead pe-1 me-2"></i>
                    <h2 class="h4 mb-0">The presented consultant user profile</h2>
                  </div>
                  <div class="row align-items-center g-3 g-sm-4 pb-3">
                    <div class="col-sm-6">
                      <label class="form-label" for="fn">Name</label>
                      <input class="form-control" type="text" name="name" placeholder="Full Name" value="{{$applicant->consultant->name ?? ''}}" id="fn" required>
                    </div>
                    <div class="col-sm-6">
                      <label class="form-label" for="email">Email address</label>
                      <input class="form-control" placeholder="Email" name="email" type="email" value="{{$applicant->consultant->email ?? ''}}" id="email">
                    </div>
                    <div class="col-sm-12">
                      <label class="form-label" for="phone">Phone</label>
                      <input class="form-control" name="phone" placeholder="Phone" value="{{$applicant->consultant->phone ?? ''}}" type="number" data-format="{&quot;numericOnly&quot;: true, &quot;delimiters&quot;: [&quot;+1 &quot;, &quot; &quot;, &quot; &quot;], &quot;blocks&quot;: [0, 3, 3, 2]}" placeholder="+234 ___ ___ __" id="phone">
                    </div>
                  </div>
                  <div class="d-flex justify-content-end pt-3">
                    <button class="btn btn-primary ms-3" type="submit">Save changes</button>
                  </div>
                </div>
              </form>
            </section>
            @endif

            <!-- Password-->
            <section class="card border-0 py-1 p-md-2 p-xl-3 p-xxl-4 mb-4">
              <form action="{{route('app_change_pass', ['id'=>$applicant->id])}}" method="POST">
                @csrf
                <div class="card-body">
                  <div class="d-flex align-items-center pb-4 mt-sm-n1 mb-0 mb-lg-1 mb-xl-3"><i class="ai-lock-closed text-primary lead pe-1 me-2"></i>
                    <h2 class="h4 mb-0">Password change</h2>
                  </div>
                  <div class="row align-items-center g-3 g-sm-4 pb-3">
                    <div class="col-sm-6">
                      <label class="form-label" for="current-pass">Current password</label>
                      <div class="password-toggle">
                        <input class="form-control" name="current_pass" type="password" value="" placeholder="Current Password" id="current-pass">
                        <label class="password-toggle-btn" aria-label="Show/hide password">
                          <input class="password-toggle-check" type="checkbox"><span class="password-toggle-indicator"></span>
                        </label>
                      </div>
                    </div>
                    <div class="col-sm-6"><a class="d-inline-block fs-sm fw-semibold text-decoration-none mt-sm-4" href="account-password-recovery.html">Forgot password?</a></div>
                    <div class="col-sm-6">
                      <label class="form-label" for="new-pass">New password</label>
                      <div class="password-toggle">
                        <input class="form-control" name="password" type="password" id="new-pass">
                        <label class="password-toggle-btn" aria-label="Show/hide password">
                          <input class="password-toggle-check" type="checkbox"><span class="password-toggle-indicator"></span>
                        </label>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <label class="form-label" for="confirm-pass">Confirm new password</label>
                      <div class="password-toggle">
                        <input class="form-control" name="password_confirmation" type="password" id="confirm-pass">
                        <label class="password-toggle-btn" aria-label="Show/hide password">
                          <input class="password-toggle-check" type="checkbox"><span class="password-toggle-indicator"></span>
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="alert alert-info d-flex my-3 my-sm-4"><i class="ai-circle-info fs-xl me-2"></i>
                    <p class="mb-0">Password must be minimum 8 characters long - the more, the better.</p>
                  </div>
                  <div class="d-flex justify-content-end pt-3">
                    <button class="btn btn-secondary" onclick="history.back()" type="button">Cancel</button>
                    <button class="btn btn-primary ms-3" type="submit">Save changes</button>
                  </div>
                </div>
              </form>
            </section>
            {{-- <!-- Delete account-->
            <section class="card border-0 py-1 p-md-2 p-xl-3 p-xxl-4">
              <div class="card-body">
                <div class="d-flex align-items-center pb-4 mt-sm-n1 mb-0 mb-lg-1 mb-xl-3"><i class="ai-trash text-primary lead pe-1 me-2"></i>
                  <h2 class="h4 mb-0">Delete account</h2>
                </div>
                <div class="alert alert-warning d-flex mb-4"><i class="ai-triangle-alert fs-xl me-2"></i>
                  <p class="mb-0">When you delete your account, your public profile will be deactivated immediately. If you change your mind before the 14 days are up, sign in with your email and password, and we'll send a link to reactivate account. <a href='#' class='alert-link'>Learn more</a></p>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="confirm">
                  <label class="form-check-label text-dark fw-medium" for="confirm">Yes, I want to delete my account</label>
                </div>
                <div class="d-flex flex-column flex-sm-row justify-content-end pt-4 mt-sm-2 mt-md-3">
                  <button class="btn btn-danger" type="button"><i class="ai-trash ms-n1 me-2"></i>Delete account</button>
                </div>
              </div>
            </section> --}}
          </div>
@endsection

@section('script')
  <script>
    // Create a break line element
    var br = document.createElement("br");
    var b = <?php echo $s;?>;
    var c = <?php echo $r;?>;

    // Directors
    function add_director() {

    var Heading = document.createTextNode("Director ("+b+")");

    var col = document.createElement("div");
    col.setAttribute("class", "col-sm-6");

    var headLabel = document.createElement("label");
    headLabel.setAttribute("class", "form-label");
    headLabel.appendChild(Heading);

    var head = document.createElement("input");
    head.setAttribute("type", "text");
    head.setAttribute("name", "n_director["+b+"]");
    head.setAttribute("class", "form-control");
    head.setAttribute("id", "director");

    col.appendChild(headLabel);
    col.appendChild(head);

    document.getElementsByClassName("dirrr")[0]
   .appendChild(col);

    b=b+1;
    }

    // experience
    function add_experience() {

    var Heading = document.createTextNode("Experience");
    var Start = document.createTextNode("Start");
    var End = document.createTextNode("End");

    var col = document.createElement("div");
    col.setAttribute("class", "col-sm-4");

    var col2 = document.createElement("div");
    col2.setAttribute("class", "col-sm-4");

    var col3 = document.createElement("div");
    col3.setAttribute("class", "col-sm-4");

    var headLabel = document.createElement("label");
    headLabel.setAttribute("class", "form-label");
    headLabel.appendChild(Heading);

    var startLabel = document.createElement("label");
    startLabel.setAttribute("class", "form-label");
    startLabel.appendChild(Start);

    var endLabel = document.createElement("label");
    endLabel.setAttribute("class", "form-label");
    endLabel.appendChild(End);

    var head = document.createElement("input");
    head.setAttribute("type", "text");
    head.setAttribute("name", "n_e_name["+c+"]");
    head.setAttribute("placeholder", "Experience");
    head.setAttribute("class", "form-control");
    head.setAttribute("id", "heading");

    var start_date = document.createElement("input");
    start_date.setAttribute("type", "date");
    start_date.setAttribute("name", "n_start_date["+c+"]");
    start_date.setAttribute("class", "form-control")
    start_date.setAttribute("id", "start_date");

    var end_date = document.createElement("input");
    end_date.setAttribute("type", "date");
    end_date.setAttribute("name", "n_end_date["+c+"]");
    end_date.setAttribute("class", "form-control");
    // due_date.setAttribute("required", "required");
    end_date.setAttribute("id", "end_date");


    col.appendChild(headLabel);
    col.appendChild(head);

    col2.appendChild(startLabel);
    col2.appendChild(start_date);

    col3.appendChild(endLabel);
    col3.appendChild(end_date);

    document.getElementsByClassName("expp")[0]
   .appendChild(col);
   document.getElementsByClassName("expp")[0]
   .appendChild(col2);
   document.getElementsByClassName("expp")[0]
   .appendChild(col3);

    c=c+1;
    }
  </script>
@endsection
