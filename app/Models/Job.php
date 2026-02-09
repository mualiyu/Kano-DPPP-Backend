<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Job extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tenders';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'tender_number',
        'requisition_id',
        'mda_id',
        'name',
        'description',
        'estimated_value',
        'currency',
        'tender_type',
        'status',
        'published_at',
        'opening_date',
        'closing_date',
        'evaluation_start_date',
        'evaluation_end_date',
        'evaluation_criteria',
        'bid_security_amount',
        'performance_security_amount',
        'contract_duration_days',
        'special_conditions',
        'required_documents',
        'created_by',
        'evaluation_committee_head',
        // Legacy fields for backward compatibility
        'open_date',
        'close_date',
        'consultancy_type',
        'tor',
        'p_e_r', //require previous experience
        'e_b', //Education background
    ];


    // public function business_category(): BelongsTo
    // {
    //     return $this->belongsTo(BusinessCategory::class, "b_category_id", 'id');
    // }


    // public function business_sub_categories(): BelongsToMany
    // {
    //     return $this->belongsToMany(BusinessSubCategory::class, "business_sub_category_job", "job_id","business_sub_category_id");
    // }


    public function job_contents(): HasMany
    {
        return $this->hasMany(JobContent::class, "tender_id", 'id');
    }
    public function job_reports(): HasMany
    {
        return $this->hasMany(JobReporting::class, "tender_id", 'id');
    }

    public function job_milestones(): HasMany
    {
        return $this->hasMany(JobMilestone::class, "tender_id", 'id');
    }

    public function job_docs(): HasMany
    {
        return $this->hasMany(JobDocument::class, "tender_id", 'id');
    }

    public function applications(): HasMany
    {
        return $this->hasMany(Bid::class, "tender_id", 'id');
    }

    // new
    public function job_requirements(): HasMany
    {
        return $this->hasMany(JobRequirement::class, "tender_id", 'id');
    }

    public function app_requirements(): HasMany
    {
        return $this->hasMany(AppRequirement::class, "tender_id", 'id');
    }

    /**
     * Get the requisition that owns this tender
     */
    public function requisition(): BelongsTo
    {
        return $this->belongsTo(Requisition::class);
    }

    /**
     * Get the MDA that owns this tender
     */
    public function mda(): BelongsTo
    {
        return $this->belongsTo(Mda::class);
    }

    /**
     * Get the user who created this tender
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the evaluation committee head
     */
    public function evaluationCommitteeHead(): BelongsTo
    {
        return $this->belongsTo(User::class, 'evaluation_committee_head');
    }

    /**
     * Get bids for this tender
     */
    public function bids(): HasMany
    {
        return $this->hasMany(Bid::class, 'tender_id');
    }

    /**
     * Get purchase orders for this tender
     */
    public function purchaseOrders(): HasMany
    {
        return $this->hasMany(PurchaseOrder::class);
    }

    /**
     * Get contracts for this tender
     */
    public function contracts(): HasMany
    {
        return $this->hasMany(Contract::class);
    }
}
