<?php

namespace App\Http\Controllers;

use App\Models\BusinessCategory;
use App\Models\BusinessSubCategory;
use App\Models\Job;
use App\Models\JobContent;
use App\Models\JobDocument;
use App\Models\JobMilestone;
use App\Models\JobReporting;
use App\Models\JobRequirement;
use App\Models\Mda;
use App\Models\Requisition;
use App\Models\SysRequirement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class JobController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Generate a unique tender number
     *
     * @return string
     */
    private function generateTenderNumber()
    {
        do {
            $tenderNumber = 'TDR-' . date('Y') . '-' . str_pad(mt_rand(1, 999999), 6, '0', STR_PAD_LEFT);
        } while (Job::where('tender_number', $tenderNumber)->exists());

        return $tenderNumber;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobs = Job::orderBy("created_at", "DESC")->paginate(5);

        return view('jobs.index', compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $b_categories = BusinessCategory::all();
        $sys_requirements = SysRequirement::all();
        $mdas = Mda::active()->get();
        $requisitions = Requisition::approved()->get();

        return view('jobs.create', compact('b_categories', 'sys_requirements', 'mdas', 'requisitions'));
    }

    public function get_b_s_c(Request $request)
    {
        if ($request->ajax()) {
            $output = "";

            $b_sub_c = BusinessSubCategory::where(['b_c_id'=> $request->data])->get();

            $data = $b_sub_c;
            // return $data;

            if (count($data) > 0) {
                // $output .= '<option disabled selected>Select Station</option>';
                foreach ($data as $row) {
                    $output .= '<div class="form-check form-check-inline mb-0"><input class="form-check-input" type="checkbox" name="b_sub_c_id['.$row->id.']" value="'.$row->id.'" id="c-'.$row->id.'"><label class="form-check-label" for="c-'.$row->id.'">'.$row->name.'</label></div>';
                }
            } else {

                $output .= '<div class="form-check form-check-inline mb-0"><label class="form-check-label">No Sub-Categories found in database</label></div>';
            }

            return $output;
        }else{
            abort(404);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'mda_id' => ['required', 'exists:mdas,id'],
            'requisition_id' => ['nullable', 'exists:requisitions,id'],
            'estimated_value' => ['nullable', 'numeric', 'min:0'],
            'currency' => ['nullable', 'string', 'max:3'],
            'tender_type' => ['nullable', 'string'],
            'c_type' => ['required'],
            'sys_r' => ['nullable'],
            'tor' => ['nullable'],
            'j_status' => ['required'],
            'open_date' => ['required'],
            'close_date' => ['required'],
            'opening_date' => ['nullable', 'date'],
            'closing_date' => ['nullable', 'date'],
            'evaluation_start_date' => ['nullable', 'date'],
            'evaluation_end_date' => ['nullable', 'date'],
            'bid_security_amount' => ['nullable', 'numeric', 'min:0'],
            'performance_security_amount' => ['nullable', 'numeric', 'min:0'],
            'contract_duration_days' => ['nullable', 'integer', 'min:0'],
            'special_conditions' => ['nullable', 'string'],
            'c_heading' => ['nullable'],
            'c_content' => ['nullable'],
            // new report
            'r_heading' => ['nullable'],
            'r_content' => ['nullable'],
            'm_heading' => ['nullable'],
            'm_content' => ['nullable'],
            'm_due_date' => ['nullable'],
            'doc_name' => ['nullable'],
            'p_e_r' => ['nullable'],
            'e_b' => ['nullable'],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if ($request->open_date > $request->close_date) {
            return back()->with('error', "Sorry Close date have to be equal or greater than Open date.");
        }

        if ($request->hasFile("tor")) {
            $imageNameWExt = $request->file("tor")->getClientOriginalName();
            $imageName = pathinfo($imageNameWExt, PATHINFO_FILENAME);
            $imageExt = $request->file("tor")->getClientOriginalExtension();

            $imageNameToStore = $imageName . "_" . time() . "." . $imageExt;

            $request->file("tor")->storeAs("public/document", $imageNameToStore);
        } else {
            $image_url = null;
            $imageNameToStore = null;
        }


        // Generate unique tender number
        $tenderNumber = $this->generateTenderNumber();

        $job = Job::create([
            'tender_number' => $tenderNumber,
            'requisition_id' => $request->requisition_id,
            'mda_id' => $request->mda_id,
            'name'=> $request->name,
            'description' => $request->description,
            'estimated_value' => $request->estimated_value,
            'currency' => $request->currency ?? 'NGN',
            'tender_type' => $request->tender_type,
            'status'=> $request->j_status,
            'opening_date' => $request->opening_date ?? $request->open_date,
            'closing_date' => $request->closing_date ?? $request->close_date,
            'evaluation_start_date' => $request->evaluation_start_date,
            'evaluation_end_date' => $request->evaluation_end_date,
            'bid_security_amount' => $request->bid_security_amount,
            'performance_security_amount' => $request->performance_security_amount,
            'contract_duration_days' => $request->contract_duration_days,
            'special_conditions' => $request->special_conditions,
            'created_by' => auth()->id(),
            // Legacy fields for backward compatibility
            'open_date'=>$request->open_date,
            'close_date'=>$request->close_date,
            'consultancy_type'=>$request->c_type,
            'tor'=>$imageNameToStore,
            'p_e_r'=>$request->p_e_r,
            'e_b'=> $request->e_b,
        ]);

        if ($job) {
            // if (!empty($request->b_sun_c_id)) {
            //     foreach ($request->b_sub_c_id as $key => $bsc) {
            //         $sub_business_job = DB::table("business_sub_category_job")->insert([
            //             'business_sub_category_id'=> $bsc,
            //             'tender_id'=>$job->id,
            //         ]);
            //     }
            // }
            if (!empty($request->sys_r)) {
                foreach ($request->sys_r as $key => $ss) {
                    $job_requirement = JobRequirement::create([
                        'sys_id'=>$ss,
                        'tender_id'=>$job->id,
                    ]);
                }
            }

            if (!empty($request->c_heading)) {
                foreach ($request->c_heading as $key => $ch) {
                    if (!$ch == Null) {
                        $job_content = JobContent::create([
                            'tender_id'=>$job->id,
                            'heading'=> $ch,
                            'content'=>$request->c_content[$key],
                            'num'=> $key,
                        ]);
                    }
                }
            }

            // reporting section
            if (!empty($request->r_heading)) {
                foreach ($request->r_heading as $key => $rh) {
                    if (!$rh == Null) {
                        $job_report = JobReporting::create([
                            'tender_id'=>$job->id,
                            'heading'=> $rh,
                            'content'=>$request->r_content[$key],
                            'num'=> $key,
                        ]);
                    }
                }
            }

            if (!empty($request->m_heading)) {
                foreach ($request->m_heading as $key => $mh) {
                    if (!$mh == Null) {
                        $job_milestone = JobMilestone::create([
                            'tender_id'=>$job->id,
                            'heading'=> $mh,
                            'content'=>$request->m_content[$key],
                            // 'due_date'=>$request->m_due_date[$key],
                            'num'=> $key,
                        ]);
                    }
                }
            }

            if (!empty($request->doc_name)) {
                foreach ($request->doc_name as $key => $n) {
                    if (!$n == NUll) {
                        $job_document = JobDocument::create([
                            'tender_id'=>$job->id,
                            'name'=> $n,
                        ]);
                    }
                }
            }

            return redirect()->route('jobs')->with("success", "Tender has been created and is open for bids");
        }else{
            return back()->with("error", "Failed to Create New Tender");
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function show(Job $job)
    {
        return view('jobs.info', compact('job'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function edit(Job $job)
    {
        $sys_requirements = SysRequirement::all();
        $mdas = Mda::active()->get();
        $requisitions = Requisition::approved()->get();
        return view('jobs.edit', compact('job', 'sys_requirements', 'mdas', 'requisitions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Job $job)
    {
        // return $request->all();

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'mda_id' => ['nullable', 'exists:mdas,id'],
            'requisition_id' => ['nullable', 'exists:requisitions,id'],
            'estimated_value' => ['nullable', 'numeric', 'min:0'],
            'currency' => ['nullable', 'string', 'max:3'],
            'tender_type' => ['nullable', 'string'],
            'open_date' => ['required'],
            'c_type' => ['nullable'],
            'tor' => ['nullable'],
            'status' => ['required'],
            'close_date' => ['required'],
            'opening_date' => ['nullable', 'date'],
            'closing_date' => ['nullable', 'date'],
            'evaluation_start_date' => ['nullable', 'date'],
            'evaluation_end_date' => ['nullable', 'date'],
            'bid_security_amount' => ['nullable', 'numeric', 'min:0'],
            'performance_security_amount' => ['nullable', 'numeric', 'min:0'],
            'contract_duration_days' => ['nullable', 'integer', 'min:0'],
            'special_conditions' => ['nullable', 'string'],
            'n_c_heading' => ['nullable'],
            'n_c_content' => ['nullable'],
            // report
            'n_r_heading' => ['nullable'],
            'n_r_content' => ['nullable'],
            'r_heading' => ['nullable'],
            'r_content' => ['nullable'],

            'n_m_heading' => ['nullable'],
            'n_m_content' => ['nullable'],
            'n_m_due_date' => ['nullable'],
            'n_doc_name' => ['nullable'],
            //
            'c_heading' => ['nullable'],
            'c_content' => ['nullable'],
            'm_heading' => ['nullable'],
            'm_content' => ['nullable'],
            'm_due_date' => ['nullable'],
            'doc_name' => ['nullable'],
            'p_e_r' => ['nullable'],
            'e_b' => ['nullable'],
            'sys_r' => ['nullable'],
        ]);

        if ($validator->fails()) {
            // return "vali";
            return back()->with("error", $validator->errors());
        }

        if ($request->hasFile("tor")) {
            $imageNameWExt = $request->file("tor")->getClientOriginalName();
            $imageName = pathinfo($imageNameWExt, PATHINFO_FILENAME);
            $imageExt = $request->file("tor")->getClientOriginalExtension();

            $imageNameToStore = $imageName . "_" . time() . "." . $imageExt;

            $request->file("tor")->storeAs("public/document", $imageNameToStore);
        } else {
            $image_url = null;
            $imageNameToStore = $job->tor;
        }

        if ($request->p_e_r) {
            $per=$request->p_e_r;
        }else{
            $per=0;
        }

        if ($request->e_b) {
            $ebb=$request->e_b;
        }else{
            $ebb=0;
        }

        $j = $job->update([
            'name'=> $request->name,
            'description' => $request->description,
            'requisition_id' => $request->requisition_id,
            'mda_id' => $request->mda_id,
            'estimated_value' => $request->estimated_value,
            'currency' => $request->currency,
            'tender_type' => $request->tender_type,
            'status'=> $request->status,
            'opening_date' => $request->opening_date,
            'closing_date' => $request->closing_date,
            'evaluation_start_date' => $request->evaluation_start_date,
            'evaluation_end_date' => $request->evaluation_end_date,
            'bid_security_amount' => $request->bid_security_amount,
            'performance_security_amount' => $request->performance_security_amount,
            'contract_duration_days' => $request->contract_duration_days,
            'special_conditions' => $request->special_conditions,
            // Legacy fields for backward compatibility
            'open_date'=>$request->open_date,
            'close_date'=>$request->close_date,
            'consultancy_type' => $request->c_type,
            'tor'=>$imageNameToStore,
            'p_e_r'=>$per,
            'e_b'=>$ebb,
        ]);

        Job::where('id', '=', $job->id)->update([
            'e_b'=>$ebb,
        ]);

        if ($j) {
            // if (!empty($request->b_sun_c_id)) {
            //     foreach ($request->b_sub_c_id as $key => $bsc) {
            //         $sub_business_job = DB::table("business_sub_category_job")->insert([
            //             'business_sub_category_id'=> $bsc,
            //             'tender_id'=>$job->id,
            //         ]);
            //     }
            // }

            if (!empty($request->sys_r)) {
                if (count($job->job_requirements)>0) {
                    foreach ($job->job_requirements as $jrr) {
                        JobRequirement::where('id', $jrr->id)->delete();
                    }
                }
                foreach ($request->sys_r as $key => $ss) {
                    $job_requirement = JobRequirement::create([
                        'sys_id'=>$ss,
                        'tender_id'=>$job->id,
                    ]);
                }
            }

            // updateing current data's
            if (!empty($request->n_c_heading)) {
                foreach ($request->n_c_heading as $key => $nch) {
                    if (!$nch == Null) {
                        $n_job_content = JobContent::where(['id'=>$key])->update([
                            'heading'=> $nch,
                            'content'=>$request->n_c_content[$key],
                        ]);
                    }
                }
            }
            // report update
            if (!empty($request->n_r_heading)) {
                foreach ($request->n_r_heading as $key => $nrh) {
                    if (!$nrh == Null) {
                        $n_job_report = JobReporting::where(['id'=>$key])->update([
                            'heading'=> $nrh,
                            'content'=>$request->n_r_content[$key],
                        ]);
                    }
                }
            }

            if (!empty($request->n_m_heading)) {
                foreach ($request->n_m_heading as $key => $nmh) {
                    if (!$nmh == Null) {
                        $n_job_milestone = JobMilestone::where(['id'=>$key])->update([
                            'heading'=> $nmh,
                            'content'=>$request->n_m_content[$key],
                            // 'due_date'=>$request->n_m_due_date[$key],
                        ]);
                    }
                }
            }

            if (!empty($request->n_doc_name)) {
                foreach ($request->n_doc_name as $key => $nn) {
                    if (!$nn == NUll) {
                        $n_job_document = JobDocument::where(['id'=>$key])->update([
                            'name'=> $nn,
                        ]);
                    }
                }
            }

            // Inserting New data's
            if (!empty($request->c_heading)) {
                foreach ($request->c_heading as $key => $ch) {
                    if (!$ch == Null) {
                        $job_content = JobContent::create([
                            'tender_id'=>$job->id,
                            'heading'=> $ch,
                            'content'=>$request->c_content[$key],
                            'num'=> $key,
                        ]);
                    }
                }
            }

            if (!empty($request->r_heading)) {
                foreach ($request->r_heading as $key => $rh) {
                    if (!$rh == Null) {
                        $job_report = JobReporting::create([
                            'tender_id'=>$job->id,
                            'heading'=> $rh,
                            'content'=>$request->r_content[$key],
                            'num'=> $key,
                        ]);
                    }
                }
            }

            if (!empty($request->m_heading)) {
                foreach ($request->m_heading as $key => $mh) {
                    if (!$mh == Null) {
                        $job_milestone = JobMilestone::create([
                            'tender_id'=>$job->id,
                            'heading'=> $mh,
                            'content'=>$request->m_content[$key],
                            // 'due_date'=>$request->m_due_date[$key],
                            'num'=> $key,
                        ]);
                    }
                }
            }

            if (!empty($request->doc_name)) {
                foreach ($request->doc_name as $key => $n) {
                    if (!$n == NUll) {
                        $job_document = JobDocument::create([
                            'tender_id'=>$job->id,
                            'name'=> $n,
                        ]);
                    }
                }
            }

            return back()->with("success", "Tender has been Updated");
        }else{
            // return "Fail";
            return back()->with("error", "Failed to Update Tender");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function destroy(Job $job)
    {
        $job->job_contents()->delete();
        $job->job_reports()->delete();
        $job->job_milestones()->delete();
        $job->job_docs()->delete();
        $job->job_requirements()->delete();
        $job->app_requirements()->delete();

        if (count($job->bids)) {
            foreach ($job->bids as $key => $bid) {
                $bid->applicationDocuments()->delete();
                $bid->comments()->delete();
                $bid->appRequirements()->delete();
                $bid->experiences()->delete();
                $bid->educations()->delete();

                $bid->delete();
            }
        }

        $job->delete();

        return back()->with("info", "You have successfuly deleted a TENDER together with it's Bids, Thank you.");
    }

    public function delete_milestone($id)
    {
        $mile = JobMilestone::where('id', '=', $id)->get();

        if (count($mile)>0) {
            # code...
            $delete = JobMilestone::where('id', '=', $id)->delete();
            return back()->with('success', 'Milestone is deleted successful.');
        }else{
            abort(404);
        }
    }

    public function delete_content($id)
    {
        $cont = JobContent::where('id', '=', $id)->get();

        if (count($cont)>0) {

            $delete = JobContent::where('id', '=', $id)->delete();
            return back()->with('success', 'Content is deleted successful.');
        }else{

            abort(404);
        }
    }

    public function delete_report($id)
    {
        $cont = JobReporting::where('id', '=', $id)->get();

        if (count($cont)>0) {

            $delete = JobReporting::where('id', '=', $id)->delete();
            return back()->with('success', 'Report is deleted successful.');
        }else{
            abort(404);
        }
    }

    public function delete_doc($id)
    {
        $cont = JobDocument::where('id', '=', $id)->get();

        if (count($cont)>0) {
            try {
                $delete =JobDocument::where('id', '=', $id)->delete();
                //code...
            } catch (\Throwable $th) {
                //throw $th;
                return back()->with('error', 'Sorry we can not delete this document type because applicant have already started uploading this document. Thank you for understanding.');
            }
            return back()->with('success', $cont[0]->name.' has been deleted successful.');
        }else{
            abort(404);
        }
    }

    public function download_doc($id)
    {
        $job = Job::find($id);

        if ($job) {
            $storage = storage_path('app/public/document/'.$job->tor);

            return response()->file($storage);
        }else{
            return abort(404);
            // return back()->with('error', 'File not found in database.');
        }
    }
}
