<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JobMilestone extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'tender_id',
        'heading',
        'content',
        'num',
        'due_date',
    ];

    public function job(): BelongsTo
    {
        return $this->belongsTo(Job::class, "tender_id", 'id');
    }
}
