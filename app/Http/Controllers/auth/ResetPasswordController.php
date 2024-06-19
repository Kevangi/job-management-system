<?php

namespace App\Http\Controllers\auth;

use App\Models\User;
use App\Mail\ResetPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ResetPasswordController extends Controller
{
    /**
    * THIS IS THE FUNCTION USED TO DISPLAY RESET PASSWORD
    * @method GET
    * @author KEVANGI PATEL
    * @route /reset-password-form/{token}
    * @param \Illuminate\Http\Request $request
    * @return \Illuminate\Http\Response
    */
    public function form($token){
        return view('auth.resetPassword', ['token' => $token]);
    }

    /**
    * THIS IS THE FUNCTION USED TO RESET PASSWORD
    * @method POST
    * @author KEVANGI PATEL
    * @route /reset-password/{token}
    * @param \Illuminate\Http\Request $request
    * @return \Illuminate\Http\Response
    */
    public function resetPassword(Request $request, $token){
        $request->validate([
            'password' => 'required|confirmed',
        ]);
        
        $tokenRecord = DB::table('password_reset_tokens')->where('token', $token)->first();

        if ($tokenRecord) {
            $user = User::where('email', $tokenRecord->email)->first();

            $password = Hash::make($request['password']);
            $user->update(['password' => $password]);

            Mail::to($tokenRecord->email)->send(new ResetPassword($user->name));

            // Delete the used token from the database
            DB::table('password_reset_tokens')->where('token', $token)->delete();

            return redirect()->route('login-form')->with('success', 'Password Reset Successfully');
        }
        return redirect()->route('login-form')->with('error', 'Reset Password Link is invalid');
    }
}
