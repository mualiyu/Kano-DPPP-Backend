@extends('layouts.index')

@section('content')
<!-- Page content-->
<div class="col-lg-9 pt-4 pb-2 pb-sm-4">
  <h1 class="h2 mb-4">Users</h1>
  <!-- Basic info-->
@include('layouts.flash')
  <!-- Orders-->
  <section class="card border-0 py-1 p-md-2 p-xl-3 p-xxl-4">
    <div class="card-body">
      <div class="d-flex align-items-center mt-sm-n1 pb-4 mb-0 mb-lg-1 mb-xl-3"><i class="ai-cart text-primary lead pe-1 me-2"></i>
        <h2 class="h4 mb-0">Admins</h2>
          <button class="btn btn-sm btn-secondary ms-auto" data-bs-toggle="modal" data-bs-target="#add-user-modal">Add New User</button>
      </div>
      <!-- Orders accordion-->
      <div class="accordion accordion-alt accordion-orders" id="orders">
        <!-- Order-->
        <?php $a=1;?>
            @if (count($users) > 0)
                @foreach ($users as $u)
                <div class="accordion-item border-top mb-0">
                  <div class="accordion-header"><a class="accordion-button d-flex fs-4 fw-normal text-decoration-none py-3 collapsed" href="#orderOne" data-bs-toggle="collapse" aria-expanded="false" aria-controls="orderOne">
                      <div class="d-flex justify-content-between w-100" style="max-width: 550px;">
                        <div class="me-3 me-sm-3">
                          <div class="fs-sm text-muted mb-2">Name</div>
                          <div class="fs-sm fw-medium text-dark">{{$u->name}}</div>
                        </div>
                        <div class="me-3 me-sm-3">
                          <div class="fs-sm text-muted">Email</div>
                          <span class="badge bg-faded-info text-info fs-xs">{{$u->email}}</span>
                        </div>
                        <div class="me-3 me-sm-3">
                          <div class="d-none d-sm-block fs-sm text-muted mb-2">Created At</div>
                          <div class="d-sm-none fs-sm text-muted mb-2">Date</div>
                          <div class="fs-sm fw-medium text-dark">{{date('M d, Y', strtotime($u->created_at))}}</div>
                        </div>
                      </div>
                      <div class="accordion-button-img d-none d-sm-flex ms-auto">
                        <button data-bs-toggle="modal" data-bs-target="#modalId{{$u->id}}" class="nav-link text-normal fs-xl fw-normal py-1 pe-0 ps-1 ms-2" data-bs-toggle="tooltip" aria-label="Edit"><i class="ai-edit-alt"></i></button>
                        {{-- <button onclick="event.preventDefault(); document.getElementById('b-form').submit();" class="nav-link text-danger fs-xl fw-normal py-1 pe-0 ps-1 ms-2" type="button" data-bs-toggle="tooltip" aria-label="Delete"><i class="ai-trash"></i></button> --}}

                        {{-- <div class="mx-1">
                          <img src="assets/img/account/orders/01.png" width="48" alt="Product">
                        </div> --}}
                      </div>
                    </a>
                    </div>

                    <div class="modal fade" id="modalId{{$u->id}}" tabindex="-1" role="dialog">
                      <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h2 class="h4 mb-0">Profile info</h2>
                            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <article class="card border-0 py-1 p-md-2 p-xl-3 p-xxl-4 mb-4">
                                <div class="card-body">
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
                                      <input class="form-control" type="text" name="name" value="{{$u->name}}" id="fn" disabled>
                                    </div>
                                    <div class="col-sm-6">
                                      <label class="form-label" for="email">Email address</label>
                                      <input class="form-control" name="email" type="email" value="{{$u->email}}" id="email" required>
                                    </div>
                                    {{-- <div class="col-sm-6">
                                      <label class="form-label" for="ln">Gender</label>
                                      <select name="gender" id="ln" class="form-control">
                                        <option value="Male">Male</option>
                                        <option value="Female">female</option>
                                      </select>
                                    </div> --}}
                                    <div class="col-sm-6">
                                      <label class="form-label" for="phone">Phone</label>
                                      <input class="form-control" name="phone" value="{{$u->phone}}" type="tel" data-format="{&quot;numericOnly&quot;: true, &quot;delimiters&quot;: [&quot;+1 &quot;, &quot; &quot;, &quot; &quot;], &quot;blocks&quot;: [0, 3, 3, 2]}" placeholder="+234 ___ ___ __" id="phone">
                                    </div>
                                  </div>
                                </div>
                            </article>
                            {{-- <p>Modal body text goes here.</p> --}}
                          </div>
                          <div class="modal-footer">
                            <button class="btn btn-secondary w-100 w-sm-auto mb-3 mb-sm-0" type="button" data-bs-dismiss="modal">Close</button>
                            {{-- <button class="btn btn-primary w-100 w-sm-auto ms-sm-3" type="button">Edit Job</button> --}}
                          </div>
                        </div>
                      </div>
                    </div>

                  {{-- <div class="accordion-collapse collapse" id="orderOne" data-bs-parent="#orders">
                  </div> --}}
                </div>
                @endforeach
            @else
                <div class="accordion-item border-top mb-0" style="text-align: center">
                  <h5>No Users yet</h5>
                </div>
            @endif

            <!-- Modal with tabs and forms -->
