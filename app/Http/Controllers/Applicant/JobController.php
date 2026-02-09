<?php

namespace App\Http\Controllers\Applicant;

use App\Http\Controllers\Controller;
use App\Models\AppEducation;
use App\Models\AppExperience;
use App\Models\Bid;
use App\Models\BidDocument;
use App\Models\AppRequirement;
use App\Models\Job;
use Illuminate\Http\Request;
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
        $this->middleware('ApplicantAuth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $applicant = session('Applicant');

        $date = date('Y-m-d');
        // return $date;

        // List open tenders (jobs) for applicants
        $tenders = Job::where('status', '=', 'Open')->orderBy("created_at", "desc")->paginate(5);

        return view('applicants.jobs.index', compact('tenders'));
    }

    public function show_apply($id)
    {
        $applicant = session('Applicant');

        $job = Job::where('id', '=', $id)->get();

        if (count($job) === 0) {
            abort(404);
        }

        $job = $job[0];

        // Ensure tender is open
        if (strtolower($job->status) !== 'open') {
            return back()->with('warning', "This job is not open for bids. Try again later, thank you.");
        }

        // Restrict the number of bids per applicant (max 2)
        $totalBidsForApplicant = Bid::where('vendor_id', $applicant->id)->count();
        if ($totalBidsForApplicant >= 2) {
            return back()->with('warning', "This account has exceeded the number of bids allowed. Thank you.");
        }

        return view('applicants.jobs.apply', compact('job'));

    }

    public function job_info($id)
    {
        $applicant = session('Applicant');

        $job = Job::where('id', '=', $id)->get();

        if (count($job) === 0) {
            abort(404);
        }

        $job = $job[0];

        // Bids by this applicant for this job/tender
        $app = Bid::where([
            'vendor_id' => $applicant->id,
            'tender_id' => $job->id,
        ])->get();

        return view('applicants.jobs.info', compact('job', 'app'));
    }

    public function show_update_app($id)
    {
        $applicant = session('Applicant');

        $bid = Bid::where(['tender_id'=> $id, 'vendor_id'=>$applicant->id])->get();

        if (count($bid)>0) {
            $app = $bid[0];
            return view('applicants.applications.edit', compact('app'));
        }else{
            abort(404);
        }
    }

    public function apply(Request $request, $id)
    {
        $applicant = session('Applicant');

        // return $request->all();

        $validator = Validator::make($request->all(), [
            "num"=>['required'],
            'job' => ['required'],
            'n_e_name' => ['nullable'],
            'n_start_date' => ['nullable'],
            'n_end_date' => ['nullable'],
            'n_e_role' => ['nullable'],
            'n_current' => ['nullable'],

            'n_b_type' => ['nullable'],
            'n_b_major' => ['nullable'],
            'n_b_institude' => ['nullable'],
            'n_b_start_date' => ['nullable'],
            'n_b_end_date' => ['nullable'],
            'n_b_current' => ['nullable'],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $job = Job::where('id', '=', $request->job)->get();

        if (count($job) === 0) {
            return back()->with('error', "The job you are applying for was not found in the system.");
        }

        $job = $job[0];

        // Restrict the number of bids per applicant (max 2)
        $totalBidsForApplicant = Bid::where('vendor_id', $applicant->id)->count();
        if ($totalBidsForApplicant >= 2) {
            return back()->with('warning', "This account has exceeded the number of bids allowed. Thank you.");
        }

        // Ensure job is open
        if (strtolower($job->status) !== 'open') {
            return back()->with('error', "This job is not open for bid.");
        }

        // Prevent duplicate bid for same job
        $existingBid = Bid::where([
            'vendor_id' => $applicant->id,
            'tender_id' => $job->id,
        ])->first();

        if ($existingBid) {
            return back()->with('error', "You've already applied for this job.");
        }

        $bid = Bid::create([
            "vendor_id" => $applicant->id,
            "tender_id"=> $job->id,
            "status"=> "Submitted",
        ]);

        if (!$bid) {
            return back()->with('error', "Failed to apply, try again later.");
        }

        // Handle supporting documents
        if ((int) $request->num > 0 && !empty($request->doc_id)) {
            foreach ($request->doc_id as $key => $doc_id) {
                $doc = "doc".$key;
                if ($request->hasFile($doc)) {
                    $fileNameWExt = $request->file($doc)->getClientOriginalName();
                    $fileName = pathinfo($fileNameWExt, PATHINFO_FILENAME);
                    $fileExt = $request->file($doc)->getClientOriginalExtension();

                    if ($fileExt !== "pdf") {
                        $bid->delete();
                        return back()->with('error', "File is not PDF");
                    }

                    $fileNameToStore = $fileName . "_" . time() . "." . $fileExt;
                    $request->file($doc)->storeAs("public/document", $fileNameToStore);

                    BidDocument::create([
                        'application_id' => $bid->id,
                        'job_doc_id'     => $doc_id,
                        'document'       => $fileNameToStore,
                    ]);
                }
            }
        }

        // Dynamic application requirements
        if (!empty($request->app_r_name)) {
            foreach ($request->app_r_name as $key => $arn) {
                if (!empty($request->app_r_value)) {
                    $arv = array_key_exists($key,$request->app_r_value) ? $request->app_r_value[$key]:null;
                    AppRequirement::create([
                        'name'      => $arn,
                        'value'     => $arv,
                        'type'      => $request->app_r_type[$key],
                        'tender_id' => $job->id,
                        'sys_id'    => $key,
                        'app_id'    => $bid->id,
                    ]);
                }
            }
        }

        // Experiences
        if (!empty($request->n_e_name)) {
            foreach ($request->n_e_name as $key => $nen) {
                if (!$nen == null) {
                    if ($request->n_e_role[$key]==null && $request->n_start_date[$key]==null) {
                        if (isset($request->n_current) && array_key_exists($key,$request->n_current)) {
                            $cc = $request->n_current[$key];
                        }else{
                            $cc = "";
                        }

                        if (isset($request->n_end_date) && array_key_exists($key,$request->n_end_date)) {
                            $ce = $request->n_end_date[$key];
                        }else{
                            $ce = "";
                        }

                        AppExperience::create([
                            'app_id'    => $bid->id,
                            'name'      => $nen,
                            'role'      => $request->n_e_role[$key],
                            'start'     => $request->n_start_date[$key],
                            'end'       => $ce,
                            'currently' => $cc,
                        ]);
                    }else{
                        return redirect()->route('app_applications')->with('info', 'Bid is submitted successfully, but something is missing from your experience. Thank you.');
                    }
                }
            }
        }

        // Education
        if (!empty($request->n_b_major)) {
            foreach ($request->n_b_major as $key => $nbm) {
                if (!$nbm == null) {
                    if ((!$request->n_b_type[$key]==null) && (!$request->n_b_institude[$key]==null) && (!$request->n_b_start_date[$key]==null)) {
                        if (isset($request->n_b_current) && array_key_exists($key,$request->n_b_current)) {
                            $ccc = $request->n_b_current[$key];
                        }else{
                            $ccc = "";
                        }

                        if (isset($request->n_b_end_date) && array_key_exists($key,$request->n_b_end_date)) {
                            $cce = $request->n_b_end_date[$key];
                        }else{
                            $cce = "";
                        }

                        AppEducation::create([
                            'app_id'    => $bid->id,
                            'type'      => $request->n_b_type[$key],
                            'major'     => $nbm,
                            'institute' => $request->n_b_institude[$key],
                            'start'     => $request->n_b_start_date[$key],
                            'end'       => $cce,
                            'currently' => $ccc,
                        ]);
                    }else{
                        return redirect()->route('app_applications')->with('info', 'Bid is submitted successfully, but something is missing from your educational background. Thank you.');
                    }
                }
            }
        }

        return redirect()->route('app_applications')->with('success', 'Bid is submitted successfully. Thank you.');
    }

    // Update Bid
    public function update_app(Request $request, $id)
    {
        $applicant = session('Applicant');

        // return $request->all();

        $validator = Validator::make($request->all(), [
            "num"=>['required'],
            'job' => ['required'],

            'n_e_name' => ['nullable'],
            'n_start_date' => ['nullable'],
            'n_end_date' => ['nullable'],
            'n_e_role' => ['nullable'],
            'n_current' => ['nullable'],

            'n_b_type' => ['nullable'],
            'n_b_major' => ['nullable'],
            'n_b_institude' => ['nullable'],
            'n_b_start_date' => ['nullable'],
            'n_b_end_date' => ['nullable'],
            'n_b_current' => ['nullable'],
        ]);



        if ($validator->fails()) {
            // return "vali";
            return back()->with($validator->errors());
        }

        $job = Job::where('id', '=', $request->job)->get();

        if (count($job) === 0) {
            return back()->with('error', "The job you are applying for has not been found in the system.");
        }

        $job = $job[0];

        $bidCollection = Bid::where(['vendor_id'=>$applicant->id, 'tender_id'=>$job->id])->get();

        if (count($bidCollection) > 0) {
            $bidModel = $bidCollection[0];

            $updated = Bid::where('id','=', $bidModel->id)->update([
                "status"=> "Submitted",
            ]);

            // Reload fresh instance with relations
            $bid = Bid::find($bidModel->id);

            if ($bid) {
                if (count($bid->application_documents)>0) {
                    foreach ($bid->application_documents as $bid_doc) {
                        BidDocument::where('id', '=', $bid_doc->id)->delete();
                    }
                }

                if (count($bid->app_requirements)>0) {
                    foreach ($bid->app_requirements as $bid_r) {
                        AppRequirement::where('id', '=', $bid_r->id)->delete();
                    }
                }
                if (count($bid->experiences)>0) {
                    foreach ($bid->experiences as $bid_ex) {
                        AppExperience::where('id', '=', $bid_ex->id)->delete();
                    }
                }
                if (count($bid->educations)>0) {
                    foreach ($bid->educations as $bid_ed) {
                        AppEducation::where('id', '=', $bid_ed->id)->delete();
                    }
                }

                if ($updated) {
                    // Handle supporting documents
                    if ((int) $request->num > 0 && !empty($request->doc_id)) {
                        foreach ($request->doc_id as $key => $doc_id) {
                            $doc = "doc".$key;
                            if ($request->hasFile($doc)) {
                                $fileNameWExt = $request->file($doc)->getClientOriginalName();
                                $fileName = pathinfo($fileNameWExt, PATHINFO_FILENAME);
                                $fileExt = $request->file($doc)->getClientOriginalExtension();

                                if ($fileExt !== "pdf") {
                                    return back()->with('error', "File is not PDF");
                                }

                                $fileNameToStore = $fileName . "_" . time() . "." . $fileExt;
                                $request->file($doc)->storeAs("public/document", $fileNameToStore);

                                BidDocument::create([
                                    'application_id' => $bid->id,
                                    'job_doc_id'     => $doc_id,
                                    'document'       => $fileNameToStore,
                                ]);
                            }
                        }
                    }

                    // Dynamic application requirements
                    if (!empty($request->app_r_name)) {
                        foreach ($request->app_r_name as $key => $arn) {
                            $arv = array_key_exists($key,$request->app_r_value) ? $request->app_r_value[$key]:null;
                            AppRequirement::create([
                                'name'      => $arn,
                                'value'     => $arv,
                                'type'      => $request->app_r_type[$key],
                                'tender_id' => $job->id,
                                'sys_id'    => $key,
                                'app_id'    => $bid->id,
                            ]);
                        }
                    }

                    // Experiences
                    if (!empty($request->n_e_name)) {
                        foreach ($request->n_e_name as $key => $nen) {
                            if (!$nen == null) {
                                if ((!$request->n_e_role[$key]==null) && (!$request->n_start_date[$key]==null)) {
                                    if (isset($request->n_current) && array_key_exists($key,$request->n_current)) {
                                        $ccc = $request->n_current[$key];
                                    }else{
                                        $ccc = "";
                                    }

                                    if (isset($request->n_end_date) && array_key_exists($key,$request->n_end_date)) {
                                        $cce = $request->n_end_date[$key];
                                    }else{
                                        $cce = "";
                                    }

                                    AppExperience::create([
                                        'app_id' => $bid->id,
                                        'name' => $nen,
                                        'role' => $request->n_e_role[$key],
                                        'start' => $request->n_start_date[$key],
                                        'end' => $cce,
                                        'currently' => $ccc,
                                    ]);
                                }else{
                                    return redirect()->route('app_applications')->with('info', 'Bid is submitted successfully, but something is missing from your experience. Thank you.');
                                }
                            }
                        }
                    }

                    // Education
                    if (!empty($request->n_b_major)) {
                        foreach ($request->n_b_major as $key => $nbm) {
                            if (!$nbm == null) {
                                if ((!$request->n_b_type[$key]==null) && (!$request->n_b_institude[$key]==null) && (!$request->n_b_start_date[$key]==null)) {
                                    if (isset($request->n_b_current) && array_key_exists($key,$request->n_b_current)) {
                                        $cc = $request->n_b_current[$key];
                                    }else{
                                        $cc = "";
                                    }

                                    if (isset($request->n_b_end_date) && array_key_exists($key,$request->n_b_end_date)) {
                                        $ce = $request->n_b_end_date[$key];
                                    }else{
                                        $ce = "";
                                    }

                                    AppEducation::create([
                                        'app_id' => $bid->id,
                                        'type' => $request->n_b_type[$key],
                                        'major' => $nbm,
                                        'institute' => $request->n_b_institude[$key],
                                        'start' => $request->n_b_start_date[$key],
                                        'end' => $ce,
                                        'currently' => $cc,
                                    ]);
                                }else{
                                    return redirect()->route('app_applications')->with('info', 'Bid is submitted successfully, but something is missing from your educational background. Thank you.');
                                }
                            }
                        }
                    }
                } else {
                    return back()->with('error', "Failed to update bid, try again later.");
                }
            } else {
                return back()->with('error', "Failed to load your bid.");
            }
        } else {
            return back()->with('error', "Your application is not found.");
        }

        return redirect()->route('app_applications')->with('success', 'Bid update is submitted successfully. Thank you.');
    }

    public function download_doc($id)
    {
        $job = Job::find($id);

        if ($job) {
            $storage = Storage::disk('local')->path('public/document/'.$job->tor);

            return response()->file($storage);
        }else{
            return abort(404);
            // return back()->with('error', 'File not found in database.');
        }
    }
}
