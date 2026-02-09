@extends('layouts.index')

@section('content')
     <!-- Page content-->
          <div class="col-lg-9 pt-4 pb-2 pb-sm-4">
            <h1 class="h2 mb-4">Settings</h1>
            <!-- Basic info-->
            @include('layouts.flash')
            <section class="card border-0 py-1 p-md-2 p-xl-3 p-xxl-4 mb-4">
              <div class="card-body">
                <div class="d-flex align-items-center mt-sm-n1 pb-4 mb-0 mb-lg-1 mb-xl-3"><i class="ai-user text-primary lead pe-1 me-2"></i>
                  <h2 class="h4 mb-0">Profile info</h2>
                  <a class="btn btn-sm btn-secondary ms-auto" href="{{route('users')}}">View Users</a>
                </div>
                {{-- <div class="d-flex align-items-center">
                  <div class="dropdown">
                    <a class="d-flex flex-column justify-content-end position-relative overflow-hidden rounded-circle bg-size-cover bg-position-center flex-shrink-0" href="#" data-bs-toggle="dropdown" aria-expanded="false" style="width: 80px; height: 80px; background-image: url({{Auth::user()->image}});">
                      <span class="d-block text-light text-center lh-1 pb-1" style="background-color: rgba(0,0,0,.5)"><i class="ai-camera"></i></span>
                    </a>
                    <div class="dropdown-menu my-1">
                      <a class="dropdown-item fw-normal" href="#"><i class="ai-camera fs-base opacity-70 me-2"></i>Upload new photo</a>
                      <a class="dropdown-item text-danger fw-normal" href="#"><i class="ai-trash fs-base me-2"></i>Delete photo</a></div>
                  </div>
                  <div class="ps-3">
                    <h3 class="h6 mb-1">Profile picture</h3>
                    <p class="fs-sm text-muted mb-0">PNG or JPG no bigger than 1000px wide and tall.</p>
                  </div>
                </div> --}}
                <div class="row g-3 g-sm-4 mt-0 mt-lg-2">
                  <div class="col-sm-6">
                    <label class="form-label" for="fn">Full name</label>
                    <input class="form-control" type="text" name="name" value="{{Auth::user()->name}}" id="fn" required>
                  </div>
                  <div class="col-sm-6">
                    <label class="form-label" for="email">Email address</label>
                    <input class="form-control" name="email" type="email" value="{{Auth::user()->name}}" id="email" required>
                  </div>
                  <div class="col-sm-6">
                    <label class="form-label" for="ln">Gender</label>
                    <select name="gender" id="ln" class="form-control">
                      <option value="Male">Male</option>
                      <option value="Female">female</option>
                    </select>
                  </div>
                  <div class="col-sm-6">
                    <label class="form-label" for="phone">Phone</label>
                    <input class="form-control" name="phone" value="{{Auth::user()->phone}}" type="tel" data-format="{&quot;numericOnly&quot;: true, &quot;delimiters&quot;: [&quot;+1 &quot;, &quot; &quot;, &quot; &quot;], &quot;blocks&quot;: [0, 3, 3, 2]}" placeholder="+234 ___ ___ __" id="phone">
                  </div>
                  <div class="col-12 d-flex justify-content-end pt-3">
                    <button class="btn btn-secondary" type="button">Cancel</button>
                    <button class="btn btn-primary ms-3" type="button">Save changes</button>
                  </div>
                </div>
              </div>
            </section>

            <!-- Sys requirement info-->
            <section class="card border-0 py-1 p-md-2 p-xl-3 p-xxl-4 mb-4">
                @csrf
                <div class="card-body">
                  <div class="d-flex align-items-center mt-sm-n1 pb-4 mb-0 mb-lg-1 mb-xl-3">
                      <i class="ai-book text-primary lead pe-1 me-2"></i>
                      <h2 class="h4 mb-0">Application requirements</h2>
                      <a class="btn btn-sm btn-secondary ms-auto" data-bs-toggle="modal" data-bs-target="#add-user-modal" onclick="">Add</a>
                  </div>
                  <div class="row g-3 g-sm-4 mt-0 mt-lg-2">

                    <div class="row subbb">
                      <?php $i=1; ?>
                      @if (count($sys_requirements))
                        @foreach ($sys_requirements as $sr)
                        {{-- <form action="{{route('update_sys_requirement', ['SysRequirement'=>$sr->id])}}"> --}}
                        <div class="col-sm-8">
{{--                          <label class="form-label" for="sub"> </label>--}}
                            <p>({{$i}}). {{$sr->name}}</p>
{{--                          <input disabled class="form-control" type="text" value="" id="sub" >--}}
                        </div>



