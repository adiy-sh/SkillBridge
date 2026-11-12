<?php

namespace App\Policies;

use App\Models\SkillEndorsement;
use App\Models\User;
use App\Models\UserSkill;

class SkillEndorsementPolicy
{
    /**
     * Any authenticated user who is NOT the skill owner may endorse.
     */
    public function create(User $user, UserSkill $userSkill): bool
    {
        return $user->id !== $userSkill->user_id;
    }

    /**
     * Only the endorser may remove their own endorsement.
     */
    public function delete(User $user, SkillEndorsement $endorsement): bool
    {
        return $user->id === $endorsement->endorsed_by_id;
    }
}

