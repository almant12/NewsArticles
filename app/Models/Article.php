<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'author_id',
        'category_id',
        'title',
        'image',
        'description',
        'content',
        'published_at'
    ];



    public function category(): BelongsTo{
        return $this->belongsTo(Category::class);
    }

    public function author(): BelongsTo{
        return $this->belongsTo(User::class);
    }
}
