@extends('layouts.m_index')

@section('content')
    <!-- Page content-->
    <div class="col-lg-9 pt-4 pb-2 pb-sm-4">
      <div class="d-flex align-items-center mb-4">
        <h1 class="h2 mb-0">Downloads</h1>
          <div class="ms-auto">
              <a class="btn btn-sm btn-primary ms-auto" style="float: right;" href="{{route('show_create_down')}}">Add Downloads</a>
          </div>
      </div>
      @include('layouts.flash')
      <div class="card border-0 py-1 p-md-2 p-xl-3 p-xxl-4">
        <div class="card-body pb-4">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Download</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
            <?php $a=1;?>
            @if (count($downloads) > 0)
                @foreach ($downloads as $n)
                    <tr>
                        <td class="text-dark">{{$n->title}}</td>
                        <td><a target="blank" href="{{route('show_down_doc', ['download'=>$n->id])}}">Download</a></td>
                        <td>{{date('M d, Y', strtotime($n->created_at))}}</td>
                        <td>
                            <a  onclick="event.preventDefault(); window.location.href='/web-admin/downloads/{{$n->id}}/download-info';" class="nav-link text-default fs-sm fw-normal text-primary py-1 pe-0 ps-1 ms-2" type="button" data-bs-toggle="tooltip" aria-label="View">
                                View
                            </a>
                            <a style="cursor: pointer;" onclick="event.preventDefault(); document.getElementById('b-form{{$n->id}}').submit();" class="nav-link text-default fs-sm fw-normal text-danger py-1 pe-0 ps-1 ms-2" aria-label="Delete">
                            Delete
                            </a>
                            <form id="b-form{{$n->id}}" action="{{route('delete_down', ['download'=>$n->id])}}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </td>
                    </tr>
                @endforeach
            @else
                <div class="  mb-0" style="text-align: center">
                    <h5>No Downloads Yet</h5>
                </div>
            @endif

            </tbody>
            </table>
        </div>

          <div class="d-sm-flex align-items-center pt-4 pt-sm-5">
                <nav class="order-sm-2 ms-sm-auto mb-4 mb-sm-0" aria-label="Orders pagination">
                    <ul class="pagination pagination-sm justify-content-center">
                        <li class="page-item active" aria-current="page"><span class="page-link">1<span class="visually-hidden">(current)</span></span></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">4</a></li>
                    </ul>
                </nav>
            </div>

        </div>
      </div>

    </div>


@endsection
