<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\PasswordReset;
use App\Mail\PasswordReset as ResetMail;

class PasswordResetsController extends Controller
{
    public $request;

    public function __construct(Request $request) {
        $this->request = $request;
    }

    public function sendEmail() {
        $this->request->validate([
            'email' => ['required', 'email'],
        ]);

        $email = $this->request->email;
        $user = User::firstWhere('email', $email);

        if(!$user) {
            return back()->with('message', 'continue at your email');
        }

        date_default_timezone_set('Africa/Lagos');
        $expiresIn = time() + (30 * 60);

        $token = bin2hex(openssl_random_pseudo_bytes(50));
        $reset = PasswordReset::create([
            'user_id' => $user->id,
            'token' => $token,
            'expires_in' => $expiresIn
        ]);

        Mail::to($user)->send(new ResetMail($user, $token));
        return back()->with('message', 'continue at your email');
    }

    public function show($token) {
        $reset = PasswordReset::firstWhere('token', $token);

        if(!$reset) {
            $this->request->session()->flash('error', 'invalid password reset token');
            return redirect()->route('login');
        }

        date_default_timezone_set('Africa/Lagos');

        if(time() > $reset->expires_in) {
            $this->request->session()->flash('error', 'expired password reset token');
            return redirect()->route('login');
        }

        return view('auth.reset-password')
        ->with('token', $token);
    }

    public function reset() {
        $this->request->validate([
            'password' => ['required', 'min:8'],
            'token' => ['required', 'min:50']
        ]);

        $reset = PasswordReset::firstWhere('token', $this->request->token);
        $user = $reset->user;
        $user->password = Hash::make($this->request->password);
        $user->save();

        PasswordReset::where('user_id', $user->id)->delete();
        $this->request->session()->flash('message', 'password changed successfully');
        return redirect()->route('login');
    }
}
