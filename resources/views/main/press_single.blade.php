@extends('layouts.main.index1')

@section('title')
    Press Release
@endsection
@section('content')

        <section class="mb-md-2 mb-lg-3 mb-xl-4">
        <div class="bg-primary">
          <div class="container">
              <div class="col-lg-12 pb-2 pb-lg-0 mb-4 mb-lg-0 pt-5">
                  <span class="badge text-primary bg-secondary fs-xs border" >Press Release</span>
            <h3 class="display-6 pb- pb-lg-5 text-white">{{$press->title}}</h3>
                  <p class="fs-sm fw-bold text-white pb-4">{{date('d M, Y', strtotime($press->created_at))}}</p>
              </div>
          </div>
           </div>
        </section>
      <section class="container pt-2 mt-md-2 mt-lg-3 mt-xl-4">


           <div class="row justify-content-center pt-xxl-2">
              <div class="col-lg-10 col-xl-10">

                 @if (!count($press->press_contents)>0)
                 <p style="white-space: pre-wrap;">{{$press->description}}</p>
                 @endif
                     <img src="/storage/press/{{$press->image}}"class="figure-img rounded-5" alt="...">

                  @if (count($press->press_contents)>0)
                  @foreach ($press->press_contents as $nc)
                  {{-- <h5 class="fs-3 pt-3">{{$nc->title}}</h5> --}}
                  <p class="text-dark fw-bold py-2 pt-2 h4"> {{$nc->heading}}</p>
                  <p style="white-space: pre-wrap;"> {{$nc->content}}</p>
                  @if (!$nc->image == Null)
                      <img src="/storage/press/{{$nc->image}} "class="figure-img" alt="...">

                  @endif
                  @endforeach

                  @endif
                </div>
	</div>
              </div>
      </section>

@endsection
