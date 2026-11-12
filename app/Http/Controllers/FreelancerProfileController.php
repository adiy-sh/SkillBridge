<?php

namespace App\Http\Controllers;

use App\Models\FreelancerProfile;
use App\Models\Skill;
use App\Models\UserSkill;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FreelancerProfileController extends Controller
{
    /**
     * Show the freelancer's editable profile + skills.
     * Creates the FreelancerProfile record on first visit.
     */
    public function edit(Request $request): View
    {
        $user    = $request->user();
        $profile = $user->freelancerProfile
                ?? FreelancerProfile::create(['user_id' => $user->id]);

        $skills           = Skill::orderBy('name')->get();
        $userSkills       = $user->userSkills()->with('skill')->get()->keyBy('skill_id');
        $availabilityOpts = config('skillbridge.availability_options');
        $proficiencyOpts  = config('skillbridge.proficiency_levels');

        return view('freelancer.profile-edit', compact(
            'user', 'profile', 'skills', 'userSkills',
            'availabilityOpts', 'proficiencyOpts'
        ));
    }

    /**
     * Update the freelancer's profile fields.
     */
    public function update(Request $request): RedirectResponse
    {
        $user = $request->user();

        abort_unless($user->isFreelancer(), 403);

        $data = $request->validate([
            'headline'    => ['nullable', 'string', 'max:255'],
            'bio'         => ['nullable', 'string'],
            'hourly_rate' => ['nullable', 'numeric', 'min:0'],
            'availability'=> ['nullable', 'in:' . implode(',', array_keys(config('skillbridge.availability_options')))],
        ]);

        $profile = $user->freelancerProfile
                ?? FreelancerProfile::create(['user_id' => $user->id]);

        $profile->update($data);

        return redirect()->route('freelancer.profile.edit')
                         ->with('success', 'Profile updated.');
    }

    /**
     * Add or update a skill on the freelancer's profile.
     */
    public function addSkill(Request $request): RedirectResponse
    {
        $user = $request->user();
        abort_unless($user->isFreelancer(), 403);

        $data = $request->validate([
            'skill_id'   => ['required', 'integer', 'exists:skills,id'],
            'proficiency'=> ['required', 'integer', 'min:1', 'max:5'],
        ]);

        UserSkill::updateOrCreate(
            ['user_id' => $user->id, 'skill_id' => $data['skill_id']],
            ['proficiency' => $data['proficiency']]
        );

        return redirect()->route('freelancer.profile.edit')
                         ->with('success', 'Skill saved.');
    }

    /**
     * Remove a skill from the freelancer's profile.
     */
    public function removeSkill(Request $request, UserSkill $userSkill): RedirectResponse
    {
        abort_unless($request->user()->id === $userSkill->user_id, 403);

        $userSkill->delete();

        return redirect()->route('freelancer.profile.edit')
                         ->with('success', 'Skill removed.');
    }
}

