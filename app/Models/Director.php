<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Director extends Model
{
    use HasFactory;

    protected $fillable = [
        'applicant_id',
        'name',
    ];

    public function applicant(): BelongsTo
    {
        return $this->belongsTo(Applicant::class, "applicant_id", 'id');
    }
}
