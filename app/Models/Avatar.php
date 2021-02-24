<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;

class Avatar extends Model
{
    use HasFactory;
    protected $table = 'avatars';
    protected $fillable = ['url', 'public_id', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
