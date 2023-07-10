<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tweet_body',
        'file',
    ];


    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
