<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Job;

class Bid extends Model
{
    use HasFactory;

    protected $fillable = [
        'bid_number',
        'vendor_id',
        'tender_id',
        'bid_amount',
        'currency',
        'validity_period_days',
        'submission_date',
        'status',
        'technical_score',
        'financial_score',
        'total_score',
        'rank',
        'evaluation_notes',
        'rejection_reason',
        'bid_documents',
        'bid_security_amount',
        'bid_security_document',
    ];

    protected $casts = [
        'bid_amount' => 'decimal:2',
        'technical_score' => 'decimal:2',
        'financial_score' => 'decimal:2',
        'total_score' => 'decimal:2',
        'bid_security_amount' => 'decimal:2',
        'submission_date' => 'datetime',
        'bid_documents' => 'array',
    ];

    /**
     * Get the vendor that owns this bid
     */
    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Applicant::class, 'vendor_id');
    }

    /**
     * Legacy accessor for job (tender) from original system.
     * Allows using $bid->job where Job model now maps to tenders table.
     */
    public function job(): BelongsTo
    {
        return $this->belongsTo(Job::class, 'tender_id');
    }

    /**
     * Get the tender that owns this bid
     */
    public function tender(): BelongsTo
    {
        return $this->belongsTo(Tender::class);
    }

    /**
     * Get purchase orders for this bid
     */
    public function purchaseOrders(): HasMany
    {
        return $this->hasMany(PurchaseOrder::class);
    }

    /**
     * Get contracts for this bid
     */
    public function contracts(): HasMany
    {
        return $this->hasMany(Contract::class);
    }

    /**
     * Get application documents (legacy from original system)
     */
    public function applicationDocuments(): HasMany
    {
        return $this->hasMany(ApplicationDocument::class, 'application_id');
    }

    /**
     * Backwards-compatible alias for applicationDocuments relationship.
     */
    public function application_documents(): HasMany
    {
        return $this->applicationDocuments();
    }

    /**
     * Get comments (legacy from original system)
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'application_id');
    }

    /**
     * Get app requirements (legacy from original system)
     */
    public function appRequirements(): HasMany
    {
        return $this->hasMany(AppRequirement::class, 'app_id');
    }

    /**
     * Backwards-compatible alias for appRequirements relationship.
     */
    public function app_requirements(): HasMany
    {
        return $this->appRequirements();
    }

    /**
     * Get experiences (legacy from original system)
     */
    public function experiences(): HasMany
    {
        return $this->hasMany(AppExperience::class, 'app_id');
    }

    /**
     * Get educations (legacy from original system)
     */
    public function educations(): HasMany
    {
        return $this->hasMany(AppEducation::class, 'app_id');
    }

    /**
     * Backwards-compatible alias for experiences relationship.
     */
    public function application_experiences(): HasMany
    {
        return $this->experiences();
    }

    /**
     * Backwards-compatible alias for educations relationship.
     */
    public function application_educations(): HasMany
    {
        return $this->educations();
    }

    /**
     * Check if bid is awarded
     */
    public function isAwarded(): bool
    {
        return $this->status === 'awarded';
    }

    /**
     * Check if bid is under evaluation
     */
    public function isUnderEvaluation(): bool
    {
        return $this->status === 'under_evaluation';
    }

    /**
     * Check if bid is technically qualified
     */
    public function isTechnicallyQualified(): bool
    {
        return $this->status === 'technically_qualified';
    }

    /**
     * Check if bid is rejected
     */
    public function isRejected(): bool
    {
        return $this->status === 'rejected';
    }

    /**
     * Scope for awarded bids
     */
    public function scopeAwarded($query)
    {
        return $query->where('status', 'awarded');
    }

    /**
     * Scope for under evaluation bids
     */
    public function scopeUnderEvaluation($query)
    {
        return $query->where('status', 'under_evaluation');
    }

    /**
     * Scope for technically qualified bids
     */
    public function scopeTechnicallyQualified($query)
    {
        return $query->where('status', 'technically_qualified');
    }

    /**
     * Scope by vendor
     */
    public function scopeByVendor($query, int $vendorId)
    {
        return $query->where('vendor_id', $vendorId);
    }

    /**
     * Scope by tender
     */
    public function scopeByTender($query, int $tenderId)
    {
        return $query->where('tender_id', $tenderId);
    }

    /**
     * Scope for bids with scores
     */
    public function scopeWithScores($query)
    {
        return $query->whereNotNull('total_score');
    }

    /**
     * Scope for bids ordered by rank
     */
    public function scopeOrderedByRank($query)
    {
        return $query->orderBy('rank', 'asc');
    }
}

