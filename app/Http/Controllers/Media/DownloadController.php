<?php

namespace App\Http\Controllers\Media;

use App\Http\Controllers\Controller;
use App\Models\Download;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DownloadController extends Controller
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
        $downloads = Download::orderBy('created_at', "DESC")->get();
        return view("media.download.index", compact("downloads"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("media.download.create");
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
            'doc' => ['required'],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        if ($request->hasFile("doc")) {
            $fileNameWExt = $request->file("doc")->getClientOriginalName();
            $fileName = pathinfo($fileNameWExt, PATHINFO_FILENAME);
            $fileExt = $request->file("doc")->getClientOriginalExtension();
            if ($fileExt=="pdf" || $fileExt == "doc" || $fileExt == "docx") {

                $fileNameToStore = $fileName . "_" . time() . "." . $fileExt;

                $file_url = url('/storage/download/'.$fileNameToStore);
                
                $request->file("doc")->storeAs("public/download", $fileNameToStore);
                
            }else{
                return back()->with('error', "File is not Image");
            }
        }else{
            $fileNameToStore = "";
        }

        $d = Download::create([
            'title'=> $request->title,
            'description' => $request->desc,
            'doc'=>$fileNameToStore,
        ]);

        if ($d) {
            return redirect()->route('downs')->with("success", "New Download is added");
        }else{
            return back()->with('error', "Failed to add Download, Try again later.");
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Download  $download
     * @return \Illuminate\Http\Response
     */
    public function show(Download $download)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Download  $download
     * @return \Illuminate\Http\Response
     */
    public function edit(Download $download)
    {
        return view("media.download.edit", compact('download'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Download  $download
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Download $download)
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string', 'max:255'],
            'desc' => ['nullable'],
            'doc' => ['nullable'],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        if ($request->hasFile("doc")) {
            $fileNameWExt = $request->file("doc")->getClientOriginalName();
            $fileName = pathinfo($fileNameWExt, PATHINFO_FILENAME);
            $fileExt = $request->file("doc")->getClientOriginalExtension();
            if ($fileExt=="pdf" || $fileExt == "doc" || $fileExt == "docx") {

                $fileNameToStore = $fileName . "_" . time() . "." . $fileExt;
                
                $file_url = url('/storage/download/'.$fileNameToStore);
                
                $request->file("doc")->storeAs("public/download", $fileNameToStore);
                
                $d = $download->update([
                    'title'=> $request->title,
                    'description' => $request->desc,
                    'doc' => $fileNameToStore,
                ]);
               
            }else{
                return back()->with('error', "File is not Image");
            }
            
        }else{
            $d = $download->update([
                'title'=> $request->title,
                'description'=>$request->desc,
            ]);
        }

         return back()->with('success', "Download Updated");


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Download  $download
     * @return \Illuminate\Http\Response
     */
    public function destroy(Download $download)
    {
        $download->delete();

        return redirect()->route('downs')->with('success', "Download Deleted");
    }

    public function download_doc(Download $download)
    {        

        $storage = Storage::disk('local')->path('public/download/'.$download->doc);

        return response()->file($storage);
    }
}
