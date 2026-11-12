<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Project extends Model
{
    protected $fillable = [
        'client_id', 'title', 'description', 'budget', 'deadline', 'status',
        'category', 'experience_level', 'work_arrangement',
    ];

    /** Treat deadline as a date object, so views can call ->format(). */
    protected function casts(): array
    {
        return [
            'deadline' => 'date',
            'budget'   => 'decimal:2',
        ];
    }

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function milestones()
    {
        return $this->hasMany(Milestone::class);
    }

    /** Skills required for this project (pivot: project_skills). */
    public function skills(): BelongsToMany
    {
        return $this->belongsToMany(Skill::class, 'project_skills')
                    ->withPivot('min_proficiency');
    }

    // ── Scopes ────────────────────────────────────────────────────────────────

    /** Only projects with status = 'open'. */
    public function scopeOpen(Builder $query): Builder
    {
        return $query->where('status', 'open');
    }
}