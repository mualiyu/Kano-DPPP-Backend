<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PurchaseOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'po_number',
        'tender_id',
        'bid_id',
        'mda_id',
        'vendor_id',
        'title',
        'description',
        'amount',
        'currency',
        'status',
        'issue_date',
        'delivery_date',
        'delivery_address',
        'terms_conditions',
        'line_items',
        'created_by',
        'approved_by',
        'approved_at',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'issue_date' => 'date',
        'delivery_date' => 'date',
        'line_items' => 'array',
        'approved_at' => 'datetime',
    ];

    /**
     * Get the tender that owns this purchase order
     */
    public function tender(): BelongsTo
    {
        return $this->belongsTo(Tender::class);
    }

    /**
     * Get the bid that owns this purchase order
     */
    public function bid(): BelongsTo
    {
        return $this->belongsTo(Bid::class);
    }

    /**
     * Get the MDA that owns this purchase order
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
     * Get the user who created this purchase order
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the user who approved this purchase order
     */
    public function approver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    /**
     * Get contracts for this purchase order
     */
    public function contracts(): HasMany
    {
        return $this->hasMany(Contract::class);
    }

    /**
     * Check if purchase order is issued
     */
    public function isIssued(): bool
    {
        return $this->status === 'issued';
    }

    /**
     * Check if purchase order is acknowledged
     */
    public function isAcknowledged(): bool
    {
        return $this->status === 'acknowledged';
    }

    /**
     * Check if purchase order is completed
     */
    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }

    /**
     * Scope for issued purchase orders
     */
    public function scopeIssued($query)
    {
        return $query->where('status', 'issued');
    }

    /**
     * Scope for completed purchase orders
     */
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
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
}

