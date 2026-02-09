@extends('layouts.app_index')

@section('content')

    <div class="col-lg-9 pt-4 pb-2 pb-sm-4">
      <div class="d-flex align-items-center mb-4">

        <a onclick="history.back()" class="btn btn-secondary w-100 w-sm-auto mb-3 mb-sm-0" type="button" data-bs-dismiss="modal">Back</a>
      </div>
      @include('layouts.flash')
      <div class="card border-0 py-1 p-md-2 p-xl-3 p-xxl-4">
        <div class="card-body pb-4">
          <div class="d-flex align-items-center mt-sm-n1 pb-4 mb-0 mb-lg-1 mb-xl-3">

            <h2 class="h4 mb-0">{{$app->job->name}}</h2>
            {{-- <a class="btn btn-sm btn-secondary ms-auto" style="float: right;" href="{{route('show_create_job')}}">Create Job</a> --}}
          </div>
          <!-- Orders accordion-->
          <div class="accordion accordion-alt accordion-orders" id="orders">
                <div class="alert alert-warning" role="alert">
                  <h4 class="pt-0 alert-heading">Note!</h4>
                  <p>If you proceed with this form, it will override all your previously submitted documents.</p>

                </div>
                <article class="card border-0 bg-default">
                  <div class="card-body pb-4">

                    <div class="mx-4">
                      <form action="{{route('app_update_app', ['id'=>$app->id])}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                          <?php $d=0; ?>

                              @foreach ($app->job->job_requirements as $jr)
                              <div class="col-sm-12">
                                  <div class="mb-3">
                                    <label for="file-input" class="form-label">{{$jr->sys_requirement->name}}: </label>
                                    @if ($jr->sys_requirement->type == "TextInput")
                                    <input class="form-control" name="app_r_value[{{$jr->sys_id}}]" type="text" value="">
                                    @elseif($jr->sys_requirement->type == "NumericInput")
                                    <input class="form-control" name="app_r_value[{{$jr->sys_id}}]" type="number" value="">
                                    @elseif($jr->sys_requirement->type == "CheckBox")
                                    <input name="app_r_value[{{$jr->sys_id}}]" type="checkbox">
                                    @elseif($jr->sys_requirement->type == "Yes/No")
                                    <br>
                                    <label for="y">Yes: </label>
                                    <input name="app_r_value[{{$jr->sys_id}}]" value="1"  type="radio">
                                    <br>
                                    <label for="n">No: </label>
                                    <input name="app_r_value[{{$jr->sys_id}}]" value="0" type="radio" >
                                    @elseif($jr->sys_requirement->type == "Textarea")
                                    <textarea class="form-control" name="app_r_value[{{$jr->sys_id}}]" rows="10"></textarea>
                                    @endif
                                    <input type="hidden" name="app_r_name[{{$jr->sys_id}}]" value="{{$jr->sys_requirement->name}}">
                                    <input type="hidden" name="app_r_type[{{$jr->sys_id}}]" value="{{$jr->sys_requirement->type}}">
                                  </div>
                              </div>
                              @endforeach

                              <h6 class="pt-5">Documents</h6>
                              <div class="d-none d-sm-block fs-sm mb-2 ">Note: <small>(All doc's most be converted to pdf).</small></div>
                              <input type="hidden" name="job" value="{{$app->job->id}}">
                              @if (count($app->job->job_docs)>0)
                                  @foreach ($app->job->job_docs as $jdoc)
                                      <?php $d++;?>
                                      <div class="col-sm-6">
                                          <div class="mb-3">
                                              <label for="file-input" class="form-label">{{$jdoc->name}}: </label>
                                              <input class="form-control" name="doc{{$d}}" type="file" id="file-input">
                                              <input type="hidden" name="doc_id[{{$d}}]" value="{{$jdoc->id}}">
                                          </div>
                                      </div>
                                  @endforeach
                              @endif
                              <input type="hidden" name="num" value="{{$d}}">

                              <?php $r =1;?>
                              @if ($app->job->p_e_r == 1)
                                    <div class="col-12 pb-3 pt-3">
                                        <h6 class=" mb-0" style="float: left">Previous Jobs</h6>
                                        <span class="btn btn-primary" style="float: right;" onclick="add_experience()">Add</span>
                                    </div>
                                    <div class="row expp">
                                      {{-- @if (count($applicant->experiences)>0)
                                      @foreach ($applicant->experiences as $e)
                                      <div class="col-sm-4 mb-3">
                                        <input type="hidden" name="exp_id[{{$r}}]" value="{{$e->id}}">
                                        <label class="form-label" for="heading">Experience:</label>
                                        <input class="form-control" type="text" value="{{$e->name}}" id="experience" name="e_name[{{$e->id}}]">
                                      </div>
                                      <div class="col-sm-4">
                                        <label class="form-label" for="heading">Start</label>
                                        <input class="form-control" type="date" value="{{$e->start}}" id="start_date" name="start_date[{{$e->id}}]">
                                      </div>
                                      <div class="col-sm-4">
                                        <label class="form-label" for="heading">End</label>
                                        <input class="form-control" type="date" value="{{$e->end}}" id="end_date" name="end_date[{{$e->id}}]">
                                      </div>
                                      <$r++;
                                      @endforeach
                                      @endif --}}
                                    </div>
                                  @endif

                                  <?php $k =1;?>
                                  @if ($app->job->e_b == 1)
                                    <div class="col-12 pb-3 pt-3">
                                        <h6 class=" mb-0" style="float: left">Add Educations</h6>
                                        <span class="btn btn-primary" style="float: right;" onclick="add_education()">Add</span>
                                    </div>
                                    <div class="row educc">
                                      
                                    </div>
                                  @endif
                              
                              <div class="col-12 d-flex justify-content-end pt-3">
                                <button class="btn btn-secondary" onclick="history.back()" type="button">Cancel</button>
                                <button class="btn btn-primary ms-3" type="submit">Update</button>
                              </div>
                          </div>
                        </form>
                    </div>
                </article>

          </div>
        </div>
      </div>
    </div>
@endsection

@section('style')
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
{{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> --}}
<script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>
<link href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css" rel="stylesheet" type="text/css" />
@endsection

@section('script')
<script>
// Create a break line element
    var br = document.createElement("br");
    var c = <?php echo $r;?>;
    var cc = <?php echo $r+999;?>;
    var b = <?php echo $k;?>;
    var bb = <?php echo $k+999;?>;
    
    // experience
    function add_experience() {
    var hr = document.createElement("hr");
    hr.setAttribute("style", "margin:5px;");
    
    var Heading = document.createTextNode("Employer Name");
    var Role = document.createTextNode("Role");
    var Start = document.createTextNode("Start");
    var End = document.createTextNode("End");
    var Current = document.createTextNode("Currently Here");

    var col = document.createElement("div");
    col.setAttribute("class", "col-sm-6");

    var col2 = document.createElement("div");
    col2.setAttribute("class", "col-sm-6");

    var col3 = document.createElement("div");
    col3.setAttribute("class", "col-sm-5");
    
    var col5 = document.createElement("div");
    col5.setAttribute("class", "col-sm-2");

    var col4 = document.createElement("div");
    col4.setAttribute("class", "col-sm-5");

    var headLabel = document.createElement("label");
    headLabel.setAttribute("class", "form-label");
    headLabel.appendChild(Heading);

    var roleLabel = document.createElement("label");
    roleLabel.setAttribute("class", "form-label");
    roleLabel.appendChild(Role);

    var startLabel = document.createElement("label");
    startLabel.setAttribute("class", "form-label");
    startLabel.appendChild(Start);

    var endLabel = document.createElement("label");
    endLabel.setAttribute("class", "form-label");
    endLabel.appendChild(End);

    var cLabel = document.createElement("label");
    cLabel.setAttribute("class", "form-label");
  cLabel.appendChild(Current);

    var head = document.createElement("input");
    head.setAttribute("type", "text");
    head.setAttribute("name", "n_e_name["+c+"]");
    head.setAttribute("placeholder", "Experience");
    head.setAttribute("class", "form-control");
    head.setAttribute("id", "heading");

    var role = document.createElement("input");
    role.setAttribute("type", "text");
    role.setAttribute("name", "n_e_role["+c+"]");
    role.setAttribute("placeholder", "Role/Title");
    role.setAttribute("class", "form-control");
    role.setAttribute("id", "role");

    var start_date = document.createElement("input");
    // start_date.setAttribute("type", "date");
    start_date.setAttribute("name", "n_start_date["+c+"]");
    start_date.setAttribute("class", "form-control")
    start_date.setAttribute("id", "datepicker"+c);
    start_date.setAttribute("placeholder", "mm/dd/yyy");
    start_date.setAttribute("style", "border: 1px solid rgb(131, 129, 129); height:45px;padding-left:5px;");

    var end_date = document.createElement("input");
    // end_date.setAttribute("type", "date");
    end_date.setAttribute("name", "n_end_date["+c+"]");
    end_date.setAttribute("class", "form-control");
     end_date.setAttribute("id", "datepicker"+cc);
    end_date.setAttribute("placeholder", "mm/dd/yyy");
    end_date.setAttribute("style", "border: 1px solid rgb(131, 129, 129); height:45px; padding-left:5px;");

    var current = document.createElement("input");
    current.setAttribute("type", "checkbox");
    current.setAttribute("name", "n_current["+c+"]");
    current.setAttribute("value", "1");
    // due_date.setAttribute("required", "required");
    current.setAttribute("id", "current");


    col.appendChild(headLabel);
    col.appendChild(head);

    col2.appendChild(roleLabel);
    col2.appendChild(role);

    col3.appendChild(startLabel);
    col3.appendChild(start_date);

    col4.appendChild(endLabel);
    col4.appendChild(end_date);

    col5.appendChild(cLabel);
    col5.appendChild(current);

    document.getElementsByClassName("expp")[0]
   .appendChild(col);
   document.getElementsByClassName("expp")[0]
   .appendChild(col2);
   document.getElementsByClassName("expp")[0]
   .appendChild(col3);
   document.getElementsByClassName("expp")[0]
   .appendChild(col5);
   document.getElementsByClassName("expp")[0]
   .appendChild(col4);
   document.getElementsByClassName("expp")[0]
   .appendChild(hr);

   $('#datepicker'+c).datepicker({
        uiLibrary: 'bootstrap3'
    });

    $('#datepicker'+cc).datepicker({
        uiLibrary: 'bootstrap3'
    });
    c=c+1;
    cc=cc+1;
    
    }

    // Education Background
    function add_education() {
    var hr = document.createElement("hr");
    hr.setAttribute("style", "margin:5px;");
    
    var Type = document.createTextNode("Degree");
    var Ins = document.createTextNode("Institude");
    var Major = document.createTextNode("Major");
    var Start = document.createTextNode("Start");
    var End = document.createTextNode("End");
    var Current = document.createTextNode("Current");

    var bsc = document.createTextNode("BSc");
    var msc = document.createTextNode("MSc");
    var phd = document.createTextNode("PhD");
    var hnd = document.createTextNode("HND");

    var col = document.createElement("div");
    col.setAttribute("class", "col-sm-6");

    var col2 = document.createElement("div");
    col2.setAttribute("class", "col-sm-6");

    var col3 = document.createElement("div");
    col3.setAttribute("class", "col-sm-12");
    
    var col4 = document.createElement("div");
    col4.setAttribute("class", "col-sm-5");

    var col5 = document.createElement("div");
    col5.setAttribute("class", "col-sm-2");

    var col6 = document.createElement("div");
    col6.setAttribute("class", "col-sm-5");

    var typeLabel = document.createElement("label");
    typeLabel.setAttribute("class", "form-label");
    typeLabel.appendChild(Type);

    var majorLabel = document.createElement("label");
    majorLabel.setAttribute("class", "form-label");
    majorLabel.appendChild(Major);

    var insLabel = document.createElement("label");
    insLabel.setAttribute("class", "form-label");
    insLabel.appendChild(Ins);

    var startLabel = document.createElement("label");
    startLabel.setAttribute("class", "form-label");
    startLabel.appendChild(Start);

    var endLabel = document.createElement("label");
    endLabel.setAttribute("class", "form-label");
    endLabel.appendChild(End);

    var cLabel = document.createElement("label");
    cLabel.setAttribute("class", "form-label");
    cLabel.appendChild(Current);

    var typeOpt1 = document.createElement("option");
    typeOpt1.setAttribute('value', 'BSc');
    typeOpt1.appendChild(bsc);
    var typeOpt2 = document.createElement("option");
    typeOpt2.setAttribute('value', 'MSc');
    typeOpt2.appendChild(msc);
    var typeOpt3 = document.createElement("option");
    typeOpt3.setAttribute('value', 'PhD');
    typeOpt3.appendChild(phd);
    var typeOpt4 = document.createElement("option");
    typeOpt4.setAttribute('value', 'HND');
    typeOpt4.appendChild(hnd);

    var type = document.createElement("select");
    type.setAttribute("type", "text");
    type.setAttribute("name", "n_b_type["+b+"]");
    type.setAttribute("placeholder", "Experience");
    type.setAttribute("class", "form-control");
    type.setAttribute("id", "type");
    type.appendChild(typeOpt1);
    type.appendChild(typeOpt2);
    type.appendChild(typeOpt3);
    type.appendChild(typeOpt4);

    var major = document.createElement("input");
    major.setAttribute("type", "text");
    major.setAttribute("name", "n_b_major["+b+"]");
    major.setAttribute("placeholder", "Physics/Electronics");
    major.setAttribute("class", "form-control");
    major.setAttribute("id", "major");

    var ins = document.createElement("input");
    ins.setAttribute("type", "text");
    ins.setAttribute("name", "n_b_institude["+b+"]");
    ins.setAttribute("placeholder", "University of Abuja");
    ins.setAttribute("class", "form-control");
    ins.setAttribute("id", "ins");

    var start_date = document.createElement("input");
    // start_date.setAttribute("type", "date");
    start_date.setAttribute("name", "n_b_start_date["+b+"]");
    start_date.setAttribute("class", "form-control");
    start_date.setAttribute("id", "datepickerr"+b);
    start_date.setAttribute("placeholder", "mm/dd/yyy");
    start_date.setAttribute("style", "border: 1px solid rgb(131, 129, 129); height:45px;padding-left:5px;");

    var end_date = document.createElement("input");
    // end_date.setAttribute("type", "date");
    end_date.setAttribute("name", "n_b_end_date["+b+"]");
    end_date.setAttribute("class", "form-control");
    end_date.setAttribute("id", "datepickerr"+bb);
    end_date.setAttribute("placeholder", "mm/dd/yyy");
    end_date.setAttribute("style", "border: 1px solid rgb(131, 129, 129); height:45px; padding-left:5px;");

    var current = document.createElement("input");
    current.setAttribute("type", "checkbox");
    current.setAttribute("name", "n_b_current["+b+"]");
    current.setAttribute("value", "1");
    // due_date.setAttribute("required", "required");
    current.setAttribute("id", "current");


    col.appendChild(typeLabel);
    col.appendChild(type);

    col2.appendChild(majorLabel);
    col2.appendChild(major);

    col3.appendChild(insLabel);
    col3.appendChild(ins);

    col4.appendChild(startLabel);
    col4.appendChild(start_date);

    col5.appendChild(cLabel);
    col5.appendChild(current);

    col6.appendChild(endLabel);
    col6.appendChild(end_date);

    document.getElementsByClassName("educc")[0]
   .appendChild(col);
   document.getElementsByClassName("educc")[0]
   .appendChild(col2);
   document.getElementsByClassName("educc")[0]
   .appendChild(col3);
   document.getElementsByClassName("educc")[0]
   .appendChild(col4);
   document.getElementsByClassName("educc")[0]
   .appendChild(col5);
   document.getElementsByClassName("educc")[0]
   .appendChild(col6);
   document.getElementsByClassName("educc")[0]
   .appendChild(hr);

    $('#datepickerr'+b).datepicker({
        uiLibrary: 'bootstrap3'
    });
    $('#datepickerr'+bb).datepicker({
        uiLibrary: 'bootstrap3'
    });
    b=b+1;
    bb=bb+1;
    }
</script>
@endsection
