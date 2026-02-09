<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JobRequirement extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'tender_id',
        'sys_id',
    ];

    public function job(): BelongsTo
    {
        return $this->belongsTo(Job::class, "tender_id", 'id');
    }

    public function sys_requirement(): BelongsTo
    {
        return $this->belongsTo(SysRequirement::class, "sys_id", 'id');
    }
}
