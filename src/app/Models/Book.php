<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'author_id',
        'title'
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo('App\Models\Author');
    }
}
