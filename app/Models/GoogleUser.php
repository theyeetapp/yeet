<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoogleUser extends Model
{
    use HasFactory;
    protected $table = 'google_users';
    protected $fillable = ['google_id', 'user_id'];
}
