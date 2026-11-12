<?php

namespace App\Http\Controllers;

use App\Http\Requests\SkillEndorsementRequest;
use App\Models\SkillEndorsement;
use App\Models\UserSkill;
use Illuminate\Http\RedirectResponse;

class SkillEndorsementController extends Controller
{
    /**
     * Store a new endorsement.
     */
    public function store(SkillEndorsementRequest $request): RedirectResponse
    {
        $userSkill = UserSkill::findOrFail($request->input('user_skill_id'));

        $this->authorize('create', [SkillEndorsement::class, $userSkill]);

        // idempotent: if already endorsed, just redirect back
        SkillEndorsement::firstOrCreate(
            [
                'user_skill_id'  => $userSkill->id,
                'endorsed_by_id' => $request->user()->id,
            ],
            ['note' => $request->input('note')]
        );

        $freelancer = $userSkill->user;

        return redirect()->route('freelancers.show', $freelancer)
                         ->with('success', 'Endorsement added.');
    }

    /**
     * Remove an endorsement.
     */
    public function destroy(SkillEndorsement $skillEndorsement): RedirectResponse
    {
        $this->authorize('delete', $skillEndorsement);

        $freelancer = $skillEndorsement->userSkill->user;

        $skillEndorsement->delete();

        return redirect()->route('freelancers.show', $freelancer)
                         ->with('success', 'Endorsement removed.');
    }
}

