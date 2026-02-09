@extends('layouts.m_index')

@section('content')
     <!-- Page content-->
          <div class="col-lg-9 pt-4 pb-2 pb-sm-4">
            <h1 class="h2 mb-4">Update Video</h1>
            <!-- Basic info-->
             @include('layouts.flash')
            <section class="card border-0 py-1 p-md-2 p-xl-3 p-xxl-4 mb-4">
              <form action="{{route('update_video', ['video'=>$video->id])}}" method="POST">
                @csrf
                <div class="card-body">
                  <div class="d-flex align-items-center mt-sm-n1 pb-4 mb-0 mb-lg-1 mb-xl-3">
                      <i class="ai-user text-primary lead pe-1 me-2"></i>
                      <h2 class="h4 mb-0">Video info</h2>
                  </div>
                  <div class="row g-3 g-sm-4 mt-0 mt-lg-2">
                    <div class="col-sm-6">
                      <label class="form-label" for="jn">Title</label>
                      <input class="form-control" type="text" name="title" value="{{$video->title}}" id="fjn">
                    </div>
                    <div class="col-sm-6">
                      <label class="form-label" for="jn">Description</label>
                      <input class="form-control" type="text" name="desc" value=" {{$video->description}}" id="fjn">
                    </div>
                    <div class="col-sm-12">
                      <label class="form-label" for="jn">Link</label>
                      <input class="form-control" type="text" name="link" value=" {{$video->link}}" id="fjn">
                    </div>
                    <hr>
                    <div class="col-12 d-flex justify-content-end pt-3 end">
                      <button class="btn btn-secondary" type="button">Cancel</button>
                      <button class="btn btn-primary ms-3" type="submit">Update Video</button>
                    </div>
                  </div>
                </div>
              </form>
            </section>
          </div>
@endsection

