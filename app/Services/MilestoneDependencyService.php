<?php

namespace App\Services;

use App\Models\Milestone;

class MilestoneDependencyService
{
    /**
     * Returns true if making $milestoneId depend on $dependencyIds would create a loop.
     */
    public function createsCycle(int $milestoneId, array $dependencyIds): bool
    {
        foreach ($dependencyIds as $depId) {
            if ((int) $depId === $milestoneId) {
                return true; // depends on itself
            }
            if ($this->reaches((int) $depId, $milestoneId, [])) {
                return true; // the dependency already depends (directly or not) on this milestone
            }
        }
        return false;
    }

    // Walks the "depends on" chain from $from, looking for $target.
    private function reaches(int $from, int $target, array $visited): bool
    {
        if ($from === $target) {
            return true;
        }
        if (in_array($from, $visited, true)) {
            return false;
        }
        $visited[] = $from;

        $next = Milestone::find($from)?->dependencies()->pluck('milestones.id') ?? collect();
        foreach ($next as $id) {
            if ($this->reaches((int) $id, $target, $visited)) {
                return true;
            }
        }
        return false;
    }
}