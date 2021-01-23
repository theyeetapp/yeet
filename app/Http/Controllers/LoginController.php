<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function show() {
        return view('auth.login');
    }

    public function login(Request $request) {

        $credentials = $request->only(['email', 'password']);

        if(Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        $request->session()->flash('error', 'incorrect credentials');
        return back()->withInput();
    }
}
