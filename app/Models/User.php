<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'role',
        'employee_id',
        'department',
        'position',
        'status',
        'permissions',
        'profile_image',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login_at' => 'datetime',
        'permissions' => 'array',
    ];

    /**
     * Available roles in the system
     */
    const ROLES = [
        'admin' => 'Administrator',
        'vendor' => 'Vendor',
        'media' => 'Media Manager',
        'mda_officer' => 'MDA Officer',
        'auditor' => 'Auditor',
        'citizen' => 'Citizen',
    ];

    /**
     * Check if user has a specific role
     */
    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }

    /**
     * Check if user has any of the given roles
     */
    public function hasAnyRole(array $roles): bool
    {
        return in_array($this->role, $roles);
    }

    /**
     * Check if user has a specific permission
     */
    public function hasPermission(string $permission): bool
    {
        if (!$this->permissions) {
            return false;
        }

        return in_array($permission, $this->permissions);
    }

    /**
     * Check if user is active
     */
    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    /**
     * Get user's MDA (if applicable)
     */
    public function mda(): BelongsTo
    {
        return $this->belongsTo(Mda::class, 'department', 'id');
    }

    /**
     * Get requisitions created by this user
     */
    public function requisitions(): HasMany
    {
        return $this->hasMany(Requisition::class, 'created_by');
    }

    /**
     * Get tenders created by this user
     */
    public function tenders(): HasMany
    {
        return $this->hasMany(Tender::class, 'created_by');
    }

    /**
     * Get audit logs for this user
     */
    public function auditLogs(): HasMany
    {
        return $this->hasMany(AuditLog::class);
    }

    /**
     * Scope for active users
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope for specific role
     */
    public function scopeRole($query, string $role)
    {
        return $query->where('role', $role);
    }

    /**
     * Get role display name
     */
    public function getRoleDisplayNameAttribute(): string
    {
        return self::ROLES[$this->role] ?? $this->role;
    }
}
