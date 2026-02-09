<?php

namespace App\Http\Controllers\Media;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VideoController extends Controller
{   
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
        $videos = Video::orderBy('created_at', "DESC")->get();
        return view("media.video.index", compact("videos"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("media.video.create");
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
            'desc' => ['required'],
            'link' => ['required'],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $v = Video::create([
            'title'=> $request->title,
            'description'=>$request->desc,
            'link' => $request->link,
        ]);

        if ($v) {
            return redirect()->route('videos')->with("success", "New video added");
        }else{
            return back()->with('error', "Failed to add video, Try again later.");
        }

        abort(404);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function show(Video $video)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function edit(Video $video)
    {
        return view("media.video.edit", compact('video'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Video $video)
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string', 'max:255'],
            'desc' => ['required'],
            'link' => ['required'],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $v = $video->update([
            'title'=> $request->title,
            'description'=>$request->desc,
            'link' => $request->link,
        ]);

        if ($v) {
            return back()->with("success", "video Updated");
        }else{
            return back()->with('error', "Failed to update video, Try again later.");
        }

        abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function destroy(Video $video)
    {
         $video->delete();

        return redirect()->route('videos')->with('success', "video Deleted");
    }
}
