<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Tender;
use Illuminate\Auth\Access\HandlesAuthorization;

class TenderPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any tenders.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['admin', 'mda_officer', 'auditor', 'citizen']);
    }

    /**
     * Determine whether the user can view the tender.
     */
    public function view(User $user, Tender $tender): bool
    {
        // Citizens can only view published tenders
        if ($user->hasRole('citizen')) {
            return $tender->isPublished();
        }

        // Admin and auditors can view all tenders
        if ($user->hasAnyRole(['admin', 'auditor'])) {
            return true;
        }

        // MDA officers can view tenders from their MDA
        if ($user->hasRole('mda_officer')) {
            return $user->mda && $user->mda->id === $tender->mda_id;
        }

        // Vendors can view published tenders
        if ($user->hasRole('vendor')) {
            return $tender->isPublished();
        }

        return false;
    }

    /**
     * Determine whether the user can create tenders.
     */
    public function create(User $user): bool
    {
        return $user->hasAnyRole(['admin', 'mda_officer']);
    }

    /**
     * Determine whether the user can update the tender.
     */
    public function update(User $user, Tender $tender): bool
    {
        // Only admin and MDA officers can update
        if (!$user->hasAnyRole(['admin', 'mda_officer'])) {
            return false;
        }

        // Admin can update any tender
        if ($user->hasRole('admin')) {
            return true;
        }

        // MDA officers can only update tenders from their MDA
        if ($user->hasRole('mda_officer')) {
            return $user->mda && $user->mda->id === $tender->mda_id;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the tender.
     */
    public function delete(User $user, Tender $tender): bool
    {
        // Only admin can delete tenders
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can publish the tender.
     */
    public function publish(User $user, Tender $tender): bool
    {
        // Only admin can publish tenders
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can evaluate bids for the tender.
     */
    public function evaluate(User $user, Tender $tender): bool
    {
        // Only admin and evaluation committee can evaluate
        return $user->hasRole('admin') ||
               ($tender->evaluation_committee_head && $user->id === $tender->evaluation_committee_head);
    }
}

