<?php

namespace App\Http\Controllers;

use App\Services\ProgressService;
use App\Services\MilestoneDependencyService;
use App\Http\Requests\MilestoneRequest;
use App\Models\Milestone;
use App\Models\Project;

class MilestoneController extends Controller
{
    public function index(Project $project)
    {
        $milestones = $project->milestones()->with('dependencies')->orderBy('position')->orderBy('due_date')->get();

        $service = new ProgressService();
        $projectProgress = $service->projectProgress($project);
        $progressByMilestone = $milestones->mapWithKeys(fn ($m) => [$m->id => $service->milestoneProgress($m)]);

        return view('milestones.index', compact('project', 'milestones', 'projectProgress', 'progressByMilestone'));
    }

    public function create(Project $project)
    {
        $others = $project->milestones;
        return view('milestones.form', ['project' => $project, 'milestone' => new Milestone(), 'others' => $others]);
    }

    public function store(MilestoneRequest $request, Project $project)
    {
        $milestone = $project->milestones()->create($request->safe()->except('dependencies'));
        $milestone->dependencies()->sync($request->input('dependencies', []));
        return redirect()->route('projects.milestones.index', $project)->with('success', 'Milestone created.');
    }

    public function edit(Project $project, Milestone $milestone)
    {
        abort_unless($milestone->project_id === $project->id, 404);
        $others = $project->milestones->where('id', '!=', $milestone->id);
        return view('milestones.form', compact('project', 'milestone', 'others'));
    }

    public function update(MilestoneRequest $request, Project $project, Milestone $milestone)
    {
        abort_unless($milestone->project_id === $project->id, 404);

	if ((new MilestoneDependencyService())->createsCycle($milestone->id, $request->	input('dependencies', []))) {
    		return back()->withInput()->withErrors(['dependencies' => 'These dependencies would create a loop.']);
	}

        $milestone->update($request->safe()->except('dependencies'));
        $milestone->dependencies()->sync($request->input('dependencies', []));
        return redirect()->route('projects.milestones.index', $project)->with('success', 'Milestone updated.');
    }

    public function destroy(Project $project, Milestone $milestone)
    {
        abort_unless($milestone->project_id === $project->id, 404);
        $milestone->delete();
        return redirect()->route('projects.milestones.index', $project)->with('success', 'Milestone deleted.');
    }
}