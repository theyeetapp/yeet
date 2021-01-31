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

        if($type) {
            return $this->hasManyThrough(Symbol::class, Subscription::class, 'user_id', 'id')
            ->select('symbols.name')
            ->where('symbols.type', $type)
            ->get()
            ->toArray();
        }
        else {
            return $this->hasManyThrough(Symbol::class, Subscription::class, 'user_id', 'id')
            ->select('symbols.name')
            ->get()
            ->toArray();
        }
        
    }

    public function subscriptions() {
        return $this->hasMany(Subscription::class)->orderBy('created_at', 'desc')->get();
    }
}
