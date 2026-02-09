<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BusinessCategory extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
    ];

    public function jobs(): HasMany
    {
        return $this->hasMany(Job::class, "b_category_id", 'id');
    }

    public function bussiness_sub_categories(): HasMany
    {
        return $this->hasMany(BusinessSubCategory::class, "b_c_id", 'id');
    }

    // public function applicants(): HasMany
    // {
    //     return $this->hasMany(Applicant::class, "b_category_id", 'id');
    // }
}