{{--                        <div class="col-sm-5">--}}
{{--                          <label class="form-label" for="sub">Type({{$i}})</label>--}}


{{--                        </div>--}}



                        <div class="col-sm-4">
{{--                          <label class="form-label" for="sub"></label>--}}
                          <a class="nav-link text-default fs-sm fw-normal text-info py-1 pe-0 ps-1 ms-2" type="button" data-bs-toggle="modal" data-bs-target="#edit-user-modal-{{$i}}" onclick="" aria-label="Edit">
                              Edit
                          </a>
                          <a onclick="event.preventDefault(); if(window.confirm('Are you sure you want to delete {{$sr->name}}?')){document.getElementById('delete-form-{{$i}}').submit()};" class="nav-link text-danger fs-sm fw-normal text-primary py-1 pe-0 ps-1 ms-2" type="button" data-bs-toggle="tooltip" aria-label="delete">
                                Delete
                            </a>
                            <form id="delete-form-{{$i}}" action="{{ route('delete_sys_requirement', ['sysRequirement'=>$sr->id]) }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>


<div class="modal" id="edit-user-modal-{{$i}}" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <ul class="nav nav-tabs flex-nowrap text-nowrap mb-n1" role="tablist">
          <li class="nav-item">
            <a href="#signup" class="nav-link flex-column flex-sm-row px-3 px-sm-4" data-bs-toggle="tab" role="tab" aria-selected="false">
              <i class="ai-user me-sm-2 ms-sm-n1"></i>
              <span class="d-none d-sm-inline">Edit Requirement {{$i}}</span>
              <span class="fs-sm fw-medium d-sm-none pt-1">add</span>
            </a>
          </li>
        </ul>
        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body tab-content">
        <form method="POST" action="{{route('update_sys_requirement', ['sysRequirement'=>$sr->id])}}" class="tab-pane fade show active" id="signup" autocomplete="on">
          @csrf
            <div class="mb-3 mb-sm-4">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" value="{{$sr->name}}" name="sys_name" id="name" placeholder="E.g years of experience">
          </div>
          <div class="mb-3 mb-sm-4">
            <label class="form-label" for="sub">Type</label>
            <select  required class="form-control" name="sys_type" id="sub">
              <option selected value="{{$sr->type}}">{{$sr->type}}</option>
              <option disabled>---Select Type---</option>
              <option value="TextInput">TextInput</option>
              <option value="NumericInput">NumericInput</option>
              <option value="Textarea">Textarea</option>
              <option value="CheckBox">CheckBox</option>
              <option value="Yes/No">Yes/No</option>
            </select>
          </div>
          <button type="submit" class="btn btn-primary w-100">Update</button>
        </form>
      </div>
    </div>
  </div>
