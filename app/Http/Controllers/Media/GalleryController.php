<?php

namespace App\Http\Controllers\Media;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\GalleryImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GalleryController extends Controller
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
        $galleries = Gallery::orderBy('created_at', "DESC")->get();
        return view("media.gallery.index", compact("galleries"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("media.gallery.create");
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
            'name' => ['required', 'string', 'max:255'],
            'desc' => ['nullable'],
            'dd' => ['required'],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $g = Gallery::create([
            'name'=> $request->name,
            'description'=>$request->desc,
        ]);

        if ($g) {

            if (!empty($request->dd)) {
                foreach ($request->dd as $key => $d) {
                    if (!$d == Null) {
                        $doc = "c_image".$key;
                        if ($request->hasFile($doc)) {
                            $fileNameWExt = $request->file($doc)->getClientOriginalName();
                            $fileName = pathinfo($fileNameWExt, PATHINFO_FILENAME);
                            $fileExt = $request->file($doc)->getClientOriginalExtension();
            
                            if ($fileExt=="png" || $fileExt == "jpg" || $fileExt == "jpeg") {
    
                                $fileNameToStore = $fileName . "_" . time() . "." . $fileExt;
                                
                                $file_url = url('/storage/gallery/'.$fileNameToStore);
                                
                                $request->file($doc)->storeAs("public/gallery", $fileNameToStore);
                                
                                $job_content = GalleryImage::create([
                                    'gallery_id'=>$g->id,
                                    'image'=> $fileNameToStore,
                                ]);
                            }else{
                                $g->delete();
                                // return "file not pdf";
                                return back()->with('error', "File is not Image");
                            }
                        }
                        // else{
                        //     $g->delete();
                        //         // return "file not pdf";
                        //     return back()->with('error', "Gallery Most have atlease one Image");
                        // }
                    }
                }
            }
    
            return redirect()->route('galleries')->with("success", "New gallery has been created");
        }else{
            return back()->with("error", "Failed to create gallery");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function show(Gallery $gallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function edit(Gallery $gallery)
    {
        return view("media.gallery.edit", compact('gallery'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gallery $gallery)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'desc' => ['nullable'],
            'n_dd' => ['nullable'],
            'dd' => ['nullable'],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $g = $gallery->update([
            'name'=> $request->name,
            'description'=>$request->desc,
        ]);

        if ($g) {
            // update current data
            if (!empty($request->n_dd)) {
                foreach ($request->n_dd as $key => $nd) {
                    if (!$nd == Null) {
                        $doc = "n_image".$key;
                        if ($request->hasFile($doc)) {
                            $fileNameWExt = $request->file($doc)->getClientOriginalName();
                            $fileName = pathinfo($fileNameWExt, PATHINFO_FILENAME);
                            $fileExt = $request->file($doc)->getClientOriginalExtension();
            
                            if ($fileExt=="png" || $fileExt == "jpg" || $fileExt == "jpeg") {
    
                                $fileNameToStore = $fileName . "_" . time() . "." . $fileExt;
                                
                                $file_url = url('/storage/gallery/'.$fileNameToStore);
                                
                                $request->file($doc)->storeAs("public/gallery", $fileNameToStore);
                                
                                $g_content = GalleryImage::where(['id'=>$nd])->update([
                                    'image'=> $fileNameToStore,
                                ]);
                            }else{
                                return back()->with('error', "File is not Image");
                            }
                        }
                    }
                }
            }

            // Insert new data
            if (!empty($request->dd)) {
                foreach ($request->dd as $key => $d) {
                    if (!$d == Null) {
                        $doc = "c_image".$key;
                        if ($request->hasFile($doc)) {
                            $fileNameWExt = $request->file($doc)->getClientOriginalName();
                            $fileName = pathinfo($fileNameWExt, PATHINFO_FILENAME);
                            $fileExt = $request->file($doc)->getClientOriginalExtension();
            
                            if ($fileExt=="png" || $fileExt == "jpg" || $fileExt == "jpeg") {
    
                                $fileNameToStore = $fileName . "_" . time() . "." . $fileExt;
                                
                                $file_url = url('/storage/gallery/'.$fileNameToStore);
                                
                                $request->file($doc)->storeAs("public/gallery", $fileNameToStore);
                                
                                $g_content = GalleryImage::create([
                                    'gallery_id'=>$gallery->id,
                                    'image'=> $fileNameToStore,
                                ]);
                            }else{
                                return back()->with('error', "One of the new files is not an image");
                            }
                        }
                    }
                }
            }
    
            return back()->with("success", "New gallery has been updated");
        }else{
            return back()->with("error", "Failed to update gallery");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gallery $gallery)
    {
        $cont = $gallery->images;

        foreach ($cont as $key => $con) {
            $con->delete();
        }

        $gallery->delete();

        return redirect()->route('galleries')->with('success', "Gallery is Deleted");
    }

      /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GalleryImage  $cont
     * @return \Illuminate\Http\Response
     */
    public function destroy_cont(GalleryImage $img)
    {
        $img->delete();

        return back()->with('success', "Image has been Deleted");
    }
}
