<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Skill extends Model
{
    protected $fillable = ['name', 'category'];

    /** Users who have this skill (pivot: user_skills). */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_skills')
                    ->withPivot('proficiency')
                    ->withTimestamps();
    }

    /** Projects that require this skill (pivot: project_skills). */
    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, 'project_skills')
                    ->withPivot('min_proficiency');
    }

    /** UserSkill pivot records for this skill. */
    public function userSkills(): HasMany
    {
        return $this->hasMany(UserSkill::class);
    }
}

