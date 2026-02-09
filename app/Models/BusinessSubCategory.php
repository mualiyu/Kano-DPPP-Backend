<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BusinessSubCategory extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'b_c_id',
    ];

    public function jobs(): BelongsToMany
    {
        return $this->belongsToMany(Job::class, "business_sub_category_job", "business_sub_category_id", "job");
    }

    public function business_category(): BelongsTo
    {
        return $this->belongsTo(BusinessSubCategory::class, "b_c_id", 'id');
    }

}
