<?php

namespace App\Services;

use App\Models\Milestone;
use App\Models\Project;

class ProgressService
{
    private const STATUS_PROGRESS = [
        'pending'     => 0,
        'in_progress' => 50,
        'submitted'   => 90,
        'completed'   => 100,
    ];

    public function milestoneProgress(Milestone $milestone): int
    {
        return self::STATUS_PROGRESS[$milestone->status] ?? 0;
    }

    public function projectProgress(Project $project): int
    {
        $milestones = $project->milestones;

        if ($milestones->isEmpty()) {
            return 0;
        }

        return (int) round($milestones->avg(fn ($m) => $this->milestoneProgress($m)));
    }
}