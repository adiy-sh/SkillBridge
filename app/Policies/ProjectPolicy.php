<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\User;

class ProjectPolicy
{
    /**
     * Any authenticated user may browse the project list.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Any authenticated user may view a single project.
     */
    public function view(User $user, Project $project): bool
    {
        return true;
    }

    /**
     * Only clients may create projects.
     */
    public function create(User $user): bool
    {
        return $user->isClient();
    }

    /**
     * Only the owning client may edit the project.
     */
    public function update(User $user, Project $project): bool
    {
        return $user->isClient() && $user->id === $project->client_id;
    }

    /**
     * Only the owning client may close the project.
     */
    public function close(User $user, Project $project): bool
    {
        return $user->isClient() && $user->id === $project->client_id;
    }

    /**
     * Only the owning client may delete the project.
     */
    public function delete(User $user, Project $project): bool
    {
        return $user->isClient() && $user->id === $project->client_id;
    }
}

