<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\BotAuthenticationNotification;
use App\Notifications\ChangeTelegramAccountNotification;

use App\Models\Avatar;
use App\Models\Symbol;
use App\Models\Subscription;

class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'activation_token',
    ];

    protected $attributes = [
        'telegram_id' => null
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function avatar()
    {
        return $this->hasOne(Avatar::class);
    }

    public function symbols($type = null)
    {
        $symbolIds = Subscription::select('symbol_id')
        ->where('user_id', $this->id)
        ->get()
        ->toArray();

        if ($type) {
            return Symbol::where('type', $type)
            ->whereIn('id', $symbolIds)
            ->get()
            ->toArray();
        }

        return Symbol::whereIn('id', $symbolIds)
        ->get()
        ->toArray();
    }

    public function subscriptionsCount()
    {
        return $this->hasMany(Subscription::class)->count();
    }

    public function subscriptions($skip, $take)
    {
        return $this->hasMany(Subscription::class)
        ->orderBy('created_at', 'desc')
        ->skip($skip)
        ->take($take)
        ->get();
    }

    public function sendBotAuthenticationNotification($code)
    {
        $nameArray = explode(' ', $this->name);
        $name = count($nameArray) > 1 ? $nameArray[count($nameArray) - 1] : $nameArray[0];
        return $this->notify(new BotAuthenticationNotification($name, $code));
    }

    public function sendChangeTelegramAccountNotification($code)
    {
        $nameArray = explode(' ', $this->name);
        $name = count($nameArray) > 1 ? $nameArray[count($nameArray) - 1] : $nameArray[0];
        return $this->notify(new ChangeTelegramAccountNotification($name, $code));
    }
}
