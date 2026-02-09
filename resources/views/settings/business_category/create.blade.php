@extends('layouts.index')

@section('content')
     <!-- Page content-->
          <div class="col-lg-9 pt-4 pb-2 pb-sm-4">
            <h1 class="h2 mb-4">Create Bussiness Category</h1>
            <!-- Basic info-->
            <section class="card border-0 py-1 p-md-2 p-xl-3 p-xxl-4 mb-4">
              <form action="{{route('create_b_category')}}" method="POST">
                @csrf
                <div class="card-body">
                  <div class="d-flex align-items-center mt-sm-n1 pb-4 mb-0 mb-lg-1 mb-xl-3">
                      <i class="ai-user text-primary lead pe-1 me-2"></i>
                      <h2 class="h4 mb-0">Business info</h2>
                  </div>
                  <div class="row g-3 g-sm-4 mt-0 mt-lg-2">
                    <div class="col-sm-12 col-12">
                      <label class="form-label" for="jn">Name</label>
                      <input class="form-control" type="text" name="name" value="" id="fjn">
                    </div>
                    <hr>
                    <div class="col-12">
                      <h6 class=" mb-0" style="float: left">Business Sub Category</h6>
                      <span class="btn btn-primary" style="float: right;" onclick="sub_cattt()">Add</span>
                    </div>
                    <div class="row subbb">
                      <div class="col-sm-6">
                        <label class="form-label" for="sub">Sub Category(1)</label>
                        <input class="form-control" type="text" value="" id="sub" name="sub_name[1]">
                      </div>
                    </div>
  
                    <div class="col-12 d-flex justify-content-end pt-3 end">
                      <button class="btn btn-secondary" type="button">Cancel</button>
                      <button class="btn btn-primary ms-3" type="submit">Create Business</button>
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

    var Heading = document.createTextNode("Sub Category("+b+")");

    var col = document.createElement("div");
    col.setAttribute("class", "col-sm-6");

    var headLabel = document.createElement("label");
    headLabel.setAttribute("class", "form-label");
    headLabel.appendChild(Heading);

    var head = document.createElement("input");
    head.setAttribute("type", "text");
    head.setAttribute("name", "sub_name["+b+"]");
    head.setAttribute("class", "form-control");
    head.setAttribute("id", "sub_name");

    col.appendChild(headLabel);
    col.appendChild(head);

    document.getElementsByClassName("subbb")[0]
   .appendChild(col);

    b=b+1;
    }
  </script>
@endsection