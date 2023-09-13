<?php

namespace App\Models;

use App\Models\NewsCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubNewsCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'news_categories_id',
        'name',
        'status',
    ];


    public function SubNews(){
        return $this->belongsTo(NewsCategory::class);
    }
}
