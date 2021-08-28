<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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

    public function updateTelegram(Request $request, User $user)
    {
        $user->telegram_id = $request->telegram_id;
        $user->save();

        return [
            'user' => $user
        ];
    }
}
