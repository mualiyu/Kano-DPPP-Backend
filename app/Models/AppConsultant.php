<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AppConsultant extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'applicant_id',
        'name',
        'email',
        'phone',
    ];

    public function applicant(): BelongsTo
    {
        return $this->belongsTo(Applicant::class, "applicant_id", 'id');
    }
}
