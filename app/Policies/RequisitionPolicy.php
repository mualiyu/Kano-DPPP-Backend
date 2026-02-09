<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Requisition;
use Illuminate\Auth\Access\HandlesAuthorization;

class RequisitionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any requisitions.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['admin', 'mda_officer', 'auditor']);
    }

    /**
     * Determine whether the user can view the requisition.
     */
    public function view(User $user, Requisition $requisition): bool
    {
        // Admin and auditors can view all requisitions
        if ($user->hasAnyRole(['admin', 'auditor'])) {
            return true;
        }

        // MDA officers can view requisitions from their MDA
        if ($user->hasRole('mda_officer')) {
            return $user->mda && $user->mda->id === $requisition->mda_id;
        }

        return false;
    }

    /**
     * Determine whether the user can create requisitions.
     */
    public function create(User $user): bool
    {
        return $user->hasRole('mda_officer') && $user->isActive();
    }

    /**
     * Determine whether the user can update the requisition.
     */
    public function update(User $user, Requisition $requisition): bool
    {
        // Only admin and MDA officers can update
        if (!$user->hasAnyRole(['admin', 'mda_officer'])) {
            return false;
        }

        // Admin can update any requisition
        if ($user->hasRole('admin')) {
            return true;
        }

        // MDA officers can only update requisitions from their MDA
        if ($user->hasRole('mda_officer')) {
            return $user->mda && $user->mda->id === $requisition->mda_id;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the requisition.
     */
    public function delete(User $user, Requisition $requisition): bool
    {
        // Only admin can delete requisitions
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can approve the requisition.
     */
    public function approve(User $user, Requisition $requisition): bool
    {
        // Head of Department can approve submitted requisitions
        if ($user->hasRole('mda_officer') && $requisition->hod_id === $user->id) {
            return $requisition->status === 'submitted';
        }

        // Permanent Secretary can approve HOD approved requisitions
        if ($user->hasRole('mda_officer') && $requisition->perm_sec_id === $user->id) {
            return $requisition->status === 'hod_approved';
        }

        // Admin can approve any requisition
        if ($user->hasRole('admin')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can reject the requisition.
     */
    public function reject(User $user, Requisition $requisition): bool
    {
        // Same logic as approve
        return $this->approve($user, $requisition);
    }
}

