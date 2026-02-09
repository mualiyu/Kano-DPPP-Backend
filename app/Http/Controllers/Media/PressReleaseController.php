<?php

namespace App\Http\Controllers\Media;

use App\Models\PressRelease;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PressReleaseContent;
use Illuminate\Support\Facades\Validator;

class PressReleaseController extends Controller
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
        $press = PressRelease::orderBy('created_at', "DESC")->get();
        return view("media.press.index", compact("press"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("media.press.create");
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
                
                $file_url = url('/storage/press/'.$fileNameToStore);
                
                $request->file("image")->storeAs("public/press", $fileNameToStore);
                
            }else{
                return back()->with('error', "File is not Image");
            }
        }else{
            $fileNameToStore = "";
        }

        $press = PressRelease::create([
            'title'=> $request->title,
            'description'=>$request->desc,
            'image'=>$fileNameToStore,
        ]);

        if ($press) {

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
                                
                                $file_url = url('/storage/press/'.$fileNameToStore);
                                
                                $request->file($doc)->storeAs("public/press", $fileNameToStore);
                                
                                $press_content = PressReleaseContent::create([
                                    'press_release_id'=>$press->id,
                                    'heading'=> $request->c_heading[$key],
                                    'content'=>$request->c_content[$key],
                                    'image'=> $fileNameToStore,
                                ]);
                            }else{
                                $press->delete();
                                // return "file not pdf";
                                return back()->with('error', "File is not Image");
                            }
                        }else{

                            $press_content = PressReleaseContent::create([
                                'press_release_id'=>$press->id,
                                'heading'=> $request->c_heading[$key],
                                'content'=>$request->c_content[$key],
                            ]);
                        }
                    }
                }
            }
    
            return redirect()->route('press')->with("success", "Press Release has been Added");
        }else{
            return back()->with("error", "Failed to Add Press Release");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PressRelease  $pressRelease
     * @return \Illuminate\Http\Response
     */
    public function show(PressRelease $pressRelease)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PressRelease  $pressRelease
     * @return \Illuminate\Http\Response
     */
    public function edit(PressRelease $pressRelease)
    {
        return view("media.press.edit", compact('pressRelease'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PressRelease  $pressRelease
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PressRelease $pressRelease)
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
                
                $file_url = url('/storage/press/'.$fileNameToStore);
                
                $request->file("image")->storeAs("public/press", $fileNameToStore);
                
            }else{
                return back()->with('error', "File is not Image");
            }
        }else{
            $fileNameToStore = $pressRelease->image;
        }

        $up = $pressRelease->update([
            'title'=> $request->title,
            'description'=>$request->desc,
            'image'=>$fileNameToStore,
        ]);

        if ($up) {

            // Update
            if (!empty($request->n_n)) {
                foreach ($request->n_n as $key => $nh) {
                    if (!$nh == Null) {
                        // if ( !$request->n_heading[$key]==Null || !$request->n_content[$key]==Null) {
                            $doc = "n_image".$key;
                            if ($request->hasFile($doc)) {
                                $fileNameWExt = $request->file($doc)->getClientOriginalName();
                                $fileName = pathinfo($fileNameWExt, PATHINFO_FILENAME);
                                $fileExt = $request->file($doc)->getClientOriginalExtension();
                
                                if ($fileExt=="png" || $fileExt == "jpg" || $fileExt == "jpeg") {
        
                                    $fileNameToStore = $fileName . "_" . time() . "." . $fileExt;
                                    
                                    $file_url = url('/storage/press/'.$fileNameToStore);
                                    
                                    $request->file($doc)->storeAs("public/press", $fileNameToStore);
                                    
                                    $press_content = PressReleaseContent::where(['id'=>$key, 'press_release_id'=>$pressRelease->id])->update([
                                        'heading'=> $request->n_heading[$key],
                                        'content'=>$request->n_content[$key],
                                        'image'=> $fileNameToStore,
                                    ]);
                                }else{
                                    return back()->with('error', "File is not Image");
                                }
                            }else{
    
                                $job_content = PressReleaseContent::where(['id'=>$key, 'press_release_id'=>$pressRelease->id])->update([
                                    'heading'=> $request->n_heading[$key],
                                    'content'=>$request->n_content[$key],
                                ]);
                            }
                        // }
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
                                    
                                    $file_url = url('/storage/press/'.$fileNameToStore);
                                    
                                    $request->file($doc)->storeAs("public/press", $fileNameToStore);
                                    
                                    $press_content = PressReleaseContent::create([
                                        'press_release_id'=>$pressRelease->id,
                                        'heading'=> $request->c_heading[$key],
                                        'content'=>$request->c_content[$key],
                                        'image'=> $fileNameToStore,
                                    ]);
                                }else{
                                    $pressRelease->delete();
                                    // return "file not pdf";
                                    return back()->with('error', "File is not Image");
                                }
                            }else{
    
                                $press_content = PressReleaseContent::create([
                                    'press_release_id'=>$pressRelease->id,
                                    'heading'=> $request->c_heading[$key],
                                    'content'=>$request->c_content[$key],
                                ]);
                            }
                        }
                    }
                }
            }
    
            return back()->with("success", "Press Release has been Updated");
        }else{
            return back()->with("error", "Failed to Update Press Release");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PressRelease  $pressRelease
     * @return \Illuminate\Http\Response
     */
    public function destroy(PressRelease $pressRelease)
    {
        $cont = $pressRelease->press_contents;

        foreach ($cont as $key => $con) {
            $con->delete();
        }

        $pressRelease->delete();

        return redirect()->route('press')->with('success', "Press Release has been Deleted");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PressReleaseContent  $cont
     * @return \Illuminate\Http\Response
     */
    public function destroy_cont(PressReleaseContent $cont)
    {
        $cont->delete();

        return back()->with('success', "Press Release Content Deleted");
    }
}
