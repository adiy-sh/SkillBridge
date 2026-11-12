<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $project->title }}
            </h2>
            @can('update', $project)
                <div class="flex gap-2">
                    <a href="{{ route('projects.edit', $project) }}"
                       class="px-4 py-2 bg-indigo-600 text-white text-sm rounded-md hover:bg-indigo-700">Edit</a>
                    @if($project->status === 'open')
                        <form method="POST" action="{{ route('projects.close', $project) }}">
                            @csrf @method('PATCH')
                            <button class="px-4 py-2 bg-red-600 text-white text-sm rounded-md hover:bg-red-700">
                                Close Project
                            </button>
                        </form>
                    @endif
                </div>
            @endcan
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if(session('success'))
                <div class="p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
            @endif

            {{-- Status badge --}}
            <div>
                <span class="inline-block px-3 py-1 rounded-full text-sm font-medium
                    {{ $project->status === 'open' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-600' }}">
                    {{ ucfirst($project->status) }}
                </span>
            </div>

            {{-- Details card --}}
            <div class="bg-white shadow rounded-lg p-6 grid sm:grid-cols-2 gap-4">
                <div>
                    <p class="text-xs font-medium text-gray-500 uppercase">Client</p>
                    <p class="text-gray-800">{{ $project->client->name }}</p>
                </div>
                @if($project->budget)
                <div>
                    <p class="text-xs font-medium text-gray-500 uppercase">Budget</p>
                    <p class="text-gray-800">৳{{ number_format($project->budget, 2) }}</p>
                </div>
                @endif
                @if($project->deadline)
                <div>
                    <p class="text-xs font-medium text-gray-500 uppercase">Deadline</p>
                    <p class="text-gray-800">{{ $project->deadline->format('M j, Y') }}</p>
                </div>
                @endif
                @if($project->category)
                <div>
                    <p class="text-xs font-medium text-gray-500 uppercase">Category</p>
                    <p class="text-gray-800">{{ config('skillbridge.categories')[$project->category] ?? $project->category }}</p>
                </div>
                @endif
                @if($project->experience_level)
                <div>
                    <p class="text-xs font-medium text-gray-500 uppercase">Experience level</p>
                    <p class="text-gray-800">{{ config('skillbridge.experience_levels')[$project->experience_level] ?? $project->experience_level }}</p>
                </div>
                @endif
                @if($project->work_arrangement)
                <div>
                    <p class="text-xs font-medium text-gray-500 uppercase">Work arrangement</p>
                    <p class="text-gray-800">{{ config('skillbridge.work_arrangements')[$project->work_arrangement] ?? $project->work_arrangement }}</p>
                </div>
                @endif
            </div>

            {{-- Description --}}
            @if($project->description)
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="font-semibold text-gray-700 mb-2">Description</h3>
                <p class="text-gray-700 whitespace-pre-line">{{ $project->description }}</p>
            </div>
            @endif

            {{-- Required skills --}}
            @if($project->skills->isNotEmpty())
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="font-semibold text-gray-700 mb-3">Required Skills</h3>
                <div class="flex flex-wrap gap-2">
                    @foreach($project->skills as $skill)
                        <span class="px-3 py-1 bg-indigo-50 text-indigo-700 rounded-full text-sm">
                            {{ $skill->name }}
                            @if($skill->pivot->min_proficiency)
                                <span class="text-xs opacity-70">
                                    (min: {{ config('skillbridge.proficiency_levels')[$skill->pivot->min_proficiency] ?? $skill->pivot->min_proficiency }})
                                </span>
                            @endif
                        </span>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- Milestones link (Walid's module) --}}
            <div class="bg-white shadow rounded-lg p-6 flex items-center justify-between">
                <div>
                    <h3 class="font-semibold text-gray-700">Milestones</h3>
                    <p class="text-sm text-gray-500">{{ $project->milestones->count() }} milestone(s)</p>
                </div>
                <a href="{{ route('projects.milestones.index', $project) }}"
                   class="px-4 py-2 bg-gray-800 text-white text-sm rounded-md hover:bg-gray-700">
                    View Milestones
                </a>
            </div>

        </div>
    </div>
</x-app-layout>

