<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Requisition extends Model
{
    use HasFactory;

    protected $fillable = [
        'requisition_number',
        'mda_id',
        'created_by',
        'title',
        'description',
        'estimated_cost',
        'currency',
        'budget_line',
        'procurement_method',
        'priority',
        'status',
        'rejection_reason',
        'hod_id',
        'perm_sec_id',
        'hod_approved_at',
        'perm_sec_approved_at',
        'procurement_board_approved_at',
        'required_delivery_date',
        'attachments',
    ];

    protected $casts = [
        'estimated_cost' => 'decimal:2',
        'attachments' => 'array',
        'hod_approved_at' => 'datetime',
        'perm_sec_approved_at' => 'datetime',
        'procurement_board_approved_at' => 'datetime',
        'required_delivery_date' => 'date',
    ];

    /**
     * Get the MDA that owns this requisition
     */
    public function mda(): BelongsTo
    {
        return $this->belongsTo(Mda::class);
    }

    /**
     * Get the user who created this requisition
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the Head of Department
     */
    public function hod(): BelongsTo
    {
        return $this->belongsTo(User::class, 'hod_id');
    }

    /**
     * Get the Permanent Secretary
     */
    public function permSec(): BelongsTo
    {
        return $this->belongsTo(User::class, 'perm_sec_id');
    }

    /**
     * Get tenders created from this requisition
     */
    public function tenders(): HasMany
    {
        return $this->hasMany(Tender::class);
    }

    /**
     * Check if requisition is approved
     */
    public function isApproved(): bool
    {
        return $this->status === 'procurement_board_approved';
    }

    /**
     * Check if requisition is pending approval
     */
    public function isPendingApproval(): bool
    {
        return in_array($this->status, ['submitted', 'hod_approved', 'perm_sec_approved']);
    }

    /**
     * Scope for approved requisitions
     */
    public function scopeApproved($query)
    {
        return $query->where('status', 'procurement_board_approved');
    }

    /**
     * Scope for pending requisitions
     */
    public function scopePending($query)
    {
        return $query->whereIn('status', ['submitted', 'hod_approved', 'perm_sec_approved']);
    }

    /**
     * Scope by MDA
     */
    public function scopeByMda($query, int $mdaId)
    {
        return $query->where('mda_id', $mdaId);
    }

    /**
     * Scope by procurement method
     */
    public function scopeByMethod($query, string $method)
    {
        return $query->where('procurement_method', $method);
    }
}

