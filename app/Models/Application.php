<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'applicant_id',
        'job_id',
        'status',
    ];

    public function applicant(): BelongsTo
    {
        return $this->belongsTo(Applicant::class, "applicant_id", 'id');
    }

    public function job(): BelongsTo
    {
        return $this->belongsTo(Job::class, "job_id", 'id');
    }

    public function application_documents(): HasMany
    {
        return $this->hasMany(ApplicationDocument::class, "application_id", 'id');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, "application_id", 'id');
    }

    public function app_requirements(): HasMany
    {
        return $this->hasMany(AppRequirement::class, "app_id", 'id');
    }

    public function experiences(): HasMany
    {
        return $this->hasMany(AppExperience::class, "app_id", 'id');
    }

    public function educations(): HasMany
    {
        return $this->hasMany(AppEducation::class, "app_id", 'id');
    }

}
