<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_reference',
        'invoice_id',
        'contract_id',
        'vendor_id',
        'mda_id',
        'amount',
        'currency',
        'status',
        'payment_method',
        'bank_name',
        'account_number',
        'account_name',
        'transaction_reference',
        'payment_date',
        'payment_notes',
        'payment_documents',
        'processed_by',
        'processed_at',
        'approved_by',
        'approved_at',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'payment_date' => 'date',
        'payment_documents' => 'array',
        'processed_at' => 'datetime',
        'approved_at' => 'datetime',
    ];

    /**
     * Get the invoice that owns this payment
     */
    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class);
    }

    /**
     * Get the contract
     */
    public function contract(): BelongsTo
    {
        return $this->belongsTo(Contract::class);
    }

    /**
     * Get the vendor
     */
    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Applicant::class, 'vendor_id');
    }

    /**
     * Get the MDA
     */
    public function mda(): BelongsTo
    {
        return $this->belongsTo(Mda::class);
    }

    /**
     * Get the user who processed this payment
     */
    public function processor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'processed_by');
    }

    /**
     * Get the user who approved this payment
     */
    public function approver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    /**
     * Check if payment is approved
     */
    public function isApproved(): bool
    {
        return $this->status === 'approved';
    }

    /**
     * Check if payment is paid
     */
    public function isPaid(): bool
    {
        return $this->status === 'paid';
    }

    /**
     * Check if payment is pending
     */
    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    /**
     * Check if payment failed
     */
    public function isFailed(): bool
    {
        return $this->status === 'failed';
    }

    /**
     * Scope for approved payments
     */
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    /**
     * Scope for paid payments
     */
    public function scopePaid($query)
    {
        return $query->where('status', 'paid');
    }

    /**
     * Scope for pending payments
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
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
     * Scope by contract
     */
    public function scopeByContract($query, int $contractId)
    {
        return $query->where('contract_id', $contractId);
    }

    /**
     * Scope by payment method
     */
    public function scopeByMethod($query, string $method)
    {
        return $query->where('payment_method', $method);
    }
}

