<?php

namespace App\Mail;

use Exception;
use Illuminate\Support\Facades\{ Http, Log };

class Cyclone
{
    public static function send(String $email, array $variables, array $recipients)
    {
        try {
            Http::withHeaders([
                'Authorization' => sprintf('Bearer %s', env('CYCLONE_API_KEY'))
            ])->post(env('CYCLONE_URL'), [
                'email' => $email,
                'variables' => $variables,
                'recipients' => $recipients,
            ]);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
        }
    }
}
