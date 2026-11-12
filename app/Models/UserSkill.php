<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserSkill extends Model
{
    protected $fillable = ['user_id', 'skill_id', 'proficiency'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function skill(): BelongsTo
    {
        return $this->belongsTo(Skill::class);
    }

    /** Endorsements received for this user–skill combination. */
    public function endorsements(): HasMany
    {
        return $this->hasMany(SkillEndorsement::class);
    }
}

