@extends('layouts.index')

@section('content')
     <!-- Page content-->
          <div class="col-lg-9 pt-4 pb-2 pb-sm-4">
            <h1 class="h2 mb-4">Edit Tender</h1>
            <!-- Basic info-->
            @include('layouts.flash')
            <section class="card border-0 py-1 p-md-2 p-xl-3 p-xxl-4 mb-4">
              <form action="{{route('update_job', ['job'=>$job->id])}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">

                  <div class="row g-3 g-sm-4 mt-0 mt-lg-2">
                    <div class="col-sm-12">
                      <label class="form-label" for="jn">Tender Name</label>
                      <input class="form-control" type="text" name="name" value="{{$job->name}}" id="fjn">
                    </div>

                    <div class="col-sm-12">
                      <label class="form-label" for="description">Description</label>
                      <textarea class="form-control" name="description" id="description" rows="3" placeholder="Enter tender description...">{{$job->description ?? ''}}</textarea>
                    </div>

                    <div class="col-sm-6">
                      <label class="form-label" for="tender_number">Tender Number</label>
                      <input class="form-control" type="text" value="{{$job->tender_number ?? ''}}" id="tender_number" readonly>
                    </div>

                    <div class="col-sm-6">
                      <label class="form-label" for="mda_id">MDA</label>
                      <select class="form-control" name="mda_id" id="mda_id">
                          <option value="" disabled selected>Select MDA</option>
                          @foreach ($mdas as $mda)
                              <option value="{{$mda->id}}" {{$job->mda_id == $mda->id ? 'selected' : ''}}>{{$mda->name}} ({{$mda->code}})</option>
                          @endforeach
                      </select>
                    </div>

                    <div class="col-sm-6">
                      <label class="form-label" for="requisition_id">Requisition</label>
                      <select class="form-control" name="requisition_id" id="requisition_id">
                          <option value="" selected>Select Requisition (Optional)</option>
                          @foreach ($requisitions as $requisition)
                              <option value="{{$requisition->id}}" {{$job->requisition_id == $requisition->id ? 'selected' : ''}}>{{$requisition->title}} - {{$requisition->requisition_number}}</option>
                          @endforeach
                      </select>
                    </div>

                    <div class="col-sm-6">
                      <label class="form-label" for="estimated_value">Estimated Value</label>
                      <div class="input-group">
                        <input class="form-control" type="number" name="estimated_value" id="estimated_value" step="0.01" min="0" value="{{$job->estimated_value ?? ''}}" placeholder="0.00">
                        <select class="form-control" name="currency" id="currency" style="max-width: 80px;">
                            <option value="NGN" {{($job->currency ?? 'NGN') == 'NGN' ? 'selected' : ''}}>NGN</option>
                            <option value="USD" {{$job->currency == 'USD' ? 'selected' : ''}}>USD</option>
                            <option value="EUR" {{$job->currency == 'EUR' ? 'selected' : ''}}>EUR</option>
                        </select>
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <label class="form-label" for="tender_type">Tender Type</label>
                      <select class="form-control" name="tender_type" id="tender_type">
                          <option value="" {{empty($job->tender_type) ? 'selected' : ''}}>Select Type</option>
                          <option value="Open National" {{$job->tender_type == 'Open National' ? 'selected' : ''}}>Open National</option>
                          <option value="Open International" {{$job->tender_type == 'Open International' ? 'selected' : ''}}>Open International</option>
                          <option value="Restricted" {{$job->tender_type == 'Restricted' ? 'selected' : ''}}>Restricted</option>
                          <option value="Direct Procurement" {{$job->tender_type == 'Direct Procurement' ? 'selected' : ''}}>Direct Procurement</option>
                          <option value="Request for Proposal" {{$job->tender_type == 'Request for Proposal' ? 'selected' : ''}}>Request for Proposal</option>
                      </select>
                    </div>
                    <div class="col-sm-6">
                      <label class="form-label" for="open_date">Consulancy Type*</label>
                      <select class="form-control" name="c_type">
                          <option value="" disabled selected>Select (Not specified)</option>
                          @if ($job->consultancy_type)
                          <option value="{{$job->consultancy_type}}" selected>{{$job->consultancy_type ?? "Not Specified"}}</option>
                          @endif
                              <option disabled>----------------------</option>
                              <option value="International Consultancy">International Consultancy</option>
                              <option value="National Consultancy">National Consultancy</option>
                              <option value="Not Available">Not Available</option>
                      </select>
                    </div>
                     <div class="col-sm-6">
                      <label class="form-label" for="st">Job Status</label>
                      <select class="form-control" name="status" id="st">
                          <option value="{{$job->status}}" selected>{{$job->status}}</option>
                          <option disabled>----------------------</option>
                          <option value="Open">Open</option>
                          <option value="Closed">Closed</option>
                          <option value="Draft">Draft</option>
                      </select>
                    </div>
                    {{-- <div class="col-sm-6">
                      <label class="form-label" for="bc">Business Category</label>
                      <select class="form-control b_c" name="b_category" id="bc">
                          <option value="{{$job->b_category_id}}" selected>{{$job->business_category->name}}</option>
                          @foreach ($b_categories as $b)
                              <option value="{{$b->id}}">{{$b->name}}</option>
                          @endforeach
                      </select>
                    </div> --}}
                    {{-- <div class="col-12 d-sm-flex align-items-center">
                      <div class="form-label text-muted mb-2 mb-sm-0 me-sm-4 suub_bb" style="display: none;">*Business Sub-Categories:</div>
                      <div class="sub_bb">
                        <div class="form-check form-check-inline mb-0">
                          <input class="form-check-input" type="checkbox" name="communication" value="Email" id="c-email">
                          <label class="form-check-label" for="c-email">Email</label>
                        </div>
                      </div>
                    </div> --}}
                    <div class="col-sm-6">
                      <label class="form-label" for="open_date">Open Date</label>
                      <input class="form-control" type="date" value="{{$job->open_date}}" id="open_date" name="open_date">
                    </div>
                    <div class="col-sm-6">
                      <label class="form-label" for="close_date">close Date</label>
                      <input class="form-control" type="date" value="{{$job->close_date}}" id="close_date" name="close_date">
                    </div>
                    @if ($job->tor)
                    <div class="col-sm-6">
                      <label class="form-label" for="tor">Current ToR</label>
                      <div class="input-group">
                        <input type="text" disabled class="form-control" value="{{$job->tor}}.pdf">
                        <a href="{{route('job_download_doc', ['id'=>$job->id])}}" target="blank" class="btn btn-primary">Download</a>
                      </div>
                    </div>
                    @endif
                    <div class="col-sm-{{$job->tor?'6':'12'}} mt-4">
                      <label class="form-label" for="tor">Update ToR</label>
                      <input class="form-control" type="file" id="tor" name="tor">
                    </div>

                    <div class="col-sm-6">
                      <label class="form-label" for="opening_date">Opening Date</label>
                      <input class="form-control" type="date" value="{{$job->opening_date ?? ''}}" id="opening_date" name="opening_date">
                    </div>
                    <div class="col-sm-6">
                      <label class="form-label" for="closing_date">Closing Date</label>
                      <input class="form-control" type="date" value="{{$job->closing_date ?? ''}}" id="closing_date" name="closing_date">
                    </div>

                    <div class="col-sm-6">
                      <label class="form-label" for="evaluation_start_date">Evaluation Start Date</label>
                      <input class="form-control" type="date" value="{{$job->evaluation_start_date ?? ''}}" id="evaluation_start_date" name="evaluation_start_date">
                    </div>
                    <div class="col-sm-6">
                      <label class="form-label" for="evaluation_end_date">Evaluation End Date</label>
                      <input class="form-control" type="date" value="{{$job->evaluation_end_date ?? ''}}" id="evaluation_end_date" name="evaluation_end_date">
                    </div>

                    <div class="col-sm-6">
                      <label class="form-label" for="bid_security_amount">Bid Security Amount</label>
                      <input class="form-control" type="number" name="bid_security_amount" id="bid_security_amount" step="0.01" min="0" value="{{$job->bid_security_amount ?? ''}}" placeholder="0.00">
                    </div>

                    <div class="col-sm-6">
                      <label class="form-label" for="performance_security_amount">Performance Security Amount</label>
                      <input class="form-control" type="number" name="performance_security_amount" id="performance_security_amount" step="0.01" min="0" value="{{$job->performance_security_amount ?? ''}}" placeholder="0.00">
                    </div>

                    <div class="col-sm-6">
                      <label class="form-label" for="contract_duration_days">Contract Duration (Days)</label>
                      <input class="form-control" type="number" name="contract_duration_days" id="contract_duration_days" min="0" value="{{$job->contract_duration_days ?? ''}}" placeholder="0">
                    </div>

                    <div class="col-sm-12">
                      <label class="form-label" for="special_conditions">Special Conditions</label>
                      <textarea class="form-control" name="special_conditions" id="special_conditions" rows="3" placeholder="Enter any special conditions...">{{$job->special_conditions ?? ''}}</textarea>
                    </div>

                    <hr>
                    <div class="col-12">
                      <h6 class=" mb-0" style="float: left">Content</h6>
                      <span class="btn btn-primary" style="float: right;" onclick="contenttt()">Add</span>
                    </div>
                    <div class="row contt">
                      @foreach ($job->job_contents as $jc)
                      <div class="col-sm-5">
                        <label class="form-label" for="heading">Heading</label>
                        <input class="form-control" type="text" value="{{$jc->heading}}" id="heading" name="n_c_heading[{{$jc->id}}]">
                      </div>
                      <div class="col-sm-6">
                        <label class="form-label" for="content">Content</label>
                        <textarea class="form-control" rows="4" placeholder="Add content" id="content" name="n_c_content[{{$jc->id}}]">{{$jc->content}}</textarea>
                      </div>
                      <div class="col-sm-1">
                        <label class="form-label" for="due_date"></label><br><br>
                        <button onclick="event.preventDefault(); document.getElementById('c-form{{$jc->id}}').submit();" class="nav-link text-danger fs-xl fw-normal py-1 pe-0 ps-1 ms-2" type="button" data-bs-toggle="tooltip" aria-label="Delete"><i class="ai-trash"></i></button>
                      </div>
                      <form id="c-form{{$jc->id}}" action="{{ route('delete_content', ['id'=>$jc->id]) }}" method="POST" class="d-none">
                          @csrf
                      </form>
                      @endforeach
                    </div>

                    <hr>
                    <div class="col-12">
                      <h6 class="mb-0" style="float: left">Milestone</h6>
                      <span class="btn btn-primary" style="float: right;" onclick="milestoneee()">Add</span>
                    </div>
                    <div class="row mile">
                      @foreach ($job->job_milestones as $jm)
                      <div class="col-sm-6">
                        <label class="form-label" for="heading">Heading</label>
                        <input class="form-control" type="text" value="{{$jm->heading}}" id="heading" name="n_m_heading[{{$jm->id}}]">
                      </div>
                      <div class="col-sm-5">
                        <label class="form-label" for="content">Content</label>
                        <textarea class="form-control" rows="4" placeholder="Add content" id="content" name="n_m_content[{{$jm->id}}]">{{$jm->content}}</textarea>
                      </div>
                      {{-- <div class="col-sm-3">
                        <label class="form-label" for="due_date">Due Date</label>
                        <input class="form-control" type="date" value="{{$jm->due_date ?? ''}}" id="due_date" name="n_m_due_date[{{$jm->id}}]">
                      </div> --}}
                      <div class="col-sm-1">
                        <label class="form-label" for="due_date"></label><br><br>
                        <button onclick="event.preventDefault(); document.getElementById('ms-form{{$jm->id}}').submit();" class="nav-link text-danger fs-xl fw-normal py-1 pe-0 ps-1 ms-2" type="button" data-bs-toggle="tooltip" aria-label="Delete"><i class="ai-trash"></i></button>
                      </div>
                      <form id="ms-form{{$jm->id}}" action="{{ route('delete_milestone', ['id'=>$jm->id]) }}" method="POST" class="d-none">
                          @csrf
                      </form>
                      @endforeach
                    </div>

                    {{-- Report section --}}
                    <hr>
                    <div class="col-12">
                      <h6 class=" mb-0" style="float: left">Reports</h6>
                      <span class="btn btn-primary" style="float: right;" onclick="reporttt()">Add</span>
                    </div>
                    <div class="row rett">
                      @foreach ($job->job_reports as $rc)
                      <div class="col-sm-5">
                        <label class="form-label" for="heading">Heading</label>
                        <input class="form-control" type="text" value="{{$rc->heading}}" id="heading" name="n_r_heading[{{$rc->id}}]">
                      </div>
                      <div class="col-sm-6">
                        <label class="form-label" for="content">Content</label>
                        <textarea class="form-control" rows="4" placeholder="Add content" id="content" name="n_r_content[{{$rc->id}}]">{{$rc->content}}</textarea>
                      </div>
                      <div class="col-sm-1">
                        <label class="form-label" for="due_date"></label><br><br>
                        <button onclick="event.preventDefault(); document.getElementById('jr-form{{$rc->id}}').submit();" class="nav-link text-danger fs-xl fw-normal py-1 pe-0 ps-1 ms-2" type="button" data-bs-toggle="tooltip" aria-label="Delete"><i class="ai-trash"></i></button>
                      </div>
                      <form id="jr-form{{$rc->id}}" action="{{ route('delete_report', ['id'=>$rc->id]) }}" method="POST" class="d-none">
                          @csrf
                      </form>
                      @endforeach
                    </div>
                    {{-- End report section --}}
                    <hr>
                    <div class="col-12">
                      <h6 class="mb-0" style="float: left">Documents Required</h6>
                      <span class="btn btn-primary" style="float: right;" onclick="doctt()">Add</span>
                    </div>
                    <div class="row docc">
                      <?php $jdr=1;?>
                      @foreach ($job->job_docs as $jd)
                      <div class="col-sm-6">
                        <label class="form-label" for="heading">Document name</label><span onclick="event.preventDefault(); document.getElementById('jd-form{{$jdr}}').submit();" class="text-danger" style="float: right;" type="button"><i class="ai-trash"></i></span>
                        <form id="jd-form{{$jdr}}" action="{{ route('delete_job_doc', ['id'=>$jd->id]) }}" method="POST" class="d-none">
                            @csrf
                        </form>
                        @if ($jdr == 1)
                        <form id="jd-form{{$jdr}}" action="{{ route('delete_job_doc', ['id'=>$jd->id]) }}" method="POST" class="d-none">
                            @csrf
                        </form>
                        @endif
                        <input class="form-control" type="text" value="{{$jd->name}}" id="doc_name" name="n_doc_name[{{$jd->id}}]">
                      </div>
                      <?php $jdr++;?>
                      @endforeach
                    </div>


                    <div class="col-12 mb-3">
                      <h6 class="mb-0" >Require Previous Experience: <input  type="checkbox" name="p_e_r" {{$job->p_e_r==1 ? "checked":""}} value="1" /></h6>
                    </div>
                    <div class="col-12 mb-3">
                      <h6 class="mb-0" >Require Educational Background: <input  type="checkbox" name="e_b" {{$job->e_b==1 ? "checked":""}} value="1" /></h6>
                    </div>

                    {{-- job requirements --}}
                    @if (count($job->job_requirements)>0)
                    <div class="col-12 mb-3">
                      <h6 class="mb-0" style="float: left">Application Requirement</h6>
                    </div>
                    <div class="row">
                      <div class="col-sm-12">
                        <?php
                        $arr =[];
                        ?>
                        @foreach ($job->job_requirements as $jjr)
                            <?php array_push($arr, $jjr->sys_requirement->id); ?>
                        @endforeach
                        <ul>
                          <?php $i=0;?>
                          @foreach ($sys_requirements as $sys_r)
                            <li>
                              <label class="form-label" for="heading">{{$sys_r->name}} <small>({{$sys_r->type}})</small></label>
                              <input  type="checkbox" name="sys_r[]" {{in_array($sys_r->id, $arr) ? "checked": ""}} value="{{$sys_r->id}}" />
                            </li>
                            <?php $i++;?>
                          @endforeach
                      </ul>
                        </div>
                    </div>
                    @endif


                    <div class="col-12 d-flex justify-content-end pt-3 end">
                      <button onclick="history.back()" class="btn btn-secondary" type="button">Cancel</button>
                      <button class="btn btn-primary ms-3" type="submit">Update Job</button>
                    </div>
                  </div>
                </div>
              </form>
            </section>
          </div>
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script>
    // Create a break line element
    var br = document.createElement("br");
    var c = 1;
    var b = 1;
    var r = 1;

    // dynamic milestone
    function milestoneee() {

    var Heading = document.createTextNode("Heading");
    var Content = document.createTextNode("content");
    // var Due = document.createTextNode("Due Date");

    var col = document.createElement("div");
    col.setAttribute("class", "col-sm-6");

    var col2 = document.createElement("div");
    col2.setAttribute("class", "col-sm-6");

    // var col3 = document.createElement("div");
    // col3.setAttribute("class", "col-sm-4");

    var headLabel = document.createElement("label");
    headLabel.setAttribute("class", "form-label");
    headLabel.appendChild(Heading);

    var contentLabel = document.createElement("label");
    contentLabel.setAttribute("class", "form-label");
    contentLabel.appendChild(Content);

    // var dateLabel = document.createElement("label");
    // dateLabel.setAttribute("class", "form-label");
    // dateLabel.appendChild(Due);

    var head = document.createElement("input");
    head.setAttribute("type", "text");
    head.setAttribute("name", "m_heading["+c+"]");
    head.setAttribute("placeholder", "heading");
    head.setAttribute("class", "form-control");
    // head.setAttribute("required", "required");
    head.setAttribute("id", "heading");

    var cont = document.createElement("textarea");
    cont.setAttribute("type", "text");
    cont.setAttribute("name", "m_content["+c+"]");
    cont.setAttribute("placeholder", "Add content");
    cont.setAttribute("class", "form-control");
    // cont.setAttribute("required", "required");
    cont.setAttribute("id", "content");
    cont.setAttribute("rows", "4");

    // var due_date = document.createElement("input");
    // due_date.setAttribute("type", "date");
    // due_date.setAttribute("name", "m_due_date["+c+"]");
    // due_date.setAttribute("class", "form-control");
    // // due_date.setAttribute("required", "required");
    // due_date.setAttribute("id", "m_due_date");


    col.appendChild(headLabel);
    col.appendChild(head);

    col2.appendChild(contentLabel);
    col2.appendChild(cont);

    // col3.appendChild(dateLabel);
    // col3.appendChild(due_date);

    document.getElementsByClassName("mile")[0]
   .appendChild(col);
   document.getElementsByClassName("mile")[0]
   .appendChild(col2);
  //  document.getElementsByClassName("mile")[0]
  //  .appendChild(col3);

    c=c+1;
    }

    // dynamic Content
    function contenttt() {
    var Heading = document.createTextNode("Heading");
    var Content = document.createTextNode("content");

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
    cont.setAttribute("rows", "4");

    col.appendChild(headLabel);
    col.appendChild(head);

    col2.appendChild(contentLabel);
    col2.appendChild(cont);

    document.getElementsByClassName("contt")[0]
   .appendChild(col);
   document.getElementsByClassName("contt")[0]
   .appendChild(col2);

    c=c+1;
    }

    // dynamic Report
    function reporttt() {
    var Heading = document.createTextNode("Heading");
    var Content = document.createTextNode("content");

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

    var head = document.createElement("input");
    head.setAttribute("type", "text");
    head.setAttribute("name", "r_heading["+r+"]");
    head.setAttribute("placeholder", "Report heading");
    head.setAttribute("class", "form-control");
    // head.setAttribute("required", "required");
    head.setAttribute("id", "heading");

    var cont = document.createElement("textarea");
    cont.setAttribute("type", "text");
    cont.setAttribute("name", "r_content["+r+"]");
    cont.setAttribute("placeholder", "Add Report content");
    cont.setAttribute("class", "form-control");
    // cont.setAttribute("required", "required");
    cont.setAttribute("id", "content");
    cont.setAttribute("rows", "4");

    col.appendChild(headLabel);
    col.appendChild(head);

    col2.appendChild(contentLabel);
    col2.appendChild(cont);

    document.getElementsByClassName("rett")[0]
   .appendChild(col);
   document.getElementsByClassName("rett")[0]
   .appendChild(col2);

    r=r+1;
    }

    // Documents required
    function doctt() {

    var Heading = document.createTextNode("Document("+b+") Name");

    var col = document.createElement("div");
    col.setAttribute("class", "col-sm-6");

    var headLabel = document.createElement("label");
    headLabel.setAttribute("class", "form-label");
    headLabel.appendChild(Heading);

    var head = document.createElement("input");
    head.setAttribute("type", "text");
    head.setAttribute("name", "doc_name["+b+"]");
    head.setAttribute("placeholder", "");
    head.setAttribute("class", "form-control");
    // head.setAttribute("required", "required");
    head.setAttribute("id", "doc_name");

    col.appendChild(headLabel);
    col.appendChild(head);

    document.getElementsByClassName("docc")[0]
   .appendChild(col);

    b=b+1;
    }

$(document).ready(function () {

  $('.b_c').on('change', function() {
    var req_value = this.value;
    console.log(req_value);
    	    $.ajax({

    	        url:"{{ route('get_b_s_c', ['id'=> "req_value"]) }}",

    	        type:"GET",

    	        data:{'data':req_value},

    	        success:function (data) {
                // console.log(data);
                $('.suub_bb').css('display', 'block')
    	            $('.sub_bb').html(data);
    	        }
    	    });
  });

});
  </script>
@endsection
