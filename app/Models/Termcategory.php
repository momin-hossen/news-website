<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Termcategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'type',
        'status',
    ];


    public function termCategory(): BelongsTo
    {
        return $this->belongsTo(Termcategory::class);
    }

    public function termCategories(): HasMany
    {
        return $this->hasMany(Termcategory::class);
    }
}
