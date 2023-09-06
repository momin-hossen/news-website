<?php

namespace App\Models;

use App\Models\SubNewsCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NewsCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status',
    ];

    public function NewsCategory(){
        return $this->hasOne(SubNewsCategory::class);
    }
}
