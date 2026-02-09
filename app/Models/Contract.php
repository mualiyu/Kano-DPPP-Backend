<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Contract extends Model
{
    use HasFactory;

    protected $fillable = [
        'contract_number',
        'purchase_order_id',
        'tender_id',
        'bid_id',
        'mda_id',
        'vendor_id',
        'title',
        'description',
        'contract_value',
        'currency',
        'status',
        'start_date',
        'end_date',
        'duration_days',
        'scope_of_work',
        'deliverables',
        'payment_terms',
        'performance_security_amount',
        'performance_security_document',
        'special_conditions',
        'contract_documents',
        'digital_signature_mda',
        'digital_signature_vendor',
        'signed_at',
        'created_by',
        'approved_by',
        'approved_at',
    ];

    protected $casts = [
        'contract_value' => 'decimal:2',
        'performance_security_amount' => 'decimal:2',
        'start_date' => 'date',
        'end_date' => 'date',
        'deliverables' => 'array',
        'payment_terms' => 'array',
        'contract_documents' => 'array',
        'signed_at' => 'datetime',
        'approved_at' => 'datetime',
    ];

    /**
     * Get the purchase order that owns this contract
     */
    public function purchaseOrder(): BelongsTo
    {
        return $this->belongsTo(PurchaseOrder::class);
    }

    /**
     * Get the tender that owns this contract
     */
    public function tender(): BelongsTo
    {
        return $this->belongsTo(Tender::class);
    }

    /**
     * Get the bid that owns this contract
     */
    public function bid(): BelongsTo
    {
        return $this->belongsTo(Bid::class);
    }

    /**
     * Get the MDA that owns this contract
     */
    public function mda(): BelongsTo
    {
        return $this->belongsTo(Mda::class);
    }

    /**
     * Get the vendor
     */
    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Applicant::class, 'vendor_id');
    }

    /**
     * Get the user who created this contract
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the user who approved this contract
     */
    public function approver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    /**
     * Get invoices for this contract
     */
    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }

    /**
     * Get payments for this contract
     */
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * Check if contract is active
     */
    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    /**
     * Check if contract is in progress
     */
    public function isInProgress(): bool
    {
        return $this->status === 'in_progress';
    }

    /**
     * Check if contract is completed
     */
    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }

    /**
     * Check if contract is signed
     */
    public function isSigned(): bool
    {
        return $this->signed_at !== null;
    }

    /**
     * Check if contract is expired
     */
    public function isExpired(): bool
    {
        return $this->end_date && $this->end_date < now();
    }

    /**
     * Scope for active contracts
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope for completed contracts
     */
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    /**
     * Scope for signed contracts
     */
    public function scopeSigned($query)
    {
        return $query->whereNotNull('signed_at');
    }

    /**
     * Scope by MDA
     */
    public function scopeByMda($query, int $mdaId)
    {
        return $query->where('mda_id', $mdaId);
    }

    /**
     * Scope by vendor
     */
    public function scopeByVendor($query, int $vendorId)
    {
        return $query->where('vendor_id', $vendorId);
    }

    /**
     * Scope for expiring contracts
     */
    public function scopeExpiring($query, int $days = 30)
    {
        return $query->where('end_date', '<=', now()->addDays($days))
                    ->where('end_date', '>=', now())
                    ->whereIn('status', ['active', 'in_progress']);
    }
}

