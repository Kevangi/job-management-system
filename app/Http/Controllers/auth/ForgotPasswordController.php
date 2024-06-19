<?php

namespace App\Http\Controllers\auth;

use App\Models\User;
use Illuminate\Support\Str;
use App\Mail\ForgotPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    /**
    * THIS IS THE FUNCTION USED TO DISPLAY FORGOT PASSWORD FORM
    * @method GET
    * @author KEVANGI PATEL
    * @route /forgot-password-form
    * @param \Illuminate\Http\Request $request
    * @return \Illuminate\Http\Response
    */
    public function form(){
        return view('auth.forgotPassword');
    }

    /**
    * THIS IS THE FUNCTION USED TO FORGOT PASSWORD
    * @method POST
    * @author KEVANGI PATEL
    * @route /forgot-password
    * @param \Illuminate\Http\Request $request
    * @return \Illuminate\Http\Response
    */
    public function forgotPassword(Request $request){
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);
        $user  = User::where('email', $request->email)->first();
        $token = Str::random(64);
        // Update or insert the password reset token for the user
        DB::table('password_reset_tokens')->updateOrInsert(
        [
            'email' => $request->email,
        ],
        [
            'token' => $token,
            'created_at' => Carbon::now(),
        ]);

        // Send a password reset email to the user
        Mail::to($user->email)->send(new ForgotPassword($token, $user->name));

        return redirect()->back()->with('success', 'We Send a Password Reset Link in your mail. So Please Check it!');
    }
}
