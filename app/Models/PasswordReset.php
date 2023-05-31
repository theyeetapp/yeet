<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class PasswordReset extends Model
{
    use HasFactory;
    protected $table = 'password_resets';
    protected $fillable = ['user_id', 'token', 'expires_in'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
