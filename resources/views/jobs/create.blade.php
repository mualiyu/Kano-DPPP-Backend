@extends('layouts.index')

@section('content')
     <!-- Page content-->

          <div class="col-lg-9 pt-4 pb-2 pb-sm-4">
            <h1 class="h2 mb-4">Create Tender</h1>
              <form action="{{route('store_job')}}" method="POST" enctype="multipart/form-data">
            @include('layouts.flash')
            <section class="card border-0 py-1 p-md-2 p-xl-3 p-xxl-4 mb-4">

                @csrf
                <div class="card-body">
                  <div class="d-flex align-items-center mt-sm-n1 pb- mb-0 mb-lg-1 mb-xl-1">
                      <p>Tender information form</p>

                  </div>
                  <div class="row g-3 g-sm-4 mt-0 mt-lg-2">
                    <div class="col-sm-12">
                      <label class="form-label" for="jn">Tender Name*</label>
                      <input class="form-control pe-5" type="text" name="name" value="" id="fjn" required>
                    </div>

                    <div class="col-sm-12">
                      <label class="form-label" for="description">Description</label>
                      <textarea class="form-control" name="description" id="description" rows="3" placeholder="Enter tender description..."></textarea>
                    </div>

                    <div class="col-sm-6">
                      <label class="form-label" for="mda_id">MDA*</label>
                      <select class="form-control" name="mda_id" id="mda_id" required>
                          <option value="" disabled selected>Select MDA</option>
                          @foreach ($mdas as $mda)
                              <option value="{{$mda->id}}">{{$mda->name}} ({{$mda->code}})</option>
                          @endforeach
                      </select>
                    </div>

                    <div class="col-sm-6">
                      <label class="form-label" for="requisition_id">Requisition</label>
                      <select class="form-control" name="requisition_id" id="requisition_id">
                          <option value="" selected>Select Requisition (Optional)</option>
                          @foreach ($requisitions as $requisition)
                              <option value="{{$requisition->id}}">{{$requisition->title}} - {{$requisition->requisition_number}}</option>
                          @endforeach
                      </select>
                    </div>

                    <div class="col-sm-6">
                      <label class="form-label" for="estimated_value">Estimated Value</label>
                      <div class="input-group">
                        <input class="form-control" type="number" name="estimated_value" id="estimated_value" step="0.01" min="0" placeholder="0.00">
                        <select class="form-control" name="currency" id="currency" style="max-width: 80px;">
                            <option value="NGN" selected>NGN</option>
                            <option value="USD">USD</option>
                            <option value="EUR">EUR</option>
                        </select>
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <label class="form-label" for="tender_type">Tender Type</label>
                      <select class="form-control" name="tender_type" id="tender_type">
                          <option value="" selected>Select Type</option>
                          <option value="Open National">Open National</option>
                          <option value="Open International">Open International</option>
                          <option value="Restricted">Restricted</option>
                          <option value="Direct Procurement">Direct Procurement</option>
                          <option value="Request for Proposal">Request for Proposal</option>
                      </select>
                    </div>

                    {{-- <div class="col-sm-6">
                      <label class="form-label" for="bc">Business Category</label>
                      <select class="form-control b_c" name="b_category" id="sc">
                          <option value="" disabled selected>Select category</option>
                          @foreach ($b_categories as $b)
                              <option value="{{$b->id}}">{{$b->name}}</option>
                          @endforeach
                      </select>
                    </div> --}}
                    {{-- <div class="col-12 d-sm-flex align-items-center">
                      <div class="form-label text-muted mb-2 mb-sm-0 me-sm-4 suub_bb" style="display: none;">*Business Sub-Categories:</div>
                      <div class="sub_bb">
                      </div>
                    </div> --}}

                    <div class="col-sm-6">
                      <label class="form-label" for="open_date">Consultancy Type*</label>
                      <select class="form-control" name="c_type">
                          <option value="" disabled selected>Select</option>
                              <option value="International Consultancy">International Consultancy</option>
                              <option value="National Consultancy">National Consultancy</option>
                              <option value="Not Available">Not Available</option>
                      </select>
                    </div>
                    <div class="col-sm-6">
                      <label class="form-label" for="close_date">Job Status*</label>
                      <select class="form-control" name="j_status">
                          <option value="" disabled selected>Select</option>
                              <option value="Open">Open</option>
                              <option value="Closed">Closed</option>
                              <option value="Draft">Draft</option>
                      </select>
                    </div>
                    <br>
                    <div class="col-sm-6">
                      <label class="form-label" for="open_date">Open Date*</label>
                      <input class="form-control" type="date" value="" id="open_date" name="open_date" required>
                    </div>
                    <div class="col-sm-6">
                      <label class="form-label" for="close_date">Close Date*</label>
                      <input class="form-control" type="date" value="" id="close_date" name="close_date" required>
                    </div>
                    <div class="col-sm-6">
                      <label class="form-label" for="close_date">Terms of reference (ToR)</label>
                      <input class="form-control" type="file" id="close_date" name="tor">
                    </div>

                    <div class="col-sm-6">
                      <label class="form-label" for="opening_date">Opening Date</label>
                      <input class="form-control" type="date" value="" id="opening_date" name="opening_date">
                    </div>
                    <div class="col-sm-6">
                      <label class="form-label" for="closing_date">Closing Date</label>
                      <input class="form-control" type="date" value="" id="closing_date" name="closing_date">
                    </div>

                    <div class="col-sm-6">
                      <label class="form-label" for="evaluation_start_date">Evaluation Start Date</label>
                      <input class="form-control" type="date" value="" id="evaluation_start_date" name="evaluation_start_date">
                    </div>
                    <div class="col-sm-6">
                      <label class="form-label" for="evaluation_end_date">Evaluation End Date</label>
                      <input class="form-control" type="date" value="" id="evaluation_end_date" name="evaluation_end_date">
                    </div>

                    <div class="col-sm-6">
                      <label class="form-label" for="bid_security_amount">Bid Security Amount</label>
                      <input class="form-control" type="number" name="bid_security_amount" id="bid_security_amount" step="0.01" min="0" placeholder="0.00">
                    </div>

                    <div class="col-sm-6">
                      <label class="form-label" for="performance_security_amount">Performance Security Amount</label>
                      <input class="form-control" type="number" name="performance_security_amount" id="performance_security_amount" step="0.01" min="0" placeholder="0.00">
                    </div>

                    <div class="col-sm-6">
                      <label class="form-label" for="contract_duration_days">Contract Duration (Days)</label>
                      <input class="form-control" type="number" name="contract_duration_days" id="contract_duration_days" min="0" placeholder="0">
                    </div>

                    <div class="col-sm-12">
                      <label class="form-label" for="special_conditions">Special Conditions</label>
                      <textarea class="form-control" name="special_conditions" id="special_conditions" rows="3" placeholder="Enter any special conditions..."></textarea>
                    </div>

                    <hr>
                    <div class="col-12">
                      <h6 class=" mb-0" style="float: left">Body Contents</h6>
                      <span class="btn btn-primary" style="float: right;" onclick="contenttt()">Add</span>
                    </div>
                    <div class="row contt">

                    </div>

                    <hr>
                    <div class="col-12">
                      <h6 class="mb-0" style="float: left">Milestone</h6>
                      <span class="btn btn-primary" style="float: right;" onclick="milestoneee()">Add</span>
                    </div>
                    <div class="row mile">

                    </div>

                    <hr>
                    <div class="col-12">
                      <h6 class=" mb-0" style="float: left">Report</h6>
                      <span class="btn btn-primary" style="float: right;" onclick="reporttt()">Add</span>
                    </div>
                    <div class="row rett">

                    </div>

                    <hr>
                  </div>
                </div>

            </section>




     <section class="card border-0 py-1 p-md-2 p-xl-3 p-xxl-4 mb-4">

         <div class="card-body">
             <div class="d-flex align-items-center mt-sm-n1 pb- mb-0 mb-lg-1 mb-xl-3">
                 <h4>Application Requirements</h4>


             </div>
             <hr>
              <br>
                    <div class="col-12 mb-3">
                      <h6 class="mb-0" >Require Previous Experience: <input  type="checkbox" name="p_e_r" value="1" /></h6>
                    </div>
                    <div class="col-12 mb-3">
                      <h6 class="mb-0" >Require Educational Background: <input  type="checkbox" name="e_b" value="1" /></h6>
                    </div>
             <hr>
                    <div class="col-12 mb-3">
                      <h6 class="mb-0" >Application Requirement</h6>
                    </div>
                    <div class="row">
                      <div class="col-sm-12">
                        <ul style="list-style-type:none;">
                      @foreach ($sys_requirements as $sr)
                        <li>
                            <input  type="checkbox" name="sys_r[]" value="{{$sr->id}}" />
                          <label class="form-label" for="heading">{{$sr->name}} </label>

                        </li>
                        @endforeach
                      </ul>
                        </div>
                    </div>
             <hr>

             <div class="col-12 mb-5 pt-5">

                 <h6 class="mb-0" style="float: left">Documents</h6>
                 <span class="btn btn-primary" style="float: right;" onclick="doctt()">Add</span>
             </div>

             <div class="row docc mb-5">
             </div>

                    <div class="col-12 d-flex justify-content-end pt-3 end">
                      <button onclick="history.back()" class="btn btn-secondary" type="button">Cancel</button>
                      <button class="btn btn-primary ms-3" type="submit">Create Tender</button>
                    </div>

                    </div>

            </section>
              </form>
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


    // dynamic Reporting section
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
    head.setAttribute("placeholder", "Report Heading");
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
    head.setAttribute("placeholder", "Document name");
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
