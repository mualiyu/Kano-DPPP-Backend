<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\Bid;
use App\Models\Tender;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $tenders = Tender::where("status", "=", "open")->orderBy("created_at", "DESC")->get();
        $t_tenders = Tender::all();
        $t_bids = Bid::all();
        $t_vendors = Applicant::all();

        return view('home', compact("tenders", "t_bids", "t_tenders", "t_vendors"));
    }
}
