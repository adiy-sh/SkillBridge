<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Milestone extends Model
{
    public const STATUSES = ['pending', 'in_progress', 'submitted', 'completed'];

    protected $fillable = [
        'project_id', 'title', 'description', 'acceptance_criteria',
        'amount', 'due_date', 'status', 'position', 'is_overdue',
    ];

    protected $casts = [
        'due_date' => 'date',
        'is_overdue' => 'boolean',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    // Milestones this one depends on (must finish first)
    public function dependencies()
    {
        return $this->belongsToMany(Milestone::class, 'milestone_dependencies', 'milestone_id', 'depends_on_id');
    }

    // Milestones that depend on this one
    public function dependents()
    {
        return $this->belongsToMany(Milestone::class, 'milestone_dependencies', 'depends_on_id', 'milestone_id');
    }
}