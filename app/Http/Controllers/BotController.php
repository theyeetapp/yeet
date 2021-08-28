<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Events\BotAuthentication;

class BotController extends Controller
{
    public function authenticate(Request $request)
    {
        $email = $request->email;
        $code = $request->code;

        $user = User::firstWhere('email', $email);

        if(!$user) {
            return [
                'message' => 'user does not exist',
                'errorId' => 'UserDoesNotExist'
            ];
        }

        event(new BotAuthentication($user, $code));

        return [
            'message' => 'authentication mail sent successfully',
            'user' => $user,
        ];
    }
}
