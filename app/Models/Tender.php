<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tender extends Model
{
    use HasFactory;

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
        'tor',
        'p_e_r',
        'e_b',
    ];

    protected $casts = [
        'estimated_value' => 'decimal:2',
        'bid_security_amount' => 'decimal:2',
        'performance_security_amount' => 'decimal:2',
        'published_at' => 'datetime',
        'opening_date' => 'datetime',
        'closing_date' => 'datetime',
        'evaluation_start_date' => 'datetime',
        'evaluation_end_date' => 'datetime',
        'evaluation_criteria' => 'array',
        'required_documents' => 'array',
    ];

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
        return $this->hasMany(Bid::class);
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

    /**
     * Get job contents (legacy from original system)
     */
    public function jobContents(): HasMany
    {
        return $this->hasMany(JobContent::class, 'job_id');
    }

    /**
     * Get job reports (legacy from original system)
     */
    public function jobReports(): HasMany
    {
        return $this->hasMany(JobReporting::class, 'job_id');
    }

    /**
     * Get job milestones (legacy from original system)
     */
    public function jobMilestones(): HasMany
    {
        return $this->hasMany(JobMilestone::class, 'job_id');
    }

    /**
     * Get job documents (legacy from original system)
     */
    public function jobDocuments(): HasMany
    {
        return $this->hasMany(JobDocument::class, 'job_id');
    }

    /**
     * Get job requirements (legacy from original system)
     */
    public function jobRequirements(): HasMany
    {
        return $this->hasMany(JobRequirement::class, 'job_id');
    }

    /**
     * Check if tender is open for bidding
     */
    public function isOpen(): bool
    {
        return $this->status === 'open' &&
               $this->opening_date <= now() &&
               $this->closing_date >= now();
    }

    /**
     * Check if tender is closed
     */
    public function isClosed(): bool
    {
        return $this->status === 'closed' || $this->closing_date < now();
    }

    /**
     * Check if tender is published
     */
    public function isPublished(): bool
    {
        return $this->status === 'published' && $this->published_at !== null;
    }

    /**
     * Scope for open tenders
     */
    public function scopeOpen($query)
    {
        return $query->where('status', 'open')
                    ->where('opening_date', '<=', now())
                    ->where('closing_date', '>=', now());
    }

    /**
     * Scope for published tenders
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published')
                    ->whereNotNull('published_at');
    }

    /**
     * Scope by MDA
     */
    public function scopeByMda($query, int $mdaId)
    {
        return $query->where('mda_id', $mdaId);
    }

    /**
     * Scope by tender type
     */
    public function scopeByType($query, string $type)
    {
        return $query->where('tender_type', $type);
    }

    /**
     * Get the winning bid
     */
    public function winningBid()
    {
        return $this->bids()->where('status', 'awarded')->first();
    }
}

