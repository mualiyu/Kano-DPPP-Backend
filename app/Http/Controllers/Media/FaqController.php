<?php

namespace App\Http\Controllers\Media;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FaqController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('MediaAuth');
    }

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faqs = Faq::orderBy('created_at', "DESC")->get();
        return view("media.faq.index", compact("faqs"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("media.faq.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required'],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $f = Faq::create([
            'title'=> $request->title,
            'content'=>$request->content,
        ]);

        if ($f) {
            return redirect()->route('faqs')->with("success", "New FAQ added");
        }else{
            return back()->with('error', "Failed to add FAQ, Try again later.");
        }

        abort(404);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function show(Faq $faq)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function edit(Faq $faq)
    {
        return view("media.faq.edit", compact('faq'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Faq $faq)
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required'],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $f = $faq->update([
            'title'=> $request->title,
            'content'=>$request->content,
        ]);

        if ($f) {
            return back()->with("success", "FAQ updated");
        }else{
            return back()->with('error', "Failed to update FAQ, Try again later.");
        }

        abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function destroy(Faq $faq)
    {
        $faq->delete();

        return redirect()->route('faqs')->with('success', "FAQ Deleted");
    }
}
