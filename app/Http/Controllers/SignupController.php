<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyEmail;
use App\Models\User;

class SignupController extends Controller
{
    public function show() {
        return view('auth.signup');
    }

    public function signup(Request $request) {
        
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8']
        ]);

        $name = $request->name;
        $email = $request->email;
        $password = $request->password;

        $user = User::firstWhere('email', $email);

        if($user) {
            $request->session()->flash('error', 'User with email exists');
            return back()->withInput();
        }

        $token = bin2hex(openssl_random_pseudo_bytes(50));

        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'activation_token' => $token,
        ]);
        
        Mail::to($user)->send(new VerifyEmail($user));
        $request->session()->flash('message', 'Continue at your email');
        return back();
    }

    public function verifyEmail(Request $request, $token)
    {
        $user = User::firstWhere('activation_token', $token);
        
        if(!$user) {
            $request->session()->flash('error', 'Email verification failed');
            return redirect()->route('signup');
        }

        $user->activation_token = NULL;
        $user->save();
        Auth::login($user);
        $request->session()->regenerate();
        $request->session()->flash('message', 'Email verified successfully');
        return redirect()->route('subscriptions');
    }
}
