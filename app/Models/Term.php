<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Term extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'slug',
        'lang',
        'type',
        'meta',
        'status',
        'featured',
        'description',
        'comment_status',
    ];

    protected $casts = [
        'meta' => 'json',
    ];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Termcategory::class, 'term_termcategory');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Termcategory::class, 'term_termtag');
    }

}
