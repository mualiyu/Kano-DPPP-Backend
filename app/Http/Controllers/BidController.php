<?php

namespace App\Http\Controllers;

use App\Exports\BidExport;
use App\Mail\AcceptApplicantMail;
use App\Mail\AcceptBidMail;
use App\Models\Bid;
use App\Models\BidDocument;
use App\Models\Comment;
use App\Models\Tender;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class BidController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tenders = Tender::orderBy('created_at', 'desc')->paginate(5);
        return view('applications.index', compact("tenders"));
    }

    public function job_apps($id)
    {
        $applications = Bid::where('tender_id', '=', $id)->paginate(5);

        if (count($applications)>0) {
            $job = Job::find($id);
            return view('applications.job_applications', compact("applications", "job"));
        }else{
            abort(404);
        }
    }

    public function export_job_apps($id)
    {
        $applications = Bid::where('tender_id', '=', $id)->get();

        if (count($applications)>0) {
            $job = Job::find($id);
            return Excel::download(new BidExport($id), 'Bids_for_'.$job->name.'_job.xlsx');
            // return view('exports.apps', compact("applications", "job"));
        }else{
            abort(404);
        }
    }

    public function download_doc($id)
    {
        $application_doc = BidDocument::where(['id'=>$id])->get();

        if (count($application_doc)>0) {
            $a_doc = $application_doc[0];
            $storage = Storage::disk('local')->path('public/document/'.$a_doc->document);

            return response()->file($storage);
        }else{
            return abort(404);
            // return back()->with('error', 'File not found in database.');
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bid  $application
     * @return \Illuminate\Http\Response
     */
    public function show(Bid $application)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bid  $application
     * @return \Illuminate\Http\Response
     */
    public function edit(Bid $application)
    {
        //
    }


    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'status' => ['required'],
            'comment' => ['nullable'],
        ]);

        if ($validator->fails()) {
            return back()->with('error', $validator->errors());
        }

        $application = Bid::where('id','=',$id)->get();

        if (count($application)>0) {
            $application = $application[0];

            $update = Bid::where(['id'=>$application->id])->update([
                'status' => $request->status,
            ]);

            if ($update) {

                if (!$request->comment == Null) {
                    $comment = Comment::create([
                        'application_id'=> $application->id,
                        'comment' => $request->comment,
                        'type'=> $request->status,
                    ]);
                }

                if ($request->status == "Successful") {
                    $mailDataa = [
                        'user' => $application->applicant->name,
                        'job' => $application->job->name,
                        'body' => "We are pleased to inform you that your application for the ".$application->job->name." has been successful! On behalf of our team, we extend our warmest congratulations on this achievement.",
                        'thank' => "You are to proceed to the Rural Electrification Agency for further details.",
                    ];
                    Mail::to($application->applicant->email)->send(new AcceptBidMail($mailDataa));
                }elseif ($request->status == "Unsuccessful") {
                    $mailDataa = [
                        'user' => $application->applicant->name,
                        'job' => $application->job->name,
                        'body' => "We appreciate the time and effort you put into applying for the ".$application->job->name." role. We carefully reviewed your application, qualifications, and experience. While we recognize your skills and accomplishments, we regret to inform you that we have chosen another candidate more suited for the role. ",
                        'thank' => "Thank you for your understanding and once again, we appreciate your interest in us.",
                    ];
                    Mail::to($application->applicant->email)->send(new AcceptBidMail($mailDataa));
                }else{
                    $mailData = [
                        'title' => 'Bid update By Admin.',
                        'body' => "Your Bid for ".$application->job->name." has been ".$request->status.", \n ".$request->comment!=Null ? $request->comment:'........'.". \n",
                    ];

                    Mail::to($application->applicant->email)->send(new AcceptApplicantMail($mailData));
                }

                return back()->with('success', 'An email has been sent to '.$application->applicant->name.' ('.$application->applicant->email.') regarding this application update.');
            }else{
                return back()->with('error', "Failed to update status.");
            }
        }else{
            abort(404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bid  $application
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bid $application)
    {
        //
    }
}
