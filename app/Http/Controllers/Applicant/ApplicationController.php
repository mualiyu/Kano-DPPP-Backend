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

        $app = Bid::with(['app_requirements', 'job', 'experiences', 'educations', 'application_documents', 'comments'])->where(['id'=>$id])->first();

        if ($app) {
            return view('applicants.applications.info', compact("applicant", "app"));
        }else{
            abort(404);
        }
    }

    /**
     * Download a file uploaded as part of an application requirement (stored in public/documents).
     */
    public function download_requirement_file($filename)
    {
        $filename = basename(urldecode($filename));
        if ($filename === '' || strpos($filename, '..') !== false) {
            abort(404);
        }
        // Try public/documents first, then storage (for backwards compatibility)
        $path = public_path('documents/' . $filename);
        if (! file_exists($path) || ! is_file($path)) {
            $path = Storage::disk('local')->path('public/document/' . $filename);
        }
        if (! file_exists($path) || ! is_file($path)) {
            abort(404);
        }
        return response()->download($path, $filename, ['Content-Type' => 'application/pdf']);
    }

    /**
     * View a requirement file in the browser (e.g. PDF in new tab).
     */
    public function view_requirement_file($filename)
    {
        $filename = basename(urldecode($filename));
        if ($filename === '' || strpos($filename, '..') !== false) {
            abort(404);
        }
        $path = public_path('documents/' . $filename);
        if (! file_exists($path) || ! is_file($path)) {
            $path = Storage::disk('local')->path('public/document/' . $filename);
        }
        if (! file_exists($path) || ! is_file($path)) {
            abort(404);
        }
        return response()->file($path);
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
