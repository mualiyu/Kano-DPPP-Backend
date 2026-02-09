<?php

namespace App\Http\Controllers\Media\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ForgotController extends Controller
{
    
    public function showFrogotPasswordForm()
    {
        return view('media.auth.forgot-password');
    }

    public function forgot_password(Request $request)
    {
        # code...
    }

}
