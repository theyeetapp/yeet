<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function show() {
        return view('auth.login');
    }

    public function login(Request $request) {

        $credentials = $request->only(['email', 'password']);

        if(Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();
            $request->session()->flash('message', 'logged in successfully');
            return redirect()->intended('subscriptions');
        }

        $request->session()->flash('error', 'incorrect credentials');
        return back()->withInput();
    }

    public function logout(Request $request) {
        
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        $request->session()->flash('message', 'logged out successfully');
        return redirect()->route('login');
    }
}
