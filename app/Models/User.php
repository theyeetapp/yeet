<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use App\Models\Symbol;
use App\Models\Subscription;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar'
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

    public function symbols($type = null) {

        $symbolIds = Subscription::select('symbol_id')
        ->where('user_id', $this->id)
        ->get()
        ->toArray();

        if($type) {
            return Symbol::select('name')
            ->where('type', $type)
            ->whereIn('id', $symbolIds)
            ->get()
            ->toArray();
        }
    
        return Symbol::select('name')
        ->whereIn('id', $symbolIds)
        ->get()
        ->toArray();
    }

    public function subscriptions() {
        return $this->hasMany(Subscription::class)->orderBy('created_at', 'desc')->get();
    }
}
