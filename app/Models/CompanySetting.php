<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanySetting extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'address_1',
        'address_2',
        'email',
        'phone',
        'message',
        'status',
    ];
}
