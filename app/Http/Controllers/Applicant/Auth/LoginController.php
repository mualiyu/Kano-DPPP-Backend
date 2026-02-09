<?php

namespace App\Http\Controllers\Applicant\Auth;

use App\Http\Controllers\Controller;
use App\Models\Applicant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('applicants.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'user' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('user', 'pin');

        $username = $request->user;

        if (is_numeric($username) == true) {
            $user = Applicant::where('phone', '=', $username)->get();
        } else {
            $user = Applicant::where('username', '=', $username)->get();
        }

        if (count($user) > 0) {
        if ($user[0]->status == "accepted") {
            # code...
                if (Hash::check($request->password, $user[0]->password)) {
                    # code...
                    $a = Applicant::where('id', '=', $user[0]->id)->get();
    
                    session(['Applicant' => $a[0]]);
    
                    return redirect()->route('app_home');
                } else {
                    return back()->with('error', "Password not correct");
                }
            }else{
                return back()->with('error', 'Sorry your account is not activated, Try again later.');
            }
        } else {
            return back()->with('error', 'UserName/Phone is not found');
        }

        return back()->with('error', 'Login details are not valid');
    }

    public function signOut()
    {
        Session::flush();
        Auth::logout();

        return redirect()->route('app_show_login');
    }
}
