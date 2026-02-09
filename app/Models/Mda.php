<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Mda extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'type',
        'description',
        'head_name',
        'head_title',
        'email',
        'phone',
        'address',
        'annual_budget',
        'status',
    ];

    protected $casts = [
        'annual_budget' => 'decimal:2',
    ];

    /**
     * Get requisitions for this MDA
     */
    public function requisitions(): HasMany
    {
        return $this->hasMany(Requisition::class);
    }

    /**
     * Get tenders for this MDA
     */
    public function tenders(): HasMany
    {
        return $this->hasMany(Tender::class);
    }

    /**
     * Get purchase orders for this MDA
     */
    public function purchaseOrders(): HasMany
    {
        return $this->hasMany(PurchaseOrder::class);
    }

    /**
     * Get contracts for this MDA
     */
    public function contracts(): HasMany
    {
        return $this->hasMany(Contract::class);
    }

    /**
     * Get invoices for this MDA
     */
    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }

    /**
     * Get payments for this MDA
     */
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * Scope for active MDAs
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope by type
     */
    public function scopeType($query, string $type)
    {
        return $query->where('type', $type);
    }
}

