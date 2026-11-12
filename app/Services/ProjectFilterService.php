<?php

namespace App\Services;

use App\Models\Project;
use Illuminate\Database\Eloquent\Builder;

class ProjectFilterService
{
    /**
     * Build an Eloquent query for open projects from a flat criteria array.
     *
     * Keys accepted:
     *   budget_min, budget_max, category, deadline_before,
     *   experience_level, work_arrangement, sort
     *
     * The criteria array is intentionally kept as a plain array so Sprint 2
     * can persist and replay it without changes to this service.
     *
     * @param  array<string, mixed>  $criteria
     */
    public function query(array $criteria): Builder
    {
        $q = Project::open()->with(['client:id,name', 'skills']);

        if (!empty($criteria['budget_min'])) {
            $q->where('budget', '>=', $criteria['budget_min']);
        }

        if (!empty($criteria['budget_max'])) {
            $q->where('budget', '<=', $criteria['budget_max']);
        }

        if (!empty($criteria['category'])) {
            $q->where('category', $criteria['category']);
        }

        if (!empty($criteria['deadline_before'])) {
            $q->whereDate('deadline', '<=', $criteria['deadline_before']);
        }

        if (!empty($criteria['experience_level'])) {
            $q->where('experience_level', $criteria['experience_level']);
        }

        if (!empty($criteria['work_arrangement'])) {
            $q->where('work_arrangement', $criteria['work_arrangement']);
        }

        match ($criteria['sort'] ?? 'newest') {
            'budget_asc'   => $q->orderBy('budget'),
            'budget_desc'  => $q->orderByDesc('budget'),
            'deadline_asc' => $q->orderBy('deadline'),
            default        => $q->latest(),
        };

        return $q;
    }
}

