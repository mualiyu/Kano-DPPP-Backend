<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Bid;
use Illuminate\Auth\Access\HandlesAuthorization;

class BidPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any bids.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['admin', 'mda_officer', 'auditor']);
    }

    /**
     * Determine whether the user can view the bid.
     */
    public function view(User $user, Bid $bid): bool
    {
        // Admin and auditors can view all bids
        if ($user->hasAnyRole(['admin', 'auditor'])) {
            return true;
        }

        // MDA officers can view bids for their MDA's tenders
        if ($user->hasRole('mda_officer')) {
            return $user->mda && $user->mda->id === $bid->tender->mda_id;
        }

        // Vendors can only view their own bids
        if ($user->hasRole('vendor')) {
            return $bid->vendor_id === $user->id;
        }

        return false;
    }

    /**
     * Determine whether the user can create bids.
     */
    public function create(User $user): bool
    {
        return $user->hasRole('vendor') && $user->isActive();
    }

    /**
     * Determine whether the user can update the bid.
     */
    public function update(User $user, Bid $bid): bool
    {
        // Vendors can only update their own draft bids
        if ($user->hasRole('vendor')) {
            return $bid->vendor_id === $user->id && $bid->status === 'draft';
        }

        // Admin can update any bid
        if ($user->hasRole('admin')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the bid.
     */
    public function delete(User $user, Bid $bid): bool
    {
        // Vendors can only delete their own draft bids
        if ($user->hasRole('vendor')) {
            return $bid->vendor_id === $user->id && $bid->status === 'draft';
        }

        // Admin can delete any bid
        if ($user->hasRole('admin')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can submit the bid.
     */
    public function submit(User $user, Bid $bid): bool
    {
        // Only vendors can submit their own bids
        if (!$user->hasRole('vendor')) {
            return false;
        }

        // Must be the bid owner
        if ($bid->vendor_id !== $user->id) {
            return false;
        }

        // Bid must be in draft status
        if ($bid->status !== 'draft') {
            return false;
        }

        // Tender must be open for bidding
        if (!$bid->tender->isOpen()) {
            return false;
        }

        return true;
    }

    /**
     * Determine whether the user can evaluate the bid.
     */
    public function evaluate(User $user, Bid $bid): bool
    {
        // Only admin and evaluation committee can evaluate
        return $user->hasRole('admin') ||
               ($bid->tender->evaluation_committee_head && $user->id === $bid->tender->evaluation_committee_head);
    }

    /**
     * Determine whether the user can award the bid.
     */
    public function award(User $user, Bid $bid): bool
    {
        // Only admin can award bids
        return $user->hasRole('admin');
    }
}

