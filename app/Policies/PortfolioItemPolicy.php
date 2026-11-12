<?php

namespace App\Policies;

use App\Models\PortfolioItem;
use App\Models\User;

class PortfolioItemPolicy
{
    /**
     * Only the owning freelancer may view their own portfolio management page.
     */
    public function view(User $user, PortfolioItem $item): bool
    {
        return $this->ownsItem($user, $item);
    }

    /**
     * Only the owning freelancer may update a portfolio item.
     */
    public function update(User $user, PortfolioItem $item): bool
    {
        return $this->ownsItem($user, $item);
    }

    /**
     * Only the owning freelancer may delete a portfolio item.
     */
    public function delete(User $user, PortfolioItem $item): bool
    {
        return $this->ownsItem($user, $item);
    }

    private function ownsItem(User $user, PortfolioItem $item): bool
    {
        return $user->isFreelancer()
            && $user->freelancerProfile !== null
            && $user->freelancerProfile->id === $item->freelancer_profile_id;
    }
}

