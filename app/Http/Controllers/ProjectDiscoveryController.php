<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectDiscoveryRequest;
use App\Models\User;
use App\Services\ProjectFilterService;
use Illuminate\View\View;

class ProjectDiscoveryController extends Controller
{
    public function __construct(private readonly ProjectFilterService $filterService)
    {
    }

    public function index(ProjectDiscoveryRequest $request): View
    {
        $this->authorize('viewAny', \App\Models\Project::class);

        $criteria = $request->validated();

        $projects = $this->filterService
                         ->query($criteria)
                         ->paginate(15)
                         ->withQueryString();

        $categories       = config('skillbridge.categories');
        $experienceLevels = config('skillbridge.experience_levels');
        $workArrangements = config('skillbridge.work_arrangements');

        return view('projects.index', compact(
            'projects', 'criteria',
            'categories', 'experienceLevels', 'workArrangements'
        ));
    }
}

