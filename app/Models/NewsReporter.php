<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsReporter extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'name',
        'phone',
        'email',
        'nid_no',
        'father_name',
        'mother_name',
        'present_address',
        'permanent_address',
        'joining_date',
        'password',
        'role',
    ];
}
