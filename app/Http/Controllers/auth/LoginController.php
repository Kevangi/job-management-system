<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class LoginController extends Controller
{
    /**
    * THIS IS THE FUNCTION USED TO DISPLAY LOGIN FORM
    * @method GET
    * @author KEVANGI PATEL
    * @route /
    * @param \Illuminate\Http\Request $request
    * @return \Illuminate\Http\Response
    */
    public function form()
    {
        $rememberToken = Cookie::get('remember_token');

        if ($rememberToken) {
            $decryptedToken = decrypt($rememberToken);

            // Separate email and hashed password
            list($email, $password) = explode('|', $decryptedToken);

            return view('auth.login', [
            'email' => $email, 'password' => $password, 'rememberToken' => $rememberToken ]);
        }

        return view('auth.login', [
        'email'         => $email ?? null,
        'password'      => $password ?? null,
        'rememberToken' => $rememberToken ?? null,
        ]);
    }

    /**
    * THIS IS THE FUNCTION USED TO LOGIN USER
    * @method POST
    * @author KEVANGI PATEL
    * @route /login
    * @param \Illuminate\Http\Request $request
    * @return \Illuminate\Http\Response
    */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $remember    = $request->has('remember');
    
        if (Auth::attempt($credentials, $remember)) {
            $user = Auth::user();
            $user->is_active = 1;
            $user->createToken($request->input('email'))->plainTextToken;
        
            if ($remember) {
                $rememberToken = $request->input('email') . '|' . $request->input('password');
                $user->remember_token = hash('sha256', $rememberToken);
                $user->save();

                // Store the remember token in a cookie
                $cookie = Cookie::make('remember_token', encrypt($rememberToken), 60 * 24 * 30);

                if ($user->role === 'admin') {
                    return redirect()->route('admin.dashboard')->withCookie($cookie)->with('success', 'You are logged in successfully!');
                }elseif ($user->role === 'employer') {
                    return redirect()->route('employer.dashboard')->withCookie($cookie)->with('success', 'You are logged in successfully!');
                }

                return redirect()->route('jobSeeker.dashboard')->withCookie($cookie)->with('success', 'You are logged in successfully!');
            }

            // If remember me option is not selected
            if(Auth::attempt($credentials) && $request->hasCookie('remember_token')){
                Cookie::queue(Cookie::forget('remember_token'));
            }

            // Redirect the user based on their role
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard')->with('success', 'You are logged in successfully!');
            }elseif ($user->role === 'employer') {
                return redirect()->route('employer.dashboard')->with('success', 'You are logged in successfully!');
            }
            return redirect()->route('jobSeeker.dashboard')->with('success', 'You are logged in successfully');
        }

        // If authentication fails, redirect back with errors
        return back()->withInput($request->only('email', 'remember'))->with('error', 'Invalid credentials');
    }
}
