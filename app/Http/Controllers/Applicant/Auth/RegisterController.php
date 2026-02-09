<?php

namespace App\Http\Controllers\Applicant\Auth;

use App\Http\Controllers\Controller;
use App\Mail\AcceptApplicantMail;
use App\Models\Applicant;
use App\Models\BusinessCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    
    public function showRegistrationForm()
    {
        $b_categories = BusinessCategory::all();
        return view('applicants.auth.register', compact('b_categories'));
    }

    public function register_company(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'username'=> ['required', 'string'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:applicants'],
            'phone' => ['required'],
            'cac_number' => ['nullable'],
            // 'b_category' => ['required'],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $pass = mt_rand(10000000,99999999);

        $password = Hash::make($pass);

        $applicant = Applicant::create([
            'name'=> $request->name,
            'email'=> $request->email,
            'phone'=> $request->phone,
            'username'=>$request->username,
            'cac_number'=> $request->cac_number,
            // 'b_category_id' =>$request->b_category,
            'photo' => url('/storage/applicant/default.png'),
            'type'=>'company',
            'status'=>"accepted",
            "password"=> $password,
        ]);
        $applicant->update([
            'status'=>"accepted",
            "password"=> $password,
       ]);

        if ($applicant) {
            $mailData = [
                'title' => 'Your registration is successful.',
                'body' => 'Use Username: '.$applicant->username.' & Password: '.$pass,
            ];

            // return "Your username is: ".$request->username." & password is: ".$pass;
            Mail::to($applicant->email)->send(new AcceptApplicantMail($mailData));
            
            return redirect()->route('app_show_login')->with('success', "Thank you for registering, An email has been sent to you together with your LogIn credentials. Thank you once again for using AMP see you soon.");
        }else{
            // return "Failed to register, Try again later.";
            return back()->with('error', "Failed to register, Try again later.");
        }
    }

    public function register_individual(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:applicants'],
            'phone' => ['required'],
            'username'=> ['required', 'string'],
            // 'b_category' => ['required'],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $pass = mt_rand(10000000,99999999);

        $password = Hash::make($pass);

        $applicant = Applicant::create([
            'name'=> $request->name,
            'email'=> $request->email,
            'phone'=> $request->phone,
            'username'=>$request->username,
            // 'b_category_id' =>$request->b_category,
            'photo' => url('/storage/applicant/default.png'),
            'type'=>'individual',
            'status'=>"accepted",
            "password"=> $password,
        ]);
        $applicant->update([
            'status'=>"accepted",
            "password"=> $password,
       ]);

        if ($applicant) {

            $mailData = [
                'title' => 'Your registration is successful.',
                'body' => 'Use Username: '.$applicant->username.' & Password: '.$pass,
            ];

            // return "Your username is: ".$request->username." & password is: ".$pass;
            Mail::to($applicant->email)->send(new AcceptApplicantMail($mailData));
            
            return redirect()->route('app_show_login')->with('success', "Thank you for registering, An email has been sent to you together with your LogIn credentials. Thank you once again for using AMP see you soon.");
        }else{
            // return "Failed to register, Try again later.";
            return back()->with('error', "Failed to register, Try again later.");
        }
    }
}
