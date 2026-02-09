<?php

namespace App\Http\Controllers\Applicant;

use App\Http\Controllers\Controller;
use App\Models\Bid;
use Illuminate\Http\Request;

class HomeController extends Controller
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

        return view('applicants.home', compact("applicant", "applications"));
    }


}
