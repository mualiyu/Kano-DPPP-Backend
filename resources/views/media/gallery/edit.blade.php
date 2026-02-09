@extends('layouts.m_index')

@section('content')
     <!-- Page content-->
          <div class="col-lg-9 pt-4 pb-2 pb-sm-4">
            <h1 class="h2 mb-4">Update Gallery Album</h1>
            <!-- Basic info-->
             @include('layouts.flash')
            <section class="card border-0 py-1 p-md-2 p-xl-3 p-xxl-4 mb-4">
              <form action="{{route('update_gallery', ['gallery'=>$gallery->id])}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="d-flex align-items-center mt-sm-n1 pb-4 mb-0 mb-lg-1 mb-xl-3">
                      <i class="ai-user text-primary lead pe-1 me-2"></i>
                      <h2 class="h4 mb-0">Album info</h2>
                  </div>
                  <div class="row g-3 g-sm-4 mt-0 mt-lg-2">
                    <div class="col-sm-6">
                      <label class="form-label" for="jn">Album Name</label>
                      <input class="form-control" type="text" name="name" value="{{$gallery->name}}" id="fjn">
                    </div>
                    <div class="col-sm-6">
                      <label class="form-label" for="jn">Description</label>
                      <input class="form-control" type="text" name="desc" value=" {{$gallery->description}}" id="fjn">
                    </div>
                    <hr>
                    <div class="col-12">
                      <h6 class=" mb-0" style="float: left">Photos</h6>
                      <span class="btn btn-primary" style="float: right;" onclick="sub_cattt()">Add</span>
                    </div>
                    <div class="row subbb">
                        <?php $i=1;?>
                        @if (count($gallery->images))
                            @foreach ($gallery->images as $im)
                            <div class="col-sm-6">
                              <label class="form-label" style="display: flex;" for="sub">Image({{$i}}) 
                                <button onclick="event.preventDefault(); document.getElementById('n-form-{{$im->id}}').submit();" class="nav-link text-danger fs-xl fw-normal pe-0 ps-1 ms-2" type="button" data-bs-toggle="tooltip" aria-label="Delete"><i class="ai-trash"></i></button>
                              </label>
                              <img class="d-flex flex-column justify-content-end position-relative overflow-hidden bg-size-cover bg-position-center" 
                            style="width:; height: 150px;" src="/storage/gallery/{{$im->image}}" 
                            alt="No Image">
                              <input class="form-control" type="file" value="" id="sub" name="n_image{{$i}}">
                              <input type="hidden" name="n_dd[{{$i}}]" value="{{$im->id}}">
                            </div>
                            <?php $i++;?>
                            @endforeach
                            <hr class="my-2">
                            
                        @endif
                    </div>
  
                    <div class="col-12 d-flex justify-content-end pt-3 end">
                      <button class="btn btn-secondary" type="button">Cancel</button>
                      <button class="btn btn-primary ms-3" type="submit">Update Gallery</button>
                    </div>
                  </div>
                </div>
              </form>
              @foreach ($gallery->images as $nc)   
                <form id="n-form-{{$nc->id}}" action="{{route('delete_gallery_cont', ['img'=>$nc->id])}}" method="POST">
                  @csrf
                </form>  
              @endforeach
            </section>
          </div>
@endsection

@section('script')
  <script>
    // Create a break line element
    var br = document.createElement("br");
    var b = 1;
    var c = <?php echo $i; ?>;

    // Documents required
    function sub_cattt() {

    var Heading = document.createTextNode("Image("+c+")");

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
    c=c+1;
    }
  </script>
@endsection
