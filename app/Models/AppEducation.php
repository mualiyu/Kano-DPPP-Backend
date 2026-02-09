<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AppEducation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'type',
        'institute',
        'major',
        'start',
        'end',
        'currently',
        'app_id',
    ];

    public function application(): BelongsTo
    {
        return $this->belongsTo(Application::class, "app_id", 'id');
    }
}
