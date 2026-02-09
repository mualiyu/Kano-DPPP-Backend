<?php

namespace App\Http\Controllers\Applicant\Auth;

use App\Http\Controllers\Controller;
use App\Mail\AcceptApplicantMail;
use App\Models\Applicant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ForgotController extends Controller
{

    public function showFrogotPasswordForm()
    {
        return view('applicants.auth.forgot-password');
    }

    public function forgot_password(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email', 'max:255'],
            // 'b_category' => ['required'],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $pass = mt_rand(10000000,99999999);

        $password = Hash::make($pass);

        $applicant = Applicant::where(['email'=>$request->email])->update([
            "password"=> $password,
       ]);

        if ($applicant) {
            $a = Applicant::where(['email'=>$request->email])->get()[0];
            $mailData = [
                'title' => 'Password reset is successful.',
                'body' => 'Use Username: '.$a->username.' & Password: '.$pass,
            ];

            // return "Your username is: ".$request->username." & password is: ".$pass;
            Mail::to($a->email)->send(new AcceptApplicantMail($mailData));

            return redirect()->route('app_show_login')->with('success', "An email has been sent to you together with your new LogIn credentials. Thank you once again for using AMP see you soon.");
        }else{
            // return "Failed to register, Try again later.";
            return back()->with('error', "Failed to reset, Try again later.");
        }
    }

}
