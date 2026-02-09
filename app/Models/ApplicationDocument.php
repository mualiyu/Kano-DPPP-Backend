<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ApplicationDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'application_id',
        'job_doc_id',
        'document',
    ];

    public function application(): BelongsTo
    {
        return $this->belongsTo(Application::class, "application_id", 'id');
    }

    public function job_doc(): BelongsTo
    {
        return $this->belongsTo(JobDocument::class, "job_doc_id", 'id');
    }
}
