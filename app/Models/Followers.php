<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Followers extends Model
{
    use HasFactory;
    use HasApiTokens;

    public $timestamps = false;


    protected $fillable = [
        'follower_id',
        'following_id'
    ];

    // public function follower()
    // {
    //     return $this->belongsTo(Followers::class, 'follower_id');
    // }

    // public function following()
    // {
    //     return $this->belongsTo(Followers::class, 'following_id');
    // }
}
