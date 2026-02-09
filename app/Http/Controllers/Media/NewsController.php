<?php

namespace App\Http\Controllers\Media;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\NewsContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NewsController extends Controller
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
        $news = News::orderBy('created_at', "DESC")->get();
        return view("media.news.index", compact("news"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("media.news.create");
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
            'desc' => ['nullable'],
            'c_n' => ['nullable'],
            'c_heading' => ['nullable'],
            'c_content' => ['nullable'],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }
        if ($request->hasFile("image")) {
            $fileNameWExt = $request->file("image")->getClientOriginalName();
            $fileName = pathinfo($fileNameWExt, PATHINFO_FILENAME);
            $fileExt = $request->file("image")->getClientOriginalExtension();
            if ($fileExt=="png" || $fileExt == "jpg" || $fileExt == "jpeg") {

                $fileNameToStore = $fileName . "_" . time() . "." . $fileExt;
                
                $file_url = url('/storage/news/'.$fileNameToStore);
                
                $request->file("image")->storeAs("public/news", $fileNameToStore);
                
            }else{
                return back()->with('error', "File is not Image");
            }
        }else{
            $fileNameToStore = "";
        }

        $news = News::create([
            'title'=> $request->title,
            'description'=>$request->desc,
            'image'=>$fileNameToStore,
        ]);

        if ($news) {

            if (!empty($request->c_n)) {
                foreach ($request->c_n as $key => $ch) {
                    if (!$ch == Null) {
                        $doc = "c_image".$key;
                        if ($request->hasFile($doc)) {
                            $fileNameWExt = $request->file($doc)->getClientOriginalName();
                            $fileName = pathinfo($fileNameWExt, PATHINFO_FILENAME);
                            $fileExt = $request->file($doc)->getClientOriginalExtension();
            
                            if ($fileExt=="png" || $fileExt == "jpg" || $fileExt == "jpeg") {
    
                                $fileNameToStore = $fileName . "_" . time() . "." . $fileExt;
                                
                                $file_url = url('/storage/news/'.$fileNameToStore);
                                
                                $request->file($doc)->storeAs("public/news", $fileNameToStore);
                                
                                $job_content = NewsContent::create([
                                    'news_id'=>$news->id,
                                    'heading'=> $request->c_heading[$key],
                                    'content'=>$request->c_content[$key],
                                    'image'=> $fileNameToStore,
                                ]);
                            }else{
                                $news->delete();
                                // return "file not pdf";
                                return back()->with('error', "File is not Image");
                            }
                        }else{

                            $job_content = NewsContent::create([
                                'news_id'=>$news->id,
                                'heading'=> $request->c_heading[$key],
                                'content'=>$request->c_content[$key],
                            ]);
                        }
                    }
                }
            }
    
            return redirect()->route('news')->with("success", "News has been posted");
        }else{
            return back()->with("error", "Failed to Post News");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        return view("media.news.edit", compact('news'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, News $news)
    {
        
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string', 'max:255'],
            'desc' => ['nullable'],
            'n_n' => ['nullable'],
            'n_heading' => ['nullable'],
            'n_content' => ['nullable'],

            'c_n' => ['nullable'],
            'c_heading' => ['nullable'],
            'c_content' => ['nullable'],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }
        if ($request->hasFile("image")) {
            $fileNameWExt = $request->file("image")->getClientOriginalName();
            $fileName = pathinfo($fileNameWExt, PATHINFO_FILENAME);
            $fileExt = $request->file("image")->getClientOriginalExtension();
            if ($fileExt=="png" || $fileExt == "jpg" || $fileExt == "jpeg") {

                $fileNameToStore = $fileName . "_" . time() . "." . $fileExt;
                
                $file_url = url('/storage/news/'.$fileNameToStore);
                
                $request->file("image")->storeAs("public/news", $fileNameToStore);
                
            }else{
                return back()->with('error', "File is not Image");
            }
        }else{
            $fileNameToStore = $news->image;
        }

        $up = $news->update([
            'title'=> $request->title,
            'description'=>$request->desc,
            'image'=>$fileNameToStore,
        ]);

        if ($up) {

            // Update
            if (!empty($request->n_n)) {
                foreach ($request->n_n as $key => $nh) {
                    if (!$nh == Null) {
                        $doc = "n_image".$key;
                        if ($request->hasFile($doc)) {
                            $fileNameWExt = $request->file($doc)->getClientOriginalName();
                            $fileName = pathinfo($fileNameWExt, PATHINFO_FILENAME);
                            $fileExt = $request->file($doc)->getClientOriginalExtension();
            
                            if ($fileExt=="png" || $fileExt == "jpg" || $fileExt == "jpeg") {
    
                                $fileNameToStore = $fileName . "_" . time() . "." . $fileExt;
                                
                                $file_url = url('/storage/news/'.$fileNameToStore);
                                
                                $request->file($doc)->storeAs("public/news", $fileNameToStore);
                                
                                $job_content = NewsContent::where(['id'=>$key, 'news_id'=>$news->id])->update([
                                    'heading'=> $request->n_heading[$key],
                                    'content'=>$request->n_content[$key],
                                    'image'=> $fileNameToStore,
                                ]);
                            }else{
                                return back()->with('error', "File is not Image");
                            }
                        }else{

                            $job_content = NewsContent::where(['id'=>$key, 'news_id'=>$news->id])->update([
                                'heading'=> $request->n_heading[$key],
                                'content'=>$request->n_content[$key],
                            ]);
                        }
                    }
                }
            }

            // Insert
            if (!empty($request->c_n)) {
                foreach ($request->c_n as $key => $ch) {
                    if (!$ch == Null) {
                        if ( !$request->c_heading[$key]==Null || !$request->c_content[$key]==Null) {
                        $doc = "c_image".$key;
                        if ($request->hasFile($doc)) {
                            $fileNameWExt = $request->file($doc)->getClientOriginalName();
                            $fileName = pathinfo($fileNameWExt, PATHINFO_FILENAME);
                            $fileExt = $request->file($doc)->getClientOriginalExtension();
            
                            if ($fileExt=="png" || $fileExt == "jpg" || $fileExt == "jpeg") {
    
                                $fileNameToStore = $fileName . "_" . time() . "." . $fileExt;
                                
                                $file_url = url('/storage/news/'.$fileNameToStore);
                                
                                $request->file($doc)->storeAs("public/news", $fileNameToStore);
                                
                                $job_content = NewsContent::create([
                                    'news_id'=>$news->id,
                                    'heading'=> $request->c_heading[$key],
                                    'content'=>$request->c_content[$key],
                                    'image'=> $fileNameToStore,
                                ]);
                            }else{
                                $news->delete();
                                return back()->with('error', "File is not Image");
                            }
                        }else{

                            $job_content = NewsContent::create([
                                'news_id'=>$news->id,
                                'heading'=> $request->c_heading[$key],
                                'content'=>$request->c_content[$key],
                            ]);
                        }
                        }
                    }
                }
            }
    
            return back()->with("success", "News has been Updated");
        }else{
            return back()->with("error", "Failed to Update News");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        $cont = $news->news_contents;

        foreach ($cont as $key => $con) {
            $con->delete();
        }

        $news->delete();

        return redirect()->route('news')->with('success', "News Deleted");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NewsContent  $cont
     * @return \Illuminate\Http\Response
     */
    public function destroy_cont(NewsContent $cont)
    {
        $cont->delete();

        return back()->with('success', "News Deleted");
    }
}