<div class="modal" id="add-user-modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <ul class="nav nav-tabs flex-nowrap text-nowrap mb-n1" role="tablist">
          <li class="nav-item">
            <a href="#signup" class="nav-link flex-column flex-sm-row px-3 px-sm-4" data-bs-toggle="tab" role="tab" aria-selected="false">
              <i class="ai-user me-sm-2 ms-sm-n1"></i>
              <span class="d-none d-sm-inline">Register new user</span>
              <span class="fs-sm fw-medium d-sm-none pt-1">register</span>
            </a>
          </li>
        </ul>
        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body tab-content">
        <form method="POST" action="{{route('register_new_user')}}" class="tab-pane fade show active" id="signup" autocomplete="on">
          @csrf
            <div class="mb-3 mb-sm-4">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="John Doe">
          </div>
          <div class="mb-3 mb-sm-4">
            <label for="email2" class="form-label">Email address</label>
            <input type="email" class="form-control" name="email" id="email2" placeholder="johndoe@example.com">
          </div>
          <div class="mb-3 mb-sm-4">
            <label for="phone" class="form-label">Phone</label>
            <input type="number" class="form-control" name="phone" id="phone" placeholder="08123456789">
          </div>
          <div class="mb-3 mb-sm-4">
            <label for="phone" class="form-label">Role</label>
            <select class="form-control" name="role" id="">
              <option value="Admin">Admin (General)</option>
              <option value="Web-Admin">Web-Admin</option>
            </select>
          </div>
          <div class="mb-3 mb-sm-4">
            <label for="pass2" class="form-label">Password</label>
            <div class="password-toggle">
              <input type="password" name="password" class="form-control" id="pass2">
              <label class="password-toggle-btn">
                <input type="checkbox" class="password-toggle-check">
                <span class="password-toggle-indicator"></span>
              </label>
            </div>
          </div>
          <div class="mb-4">
            <label for="pass3" class="form-label">Confirm password</label>
            <div class="password-toggle">
              <input type="password" name="password_confirmation" class="form-control" id="pass3">
              <label class="password-toggle-btn">
                <input type="checkbox" class="password-toggle-check">
                <span class="password-toggle-indicator"></span>
              </label>
            </div>
          </div>
          <button type="submit" class="btn btn-primary w-100">Register User</button>
        </form>
      </div>
    </div>
  </div>
</div>

      </div>
    </div>
  </section>
</div>
@endsection
