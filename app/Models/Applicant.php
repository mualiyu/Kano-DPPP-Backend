<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Applicant extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'phone',
        'photo',
        'cac_number',
        'type',
        'ownership_type',
        'vat_number',
        'address',
        'mobile',
        'password',
        'remember_token',
        'email_verified_at',
        'status',
        // Enhanced vendor fields
        'registration_number',
        'tin_number',
        'bvn',
        'tax_clearance_certificate',
        'business_license',
        'company_registration_certificate',
        'financial_capacity',
        'years_in_business',
        'certifications',
        'approval_status',
        'rejection_reason',
        'approved_at',
        'approved_by',
        'performance_rating',
        'vendor_category',
        'specializations',
        'contact_person',
        'contact_phone',
        'contact_email',
    ];

    protected $casts = [
        'financial_capacity' => 'decimal:2',
        'performance_rating' => 'decimal:2',
        'certifications' => 'array',
        'specializations' => 'array',
        'approved_at' => 'datetime',
    ];

    /**
     * Get bids submitted by this vendor
     */
    public function bids(): HasMany
    {
        return $this->hasMany(Bid::class, 'vendor_id');
    }

    /**
     * Get purchase orders for this vendor
     */
    public function purchaseOrders(): HasMany
    {
        return $this->hasMany(PurchaseOrder::class, 'vendor_id');
    }

    /**
     * Get contracts for this vendor
     */
    public function contracts(): HasMany
    {
        return $this->hasMany(Contract::class, 'vendor_id');
    }

    /**
     * Get invoices for this vendor
     */
    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class, 'vendor_id');
    }

    /**
     * Get payments for this vendor
     */
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class, 'vendor_id');
    }

    /**
     * Get directors for this vendor
     */
    public function directors(): HasMany
    {
        return $this->hasMany(Director::class, 'applicant_id');
    }

    /**
     * Get experiences for this vendor
     */
    public function experiences(): HasMany
    {
        return $this->hasMany(Experience::class, 'applicant_id');
    }

    /**
     * Get consultant profile for this vendor
     */
    public function consultant(): HasOne
    {
        return $this->hasOne(AppConsultant::class, 'applicant_id');
    }

    /**
     * Get the user who approved this vendor
     */
    public function approver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    /**
     * Check if vendor is approved
     */
    public function isApproved(): bool
    {
        return $this->approval_status === 'approved';
    }

    /**
     * Check if vendor is pending approval
     */
    public function isPendingApproval(): bool
    {
        return $this->approval_status === 'pending';
    }

    /**
     * Check if vendor is blacklisted
     */
    public function isBlacklisted(): bool
    {
        return $this->approval_status === 'blacklisted';
    }

    /**
     * Check if vendor is rejected
     */
    public function isRejected(): bool
    {
        return $this->approval_status === 'rejected';
    }

    /**
     * Scope for approved vendors
     */
    public function scopeApproved($query)
    {
        return $query->where('approval_status', 'approved');
    }

    /**
     * Scope for pending vendors
     */
    public function scopePending($query)
    {
        return $query->where('approval_status', 'pending');
    }

    /**
     * Scope for blacklisted vendors
     */
    public function scopeBlacklisted($query)
    {
        return $query->where('approval_status', 'blacklisted');
    }

    /**
     * Scope by vendor category
     */
    public function scopeByCategory($query, string $category)
    {
        return $query->where('vendor_category', $category);
    }

    /**
     * Scope by type (individual/company)
     */
    public function scopeByType($query, string $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Scope for vendors with high performance rating
     */
    public function scopeHighPerforming($query, float $minRating = 4.0)
    {
        return $query->where('performance_rating', '>=', $minRating);
    }

    /**
     * Get vendor's total contract value
     */
    public function getTotalContractValueAttribute(): float
    {
        return $this->contracts()->sum('contract_value');
    }

    /**
     * Get vendor's total bid count
     */
    public function getTotalBidsCountAttribute(): int
    {
        return $this->bids()->count();
    }

    /**
     * Get vendor's successful bids count
     */
    public function getSuccessfulBidsCountAttribute(): int
    {
        return $this->bids()->where('status', 'awarded')->count();
    }

    /**
     * Get vendor's success rate
     */
    public function getSuccessRateAttribute(): float
    {
        $totalBids = $this->total_bids_count;
        if ($totalBids === 0) {
            return 0;
        }

        return ($this->successful_bids_count / $totalBids) * 100;
    }
}