</div>
<?php $i++; ?>
                        @endforeach
                      @endif
                    </div>

                  </div>
                </div>
            </section>

  <!-- Orders-->
  {{-- <section class="card border-0 py-1 p-md-2 p-xl-3 p-xxl-4 mb-4">
    <div class="card-body">
      <div class="d-flex align-items-center mt-sm-n1 pb-4 mb-0 mb-lg-1 mb-xl-3"><i class="ai-cart text-primary lead pe-1 me-2"></i>
        <h2 class="h4 mb-0">Bussiness Categories</h2>
        <a class="btn btn-sm btn-secondary ms-auto" href="{{route('show_create_b_category')}}">Add</a>
      </div>
      <!-- Orders accordion-->
      <div class="accordion accordion-alt accordion-orders" id="orders">
        <!-- Order-->
        @if (count($business_category) > 0)
        <?php $a=0; ?>
        @foreach ($business_category as $b)
        <div class="accordion-item border-top mb-0">
          <div class="accordion-header"><a class="accordion-button d-flex fs-4 fw-normal text-decoration-none py-3 collapsed" href="#orderOne" data-bs-toggle="collapse" aria-expanded="false" aria-controls="orderOne">
              <div class="d-flex justify-content-between w-100" style="max-width: 440px;">
                <div class="me-3 me-sm-4 pl-5">
                   <div class="d-none d-sm-block fs-sm text-muted mb-2">Name</div>
                  <div class="d-sm-none fs-sm text-muted mb-2">Name</div>
                  <div class="fs-sm fw-medium text-dark">{{$b->name}}</div>
                     <div class="fs-sm text-muted">Name</div>
                    <div class="d-sm-none fs-sm text-muted mb-2">Web Dev</div>
                    <span class="badge bg-faded-info text-info fs-xs">In progress</span>
                </div>
                <div class="me-3 me-sm-4">
                  <div class="d-none d-sm-block fs-sm text-muted mb-2">Created At</div>
                  <div class="d-sm-none fs-sm text-muted mb-2">Date</div>
                  <div class="fs-sm fw-medium text-dark">{{date('M d,Y', strtotime($b->created_at))}}</div>
                </div>
              </div>
              <div class="accordion-button-img d-none d-sm-flex ms-auto">
                <button class="nav-link text-normal fs-xl fw-normal py-1 pe-0 ps-1 ms-2" onclick="event.preventDefault(); window.location.href='/admin/settings/business_category/{{$b->id}}/edit';" href="{{route("b_c_edit", ['id'=>$b->id])}}" data-bs-toggle="tooltip" aria-label="Edit"><i class="ai-edit-alt"></i></button>
                <button onclick="event.preventDefault(); document.getElementById('b-form{{$a}}').submit();" class="nav-link text-danger fs-xl fw-normal py-1 pe-0 ps-1 ms-2" type="button" data-bs-toggle="tooltip" aria-label="Delete"><i class="ai-trash"></i></button>
              </div>
              <form id="b-form{{$a}}" action="{{ route('delete_b_c', ['id'=>$b->id]) }}" method="POST" class="d-none">
                  @csrf
              </form>
            </a>
          </div>
          <div class="accordion-collapse collapse" id="orderOne" data-bs-parent="#orders">
            <div class="accordion-body">
              <div class="table-responsive pt-1">
                <table class="table align-middle w-100" style="min-width: 450px;">
                  <tr>
                    <td class="border-0 py-1 pe-0 ps-3 ps-sm-4">
                      <div class="fs-sm text-muted mb-2">Name</div>
                    </td>
                    <td class="border-0 py-1 pe-0 ps-3 ps-sm-4">
                      <div class="fs-sm text-muted mb-2">Created At</div>
                    </td>
                    <td class="border-0 py-1 pe-0 ps-3 ps-sm-4">
                      <div class="fs-sm text-muted mb-2"></div>
                    </td>
                  </tr>
                  @if (count($b->bussiness_sub_categories) > 0)
                <?php $c = 0; ?>
                  @foreach ($b->bussiness_sub_categories as $bsc)
                  <tr>
                    <td class="border-0 py-1 pe-0 ps-3 ps-sm-4">
                      <div class="fs-sm fw-medium text-dark">{{$bsc->name}}</div>
                    </td>
                    <td class="border-0 py-1 pe-0 ps-3 ps-sm-4">
                      <div class="fs-sm fw-medium text-dark">{{date('M d, Y', strtotime($bsc->created_at))}}</div>
                    </td>
                    <td class="border-0 py-1 pe-0 ps-3 ps-sm-4">
                      <button onclick="event.preventDefault(); document.getElementById('sb-form{{$a}}{{$c}}').submit();" class="nav-link text-danger fs-xl fw-normal py-1 pe-0 ps-1 ms-2" type="button" data-bs-toggle="tooltip" aria-label="Delete"><i class="ai-trash"></i></button>
                    </td>
                  </tr>
                  <form id="sb-form{{$a}}{{$c}}" action="{{ route('delete_b_s_c', ['id'=>$bsc->id]) }}" method="POST" class="d-none">
                    @csrf
                </form>
                <?php $c++;?>
                  @endforeach
                  @else
                  <tr>
                    <td class="border-0 py-1 pe-0 ps-3 ps-sm-4" align="center" colspan="2">
                      No sub categories found
                    </td>
                  </tr>
                  @endif
                </table>
              </div>
            </div>
          </div>
        </div>
        <?php $a++; ?>
        @endforeach
        @endif

      </div>
    </div>
  </section> --}}

            <!-- Password-->
            <section class="card border-0 py-1 p-md-2 p-xl-3 p-xxl-4 mb-4">
              <div class="card-body">
                <div class="d-flex align-items-center pb-4 mt-sm-n1 mb-0 mb-lg-1 mb-xl-3"><i class="ai-lock-closed text-primary lead pe-1 me-2"></i>
                  <h2 class="h4 mb-0">Password change</h2>
                </div>
                <div class="row align-items-center g-3 g-sm-4 pb-3">
                  <div class="col-sm-6">
                    <label class="form-label" for="current-pass">Current password</label>
                    <div class="password-toggle">
                      <input class="form-control" type="password" value="hidden@password" id="current-pass">
                      <label class="password-toggle-btn" aria-label="Show/hide password">
                        <input class="password-toggle-check" type="checkbox"><span class="password-toggle-indicator"></span>
                      </label>
                    </div>
                  </div>
                  <div class="col-sm-6"><a class="d-inline-block fs-sm fw-semibold text-decoration-none mt-sm-4" href="account-password-recovery.html">Forgot password?</a></div>
                  <div class="col-sm-6">
                    <label class="form-label" for="new-pass">New password</label>
                    <div class="password-toggle">
                      <input class="form-control" type="password" id="new-pass">
                      <label class="password-toggle-btn" aria-label="Show/hide password">
                        <input class="password-toggle-check" type="checkbox"><span class="password-toggle-indicator"></span>
                      </label>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <label class="form-label" for="confirm-pass">Confirm new password</label>
                    <div class="password-toggle">
                      <input class="form-control" type="password" id="confirm-pass">
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
                  <button class="btn btn-secondary" type="button">Cancel</button>
                  <button class="btn btn-primary ms-3" type="button">Save changes</button>
                </div>
              </div>
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



