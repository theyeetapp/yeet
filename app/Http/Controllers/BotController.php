<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\User;
use App\Events\BotAuthentication;

class BotController extends Controller
{
    public $types = ['all', 'crypto', 'stock'];

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

    public function getSymbols(User $user, $type='all')
    {
        if(!in_array($type, $this->types)) {
            return [
                'message' => 'unsupported symbol type',
                'errorId' => 'UnsupportedSymbolType'
            ];
        }

        return [
            'symbols' => $user->symbols($type === 'all' ? null : $type)
        ];
    }
}
