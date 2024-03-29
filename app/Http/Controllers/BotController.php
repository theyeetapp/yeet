<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Symbol;
use App\Mail\Cyclone;

class BotController extends Controller
{
    public $types = ['all', 'crypto', 'stock'];

    public function authenticate(Request $request)
    {
        $email = $request->email;
        $code = $request->code;

        $user = User::firstWhere('email', $email);

        if (!$user) {
            return [
                'message' => 'user does not exist',
                'errorId' => 'UserDoesNotExist'
            ];
        }

        $mailVariables = [
            'name' => explode(' ', $user->name, 2)[1],
            'code' => $code,
        ];

        Cyclone::send('VERIFY_TELEGRAM', $mailVariables, [ $user->email ]);

        return [
            'message' => 'authentication mail sent successfully',
            'user' => $user,
        ];
    }

    public function updateUser(Request $request, User $user)
    {
        $user->telegram_id = $request->telegram_id;
        $user->save();

        return [
            'user' => $user
        ];
    }

    public function getSubscriptions(User $user, $type='all')
    {
        if (!in_array($type, $this->types)) {
            return [
                'message' => 'unsupported symbol type',
                'errorId' => 'UnsupportedSymbolType'
            ];
        }

        return [
            'symbols' => $user->symbols($type === 'all' ? null : $type)
        ];
    }

    public function getSymbols($type)
    {
        $symbols = Symbol::where('type', $type)->get();
        return [
            'symbols' => $symbols
        ];
    }

    public function update(Request $request)
    {
        $email = $request->email;
        $code = $request->code;

        $user = User::firstWhere('email', $email);

        if (!$user || !$user->telegram_id) {
            return [
                'message' => 'user does not exist',
                'errorId' => 'UserDoesNotExist'
            ];
        }

        $mailVariables = [
            'name' => explode(' ', $user->name, 2)[1],
            'code' => $code,
        ];

        Cyclone::send('UPDATE_TELEGRAM', $mailVariables, [ $user->email ]);

        return [
            'message' => 'telegram update email sent successfully',
            'user' => $user
        ];
    }
}
