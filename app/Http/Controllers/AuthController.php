<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\GoogleUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

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

    public function authGoogle() {
        return Socialite::driver('google')->redirect();
    }

    public function googleLogin(Request $request) {
        $authUser = Socialite::driver('google')->user();
        $googleId = $authUser->getId();
        $googleUser = GoogleUser::firstWhere('google_id', $googleId);

        if($googleUser) {
            $user = User::firstWhere('id', $googleUser->user_id);
            Auth::login($user, true);
            $request->session()->regenerate();
            $request->session()->flash('message', 'logged in successfully');
            return redirect()->route('subscriptions');
        }

        $user = User::firstWhere('email', $authUser->getEmail());

        if($user) {
            Auth::login($user, true);
            $request->session()->regenerate();
            $request->session()->flash('message', 'logged in successfully');
            return redirect()->route('subscriptions');
        }

        $user = User::create([
            'name' => $authUser->getName(),
            'email' => $authUser->getEmail(),
            'password' => Hash::make(rand(1, 1000)),
            'avatar' => $authUser->getAvatar()
        ]);
        
        GoogleUser::create([
            'google_id' => $googleId,
            'user_id' => $user->id
        ]);

        Auth::login($user, true);
        $request->session()->regenerate();
        $request->session()->flash('message', 'logged in successfully');
        return redirect()->route('subscriptions');
    }   

    public function logout(Request $request) {
        
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        $request->session()->flash('message', 'logged out successfully');
        return redirect()->route('login');
    }
}
