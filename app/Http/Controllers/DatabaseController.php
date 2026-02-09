<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use Illuminate\Http\Request;
use App\Mail\AcceptApplicantMail;
use App\Models\Bid;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class DatabaseController extends Controller
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
        $applicants = Applicant::orderBy('created_at', 'desc')->paginate(5);

        return view('database.index', compact("applicants"));
    }

    public function accept_applicant_registration($id)
    {
       $applicant = Applicant::find($id);

       $pass = mt_rand(10000000,99999999);

       $password = Hash::make($pass);

       $update = $applicant->update([
            'status'=>"accepted",
            "password"=> $password,
       ]);

       if ($update) {
           $mailData = [
                'title' => 'You Have been accepted By Admin.',
                'body' => 'Use email: '.$applicant->email.' & password: '.$pass,
            ];

            // return "Your password is: ".$pass;
            Mail::to($applicant->email)->send(new AcceptApplicantMail($mailData));
            return back()->with('success', "A consultant registration has been accepted, An email has been sent to him together with his password.");
       }else {
           return back()->with('error', "Failed to Accept Applicant, Try again later.");
       }
    }


    public function applicant_profile($id)
    {
        $applicant = Applicant::where('id', '=', $id)->get();

        if (count($applicant)>0) {
            $applicant = $applicant[0];

            return view('database.applicant_profile', compact("applicant"));
        }
        else{
            abort(404);
        }
    }

    public function app_update_profile(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            "image" => "nullable|image|mimes:jpeg,jpg,png,gif",
            'name' => ['required', 'string', 'max:255'],
            // 'email' => ['required', 'email'],
            'phone' => ['required'],
            'cac_number' => ['nullable'],
            'ownership_type' => ['nullable'],
            'directors' => ['nullable'],
            'vat_number' => ['nullable'],
            'address' => ['nullable'],
            'mobile' => ['nullable'],
        ]);

        if ($validator->fails()) {
            // return $validator->errors();
            return back()->withErrors($validator)->withInput();
        }

        $applicant = Applicant::find($id);

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
            'directors' => $request->directors,
            'vat_number' => $request->vat_number,
            'address' => $request->address,
            'mobile' => $request->mobile,
        ]);

        if ($update) {

            $mailData = [
                'title' => 'Profile update By Admin.',
                'body' => "Your Profile has been updated by an Admin, \nplease kindly check your profile on the portal. \n \n ",
            ];

            Mail::to($applicant->email)->send(new AcceptApplicantMail($mailData));

            return redirect()->route('admin_applicant_profile', ['id'=>$applicant->id])->with('success', "Applicant profile is updated, Email is sent to the applicant about this update.");
        }else{
            return back()->with("error", "Failed to update applicant Profile.");
        }

        return back()->with("error", "Failed, Try again later.");
    }


    public function applicant_applications($id)
    {
        $applicant = Applicant::where('id', '=', $id)->get();

        if (count($applicant)>0) {
            $applicant =$applicant[0];

            $bids = Bid::where(['vendor_id'=>$id])->get();

            return view('database.applicant_application', compact("applicant", "bids"));
        }else{
            abort(404);
        }

    }

    public function deactivate_applicant(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'confirm_d' => ['accepted'],
        ]);

        if ($validator->fails()) {
            return back()->with('validator', $validator->errors());
        }

        $applicant = Applicant::where(['id'=>$id])->get();

        if(count($applicant)>0){
            $app = Applicant::where('id', '=', $applicant[0]->id)->update([
                "status"=>"await",
            ]);

            $mailData = [
                'title' => 'Profile update By Admin.',
                'body' => "Your Profile has been Deactivated by an Admin, \n \n ",
            ];

            Mail::to($applicant[0]->email)->send(new AcceptApplicantMail($mailData));

            return back()->with('success', 'This Account is deactivated.');
        }else{
            return back()->with('error', 'Failed to deactivate this account, Try Again later.');
        }
    }
}
