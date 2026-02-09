<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SysRequirement extends Model
{
    use HasFactory;


     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'type',
        'user_id',
    ];

    public function job_requirements(): HasMany
    {
        return $this->hasMany(JobRequirement::class, "sys_id", 'id');
    }

    public function app_requirements(): HasMany
    {
        return $this->hasMany(AppRequirement::class, "sys_id", 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, "user_id", 'id');
    }    

}
