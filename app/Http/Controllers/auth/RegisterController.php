<?php

namespace App\Http\Controllers\auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;

class RegisterController extends Controller
{
    /**
    * THIS IS THE FUNCTION USED TO DISPLAY REGISER FORM 
    * @method GET
    * @author KEVANGI PATEL
    * @route /register-form
    * @param \Illuminate\Http\Request $request
    * @return \Illuminate\Http\Response
    */
    public function form(){
        return view('auth.register');
    }

    /**
    * THIS IS THE FUNCTION USED TO REGISTER USER
    * @method POST
    * @author KEVANGI PATEL
    * @route /register
    * @param \Illuminate\Http\Request $request
    * @return \Illuminate\Http\Response
    */
    public function register(Request $request){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class.',email,withoutTrashed'],
            'password' => ['required', 'confirmed'],
            'role'  => ['required', 'in:employer,jobSeeker'],
        ], [
            'role.in' => 'The role must be one of: employer, jobSeeker.',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'is_active' => 1,
        ]);
        $user->createToken($request->input('email'))->plainTextToken;

        $remember    = $request->has('remember');
        if($remember){
            $rememberToken = $request->input('email') . '|' . $request->input('password');
            $user->remember_token = hash('sha256', $rememberToken);
            $user->save();

            $cookie = Cookie::make('remember_token', encrypt($rememberToken), 60 * 24 * 30);

            Auth::login($user);

            if($user->role === 'employer'){
                return redirect()->route('employer.dashboard')->withCookie($cookie)->with('success', 'Welcome to the FindJob!');
            }
            return redirect()->route('jobSeeker.dashboard')->withCookie($cookie)->with('success', 'Welcome to the FindJob!');
        }

        Auth::login($user);

        if($user->role === 'employer'){
            return redirect()->route('employer.dashboard')->with('success', 'Welcome to the FindJob!');
        }
        return redirect()->route('jobSeeker.dashboard')->with('success', 'Welcome to the FindJob!');
    }
}
