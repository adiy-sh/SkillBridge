<?php

namespace App\Http\Controllers;

use App\Models\SkillEndorsement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FreelancerPublicProfileController extends Controller
{
    /**
     * Display a freelancer's public profile page.
     * Endorsement/remove buttons are shown here (not on the owner's own page).
     */
    public function show(Request $request, User $user): View
    {
        abort_unless($user->isFreelancer(), 404);

        $user->load([
            'freelancerProfile.portfolioItems',
            'userSkills.skill',
            'userSkills.endorsements.endorser',
        ]);

        $viewer           = $request->user();
        $proficiencyOpts  = config('skillbridge.proficiency_levels');
        $portfolioTypes   = config('skillbridge.portfolio_types');
        $isOwnProfile     = $viewer && $viewer->id === $user->id;

        // For each user_skill, check if the current viewer already endorsed it
        $myEndorsements = [];
        if ($viewer && !$isOwnProfile) {
            $myEndorsements = SkillEndorsement::where('endorsed_by_id', $viewer->id)
                ->whereIn('user_skill_id', $user->userSkills->pluck('id'))
                ->pluck('id', 'user_skill_id')
                ->toArray();
        }

        return view('freelancer.public-profile', compact(
            'user', 'viewer', 'isOwnProfile',
            'proficiencyOpts', 'portfolioTypes', 'myEndorsements'
        ));
    }
}

