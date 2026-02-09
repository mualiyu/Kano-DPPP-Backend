@extends('layouts.m_index')

@section('content')
     <!-- Page content-->
          <div class="col-lg-9 pt-4 pb-2 pb-sm-4">
            <h1 class="h2 mb-4">Create Gallery Album</h1>
            <!-- Basic info-->
             @include('layouts.flash')
            <section class="card border-0 py-1 p-md-2 p-xl-3 p-xxl-4 mb-4">
              <form action="{{route('store_gallery')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="d-flex align-items-center mt-sm-n1 pb-4 mb-0 mb-lg-1 mb-xl-3">
                      <i class="ai-user text-primary lead pe-1 me-2"></i>
                      <h2 class="h4 mb-0">Album info</h2>
                  </div>
                  <div class="row g-3 g-sm-4 mt-0 mt-lg-2">
                    <div class="col-sm-6">
                      <label class="form-label" for="jn">Album Name</label>
                      <input class="form-control" type="text" name="name" value="" id="fjn">
                    </div>
                    <div class="col-sm-6">
                      <label class="form-label" for="jn">Description</label>
                      <input class="form-control" type="text" name="desc" value="" id="fjn">
                    </div>
                    <hr>
                    <div class="col-12">
                      <h6 class=" mb-0" style="float: left">Photos</h6>
                      <span class="btn btn-primary" style="float: right;" onclick="sub_cattt()">Add</span>
                    </div>
                    <div class="row subbb">
                      <div class="col-sm-6">
                        <label class="form-label" for="sub">Image(1)</label>
                        <input class="form-control" type="file" value="" id="sub" name="c_image1">
                        <input type="hidden" name="dd[1]" value="1">
                      </div>
                    </div>
  
                    <div class="col-12 d-flex justify-content-end pt-3 end">
                      <button class="btn btn-secondary" type="button">Cancel</button>
                      <button class="btn btn-primary ms-3" type="submit">Create Gallery</button>
                    </div>
                  </div>
                </div>
              </form>
            </section>
          </div>
@endsection

@section('script')
  <script>
    // Create a break line element
    var br = document.createElement("br");
    var b = 2;

    // Documents required
    function sub_cattt() {

    var Heading = document.createTextNode("Image("+b+")");

    var col = document.createElement("div");
    col.setAttribute("class", "col-sm-6");

    var headLabel = document.createElement("label");
    headLabel.setAttribute("class", "form-label");
    headLabel.appendChild(Heading);

    var head = document.createElement("input");
    head.setAttribute("type", "file");
    head.setAttribute("name", "c_image"+b);
    head.setAttribute("class", "form-control");
    head.setAttribute("id", "c_image");

    var hid = document.createElement("input");
    hid.setAttribute("type", "hidden");
    hid.setAttribute("name", "dd["+b+"]");
    hid.setAttribute("class", "form-control");
    hid.setAttribute("value", b);

    col.appendChild(headLabel);
    col.appendChild(head);
    col.appendChild(hid);

    document.getElementsByClassName("subbb")[0]
   .appendChild(col);

    b=b+1;
    }
  </script>
@endsection