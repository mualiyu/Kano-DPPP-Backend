<?php

namespace App\Http\Controllers\Applicant;

use App\Http\Controllers\Controller;
use App\Models\AppConsultant;
use App\Models\Applicant;
use App\Models\BusinessCategory;
use App\Models\Director;
use App\Models\Experience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
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

        $applicant = Applicant::with('consultant')->find($applicant->id);

        return view('applicants.profile.index', compact("applicant"));
    }

    public function update(Request $request)
    {
        // return $request->all();

        $validator = Validator::make($request->all(), [
            "image" => "nullable|image|mimes:jpeg,jpg,png,gif",
            'name' => ['required', 'string', 'max:255'],
            // 'email' => ['required', 'email'],
            'phone' => ['required'],
            'cac_number' => ['nullable'],
            'ownership_type' => ['nullable'],
            'vat_number' => ['nullable'],
            'address' => ['nullable'],
            'mobile' => ['nullable'],
            'n_director' => ['nullable'],
            'n_e_name' => ['nullable'],
            'n_start_date' => ['nullable'],
            'n_end_date' => ['nullable'],

            'dir_id' => ['nullable'],
            'exp_id' => ['nullable'],
            'director' => ['nullable'],
            'e_name' => ['nullable'],
            'start_date' => ['nullable'],
            'end_date' => ['nullable'],
        ]);

        if ($validator->fails()) {
            // return $validator->errors();
            return back()->withErrors($validator)->withInput();
        }
        $a = session('Applicant');

        $applicant = Applicant::find($a->id);

        if ($request->hasFile("image")) {
            $imageNameWExt = $request->file("image")->getClientOriginalName();
            $imageName = pathinfo($imageNameWExt, PATHINFO_FILENAME);
            $imageExt = $request->file("image")->getClientOriginalExtension();

            $imageNameToStore = $imageName . "_" . time() . "." . $imageExt;

            $image_url = url('/storage/applicant/'.$imageNameToStore);

            $request->file("image")->storeAs("public/applicant", $imageNameToStore);
        } else {
            $image_url = $applicant->photo;
        }

        $update = $applicant->update([
            'photo' => $image_url,
            'name' => $request->name,
            // 'email' => $request->email,
            'phone' => $request->phone,
            'cac_number' => $request->cac_number,
            'ownership_type' => $request->ownership_type,
            'vat_number' => $request->vat_number,
            'address' => $request->address,
            'mobile' => $request->mobile,
        ]);

        if ($update) {

            if (!empty($request->dir_id)) {
                foreach ($request->dir_id as $key => $d_id) {
                    if (!$d_id == Null) {
                        $director = Director::where('id', '=', $d_id)->update([
                            'name'=> $request->director[$d_id],
                        ]);
                    }
                }
            }

            if (!empty($request->exp_id)) {
                foreach ($request->exp_id as $key => $e_id) {
                    if (!$e_id == Null) {
                        $exp = Experience::where('id', '=', $e_id)->update([
                            'name'=> $request->e_name[$e_id],
                            'start'=> $request->start_date[$e_id],
                            'end'=> $request->end_date[$e_id],
                        ]);
                    }
                }
            }

            if (!empty($request->n_director)) {
                foreach ($request->n_director as $key => $nd) {
                    if (!$nd == Null) {
                        $n_director = Director::create([
                            'vendor_id'=>$applicant->id,
                            'name'=> $nd,
                        ]);
                    }
                }
            }

            if (!empty($request->n_e_name)) {
                foreach ($request->n_e_name as $key => $nen) {
                    if (!$nen == Null) {
                        $n_e_name = Experience::create([
                            'vendor_id'=>$applicant->id,
                            'name'=> $nen,
                            'start'=>$request->n_start_date[$key],
                            'end'=>$request->n_end_date[$key],
                        ]);
                    }
                }
            }

            $a = Applicant::where('id', '=', $applicant->id)->get();
            session(['Applicant' => $a[0]]);

            return back()->with("success", "Profile is updated");
        }else{
            return back()->with("error", "Failed to update Profile.");
        }

        return back()->with("error", "Failed, Try again later.");
    }

    // update consultant
    public function update_c(Request $request, Applicant $applicant)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email'],
            'phone' => ['nullable'],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $consultant = AppConsultant::where(['applicant_id'=>$applicant->id])->first();

        if ($consultant) {
            $consultant->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
            ]);
            return back()->with("success", "Consultant Profile is updated");
        } else {
            AppConsultant::create([
                'applicant_id'=>$applicant->id,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
            ]);
            return back()->with("success", "Consultant Profile is added");
        }
    }

    public function delete_pic($id)
    {
        $applicant = Applicant::find($id);

        $new = url('/storage/applicant/default.png');

        $old = $applicant->photo;

        $update = $applicant->update([
            'photo'=> $new,
        ]);

        if ($update) {
            $a = Applicant::where('id', '=', $applicant->id)->with('business_category')->get();
            session(['Applicant' => $a[0]]);

            return back()->with('success', "You have removed your profile picture.");
        }else{
            return back()->with('error', "Failed to remove profile picture, Try again later.");
        }
    }

public function update_password(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'current_pass' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            // return $validator->errors();
            return back()->with('warning', "please check the form below for any mistake.");
        }

        $applicant = Applicant::where('id', '=', $id)->get();

        if(count($applicant)>0){
            if (Hash::check($request->current_pass, $applicant[0]->password)) {
                    # code...
                    $update = Applicant::where('id', '=', $applicant[0]->id)->update([
                        'password' => Hash::make($request->password),
                    ]);

                    $a = Applicant::where('id', '=', $id)->get();

                    session(['Applicant' => $a[0]]);

                    return redirect()->route('app_profile')->with('success', "You've successfully changed your password.");
                } else {
                    return back()->with('error', "Password not correct");
                }
        }else{
            abort(404);
        }
    }
}
