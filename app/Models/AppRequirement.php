<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AppRequirement extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'value',
        'type',
        'tender_id',
        'sys_id',
        'app_id'
    ];

    public function sys_requirement(): BelongsTo
    {
        return $this->belongsTo(SysRequirement::class, "sys_id", 'id');
    }

    public function job(): BelongsTo
    {
        return $this->belongsTo(Job::class, "tender_id", 'id');
    }

    public function application(): BelongsTo
    {
        return $this->belongsTo(Application::class, "app_id", 'id');
    }
}
