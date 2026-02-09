<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PressReleaseContent extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'press_release_id',
        'heading',
        'content',
        'image',
    ];


    public function press_release(): BelongsTo
    {
        return $this->belongsTo(PressRelease::class, "press_release_id", 'id');
    }
}
