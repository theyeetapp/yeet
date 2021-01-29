<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Symbol;

class Subscription extends Model
{
    use HasFactory;
    
    protected $fillable = ['user_id', 'symbol_id'];

    public function symbol() {
        return $this->belongsTo(Symbol::class);
    }
}
