@extends('layouts.m_index')

@section('content')
     <!-- Page content-->
          <div class="col-lg-9 pt-4 pb-2 pb-sm-4">
            <h1 class="h2 mb-4">Posted News</h1>
            <!-- Basic info-->
            @include('layouts.flash')
            <section class="card border-0 py-1 p-md-2 p-xl-3 p-xxl-4 mb-4">
              <form action="{{route('update_news', ['news'=>$news->id])}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="d-flex align-items-center mt-sm-n1 pb- mb-0 mb-lg-1 mb-xl-3">
                      <p>News information below</p>

                  </div>
                  <div class="row g-3 g-sm-4 mt-0 mt-lg-2">
                    <div class="col-sm-12">
                      <label class="form-label" for="jn">Title*</label>
                      <input class="form-control pe-5" type="text" name="title" value="{{$news->title}}" id="fjn" required>
                    </div>

                    <div class="col-sm-6">
                      <label class="form-label" for="description">Description</label>
                      <textarea class="form-control" rows="4" placeholder="Write Description" id="description" name="desc">{{$news->description ?? ""}}</textarea>
                    </div>
                    {{-- <div class="col-sm-2">
                        
                    </div> --}}
                    <div class="col-sm-6">
                        <div style="display:flex;">
                            <img class="d-flex flex-column justify-content-end position-relative overflow-hidden rounded-circle bg-size-cover bg-position-center" 
                            style="width: 80px; height: 80px;" src="/storage/news/{{$news->image}}" 
                            alt="No Image"> <p style="font-size: 12px;">{{$news->image}}</p>
                        </div>
                      {{-- <label class="form-label" for="img">Image</label> --}}
                      <input class="form-control" type="file" value="" id="img" name="image">
                    </div>
                 

                    <hr>
                    <div class="col-12">
                      <h6 class=" mb-0" style="float: left">Content</h6>
                      {{-- <span class="btn btn-primary" style="float: right;" onclick="contenttt()">Add</span> --}}
                    </div>
                    <div class="row contt">
                        @foreach ($news->news_contents as $nc)   
                        <div class="col-sm-1">
                          <br>
                          <br>
                          <br>
                          <br>
                          <button onclick="event.preventDefault(); document.getElementById('n-form-{{$nc->id}}').submit();" class="nav-link text-danger fs-xl fw-normal py-1 pe-0 ps-1 ms-2" type="button" data-bs-toggle="tooltip" aria-label="Delete"><i class="ai-trash"></i></button>
                          
                      </div>    
                        <div class="col-sm-5">
                          <input type="hidden" name="n_n[{{$nc->id}}]" value="{{$nc->id}}">
                          <label class="form-label" for="heading">Heading</label>
                          <input class="form-control" type="text" value="{{$nc->heading}}" id="heading" name="n_heading[{{$nc->id}}]">
  
                          {{-- <label class="form-label" for="heading">Image</label> --}}
                          <div style="display:flex;">
                              <img class="d-flex flex-column justify-content-end position-relative overflow-hidden rounded-circle bg-size-cover bg-position-center" 
                              style="width: 80px; height: 80px;" src="/storage/news/{{$nc->image}}" 
                              alt="No Image"> <p style="font-size: 12px;">{{$nc->image}}</p>
                          </div>
                          <input class="form-control" type="file" value="" id="heading" name="n_image{{$nc->id}}">
                        </div>
                        <div class="col-sm-6">
                          <label class="form-label" for="content">Content</label>
                          <textarea class="form-control" rows="8" placeholder="Add content" id="content" name="n_content[{{$nc->id}}]">{{$nc->content}}</textarea>
                        </div>
                        <hr>
                        @endforeach
                    </div>
                    <div class="col-12">
                      <span class="btn btn-primary" style="float: right;" onclick="contenttt()">Add</span>
                    </div>
                    <div class="col-12 d-flex justify-content-end pt-3 end">
                      <button onclick="history.back()" class="btn btn-secondary" type="button">Cancel</button>
                      <button class="btn btn-primary ms-3" type="submit">Update Post</button>
                    </div>
                  </div>
                </div>
              </form>
              @foreach ($news->news_contents as $nc)   
                <form id="n-form-{{$nc->id}}" action="{{route('delete_news_cont', ['cont'=>$nc->id])}}" method="POST">
                  @csrf
                </form>  
              @endforeach
            </section>
          </div>
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script>
    // Create a break line element
    var br = document.createElement("br");
    var c = 1;
    
    // dynamic Content
    function contenttt() {
        var hr = document.createElement("hr");
    var Heading = document.createTextNode("Heading");
    var Content = document.createTextNode("Content");
    var Image = document.createTextNode("Image");

    var col = document.createElement("div");
    col.setAttribute("class", "col-sm-6");

    var col2 = document.createElement("div");
    col2.setAttribute("class", "col-sm-6");


    var headLabel = document.createElement("label");
    headLabel.setAttribute("class", "form-label");
    headLabel.appendChild(Heading);

    var contentLabel = document.createElement("label");
    contentLabel.setAttribute("class", "form-label");
    contentLabel.appendChild(Content);

    var imageLabel = document.createElement("label");
    imageLabel.setAttribute("class", "form-label");
    imageLabel.appendChild(Image);


     var hid = document.createElement("input");
    hid.setAttribute("type", "hidden");
    hid.setAttribute("name", "c_n["+c+"]");
    hid.setAttribute("value", c);

    var head = document.createElement("input");
    head.setAttribute("type", "text");
    head.setAttribute("name", "c_heading["+c+"]");
    head.setAttribute("placeholder", "heading");
    head.setAttribute("class", "form-control");
    // head.setAttribute("required", "required");
    head.setAttribute("id", "heading");

    var cont = document.createElement("textarea");
    cont.setAttribute("type", "text");
    cont.setAttribute("name", "c_content["+c+"]");
    cont.setAttribute("placeholder", "Add content");
    cont.setAttribute("class", "form-control");
    // cont.setAttribute("required", "required");
    cont.setAttribute("id", "content");
    cont.setAttribute("rows", "5");

    var image = document.createElement("input");
    image.setAttribute("type", "file");
    image.setAttribute("name", "c_image"+c+"");
    image.setAttribute("placeholder", "Image");
    image.setAttribute("class", "form-control");
    // head.setAttribute("required", "required");
    image.setAttribute("id", "image");


    col.appendChild(headLabel);
    col.appendChild(head);
    // col.appendChild(br);
    col.appendChild(imageLabel);
    col.appendChild(image);

    col2.appendChild(contentLabel);
    col2.appendChild(cont);


     document.getElementsByClassName("contt")[0]
     .appendChild(hid);
    document.getElementsByClassName("contt")[0]
   .appendChild(col);
   document.getElementsByClassName("contt")[0]
   .appendChild(col2);
   document.getElementsByClassName("contt")[0]
   .appendChild(hr);

    c=c+1;
    }

  </script>
@endsection
