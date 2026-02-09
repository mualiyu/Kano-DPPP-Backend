<?php

namespace App\Http\Controllers\Media\Auth;

use App\Http\Controllers\Controller;
use App\Models\Applicant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('media.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);


        $username = $request->email;

        $user = User::where('email', '=', $username)->get();

            # code...
            if (count($user) > 0) {
                if (Hash::check($request->password, $user[0]->password)) {
                    # code...
                    $a = User::where('id', '=', $user[0]->id)->get();
    
                    session(['media_user' => $a[0]]);
    
                    return redirect()->route('m_home');
                } else {
                    return back()->with('error', "Password not correct");
                }
            } else {
                return back()->with('error', 'Email not found');
            }

        return back()->with('error', 'Login details are not valid');
    }

    public function signOut()
    {
        Session::flush();
        Auth::logout();

        return redirect()->route('m_show_login');
    }
}
