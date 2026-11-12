<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use App\Models\Skill;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProjectController extends Controller
{
    /**
     * "My Projects": the logged-in client's own projects.
     * Only users who may post projects (clients) can see this page.
     */
    public function index(): View
    {
        $this->authorize('create', Project::class);

        $projects = auth()->user()->projects()->with('skills')->latest()->paginate(10);

        return view('projects.my-projects', compact('projects'));
    }

    public function create(): View
    {
        $this->authorize('create', Project::class);

        $skills           = Skill::orderBy('name')->get();
        $categories       = config('skillbridge.categories');
        $experienceLevels = config('skillbridge.experience_levels');
        $workArrangements = config('skillbridge.work_arrangements');

        return view('projects.create', compact('skills', 'categories', 'experienceLevels', 'workArrangements'));
    }

    public function store(StoreProjectRequest $request): RedirectResponse
    {
        $this->authorize('create', Project::class);

        $project = $request->user()->projects()->create(
            $request->safe()->except(['skills', 'min_proficiency'])
        );

        $this->syncSkills($project, $request);

        return redirect()->route('projects.show', $project)
                         ->with('success', 'Project posted successfully.');
    }

    public function show(Project $project): View
    {
        $this->authorize('view', $project);

        $project->load(['client', 'skills', 'milestones']);

        return view('projects.show', compact('project'));
    }

    public function edit(Project $project): View
    {
        $this->authorize('update', $project);

        $skills           = Skill::orderBy('name')->get();
        $categories       = config('skillbridge.categories');
        $experienceLevels = config('skillbridge.experience_levels');
        $workArrangements = config('skillbridge.work_arrangements');
        $selectedSkills   = $project->skills->keyBy('id');

        return view('projects.edit', compact(
            'project', 'skills', 'categories',
            'experienceLevels', 'workArrangements', 'selectedSkills'
        ));
    }

    public function update(UpdateProjectRequest $request, Project $project): RedirectResponse
    {
        $this->authorize('update', $project);

        $project->update($request->safe()->except(['skills', 'min_proficiency']));

        $this->syncSkills($project, $request);

        return redirect()->route('projects.show', $project)
                         ->with('success', 'Project updated.');
    }

    /**
     * Close the project (set status to 'closed').
     * Uses a custom policy action 'close'.
     */
    public function close(Project $project): RedirectResponse
    {
        $this->authorize('close', $project);

        $project->update(['status' => 'closed']);

        return redirect()->route('projects.show', $project)
                         ->with('success', 'Project closed.');
    }

    // ── Helpers ───────────────────────────────────────────────────────────────

    private function syncSkills(Project $project, Request $request): void
    {
        $skillIds       = $request->input('skills', []);
        $minProficiency = $request->input('min_proficiency', []);

        $pivot = [];
        foreach ($skillIds as $id) {
            $pivot[$id] = ['min_proficiency' => $minProficiency[$id] ?? null];
        }

        $project->skills()->sync($pivot);
    }
}