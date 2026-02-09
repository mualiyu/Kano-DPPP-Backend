@if ($message = Session::get('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <span class="fw-semibold">Success:</span> {{$message}}.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if ($message = Session::get('error'))

<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <span class="fw-semibold">Error:</span> {{$message}}.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

@endif


@if ($message = Session::get('warning'))

<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <span class="fw-semibold">Warning:</span> {{$message}}.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

@endif


@if ($message = Session::get('info'))

<div class="alert alert-info alert-dismissible fade show" role="alert">
  <span class="fw-semibold">Info:</span> {{$message}}.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

@endif

@if ($m = Session::get('validator'))

{{-- <div class="alert alert-info alert-dismissible fade show" role="alert">
  <span class="fw-semibold">Info:</span> {{$message}}.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div> --}}

<div class="alert alert-primary" role="alert">
  {{-- <h4 class="pt-1 alert-heading">Please check the form below!</h4> --}}
  {{-- @foreach ($message as $m) --}}
  <p>{{$m}}.</p>
  {{-- @endforeach --}}
</div>
@endif


@if ($errors->any())

<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <span class="fw-semibold"></span> {{$errors}}.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

@endif
