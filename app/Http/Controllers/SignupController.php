<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
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
            $request->session()->flash('error', 'user with email exists');
            return back()->withInput();
        }

        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'avatar' => NULL
        ]);

        event(new Registered($user));
        $request->session()->flash('message', 'continue at your email');
        return back();
    }
}
