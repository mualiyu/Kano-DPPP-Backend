<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NewsContent extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'news_id',
        'heading',
        'content',
        'image',
    ];

    public function news(): BelongsTo
    {
        return $this->belongsTo(News::class, "news_id", 'id');
    }
}
