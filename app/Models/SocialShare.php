<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialShare extends Model
{
    use HasFactory;

    protected $fillable = [
        'url',
        'icon',
        'follower',
        'status',
    ];
}
