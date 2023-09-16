<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $fillable = [
        'termcategory_id',
        'title',
        'image',
        'description',
        'is_breaking',
        'status',
    ];

    public function category() {
        return $this->belongsTo(Termcategory::class, 'termcategory_id');
    }
}

