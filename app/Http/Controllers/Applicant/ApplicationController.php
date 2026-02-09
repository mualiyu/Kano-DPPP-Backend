<?php

namespace App\Http\Controllers\Applicant;

use App\Http\Controllers\Controller;
use App\Models\Bid;
use App\Models\BidDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApplicationController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $applicant = session('Applicant');

        $applications = Bid::where(['vendor_id'=>$applicant->id])->paginate(5);

        return view('applicants.applications.index', compact("applicant", "applications"));
    }

    public function show($id)
    {
        $applicant = session('Applicant');

        $app = Bid::where(['id'=>$id])->get();

        if (count($app)>0) {
            $app = $app[0];
            return view('applicants.applications.info', compact("applicant", "app"));
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
}