<div class="modal" id="add-user-modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <ul class="nav nav-tabs flex-nowrap text-nowrap mb-n1" role="tablist">
          <li class="nav-item">
            <a href="#signup" class="nav-link flex-column flex-sm-row px-3 px-sm-4" data-bs-toggle="tab" role="tab" aria-selected="false">
              <i class="ai-user me-sm-2 ms-sm-n1"></i>
              <span class="d-none d-sm-inline">Add New Requirement</span>
              <span class="fs-sm fw-medium d-sm-none pt-1">add</span>
            </a>
          </li>
        </ul>
        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body tab-content">
        <form method="POST" action="{{route('create_sys_requirement')}}" class="tab-pane fade show active" id="signup" autocomplete="on">
          @csrf
            <div class="mb-3 mb-sm-4">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" name="sys_name" id="name" placeholder="E.g years of experience">
          </div>
          <div class="mb-3 mb-sm-4">
            <label class="form-label" for="sub">Type</label>
            {{-- <input type="hidden" name="sub_id[{{$i}}]" value="{{$bsc->id}}"> --}}
            <select  required class="form-control" name="sys_type" id="sub">
              <option disabled selected>---Select Type---</option>
              <option value="TextInput">TextInput</option>
              <option value="NumericInput">NumericInput</option>
              <option value="Textarea">Textarea</option>
              <option value="CheckBox">CheckBox</option>
              <option value="Yes/No">Yes/No</option>
            </select>
          </div>
          <button type="submit" class="btn btn-primary w-100">Add</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
