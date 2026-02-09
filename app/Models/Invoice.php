<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_number',
        'contract_id',
        'vendor_id',
        'mda_id',
        'title',
        'description',
        'amount',
        'currency',
        'status',
        'invoice_date',
        'due_date',
        'line_items',
        'tax_amount',
        'total_amount',
        'supporting_documents',
        'rejection_reason',
        'submitted_by',
        'reviewed_by',
        'reviewed_at',
        'approved_by',
        'approved_at',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'tax_amount' => 'decimal:2',
        'total_amount' => 'decimal:2',
        'invoice_date' => 'date',
        'due_date' => 'date',
        'line_items' => 'array',
        'supporting_documents' => 'array',
        'reviewed_at' => 'datetime',
        'approved_at' => 'datetime',
    ];

    /**
     * Get the contract that owns this invoice
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
     * Get the user who submitted this invoice
     */
    public function submitter(): BelongsTo
    {
        return $this->belongsTo(User::class, 'submitted_by');
    }

    /**
     * Get the user who reviewed this invoice
     */
    public function reviewer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    /**
     * Get the user who approved this invoice
     */
    public function approver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    /**
     * Get payments for this invoice
     */
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * Check if invoice is approved
     */
    public function isApproved(): bool
    {
        return $this->status === 'approved';
    }

    /**
     * Check if invoice is paid
     */
    public function isPaid(): bool
    {
        return $this->status === 'paid';
    }

    /**
     * Check if invoice is overdue
     */
    public function isOverdue(): bool
    {
        return $this->due_date && $this->due_date < now() && !$this->isPaid();
    }

    /**
     * Scope for approved invoices
     */
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    /**
     * Scope for paid invoices
     */
    public function scopePaid($query)
    {
        return $query->where('status', 'paid');
    }

    /**
     * Scope for overdue invoices
     */
    public function scopeOverdue($query)
    {
        return $query->where('due_date', '<', now())
                    ->whereNotIn('status', ['paid', 'cancelled']);
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
}

