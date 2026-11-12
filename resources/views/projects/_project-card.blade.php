<div class="bg-white rounded-lg shadow p-5 flex flex-col gap-3 hover:shadow-md transition">

    {{-- Header --}}
    <div class="flex items-start justify-between gap-2">
        <h3 class="font-semibold text-gray-800 text-sm leading-snug">
            <a href="{{ route('projects.show', $project) }}"
               class="hover:text-indigo-600">{{ $project->title }}</a>
        </h3>
        @if($project->category)
            <span class="shrink-0 text-xs bg-indigo-50 text-indigo-700 px-2 py-0.5 rounded-full">
                {{ config('skillbridge.categories')[$project->category] ?? $project->category }}
            </span>
        @endif
    </div>

    {{-- Meta --}}
    <div class="text-xs text-gray-500 space-y-1">
        @if($project->budget)
            <div>💰 <span class="font-medium text-gray-700">৳{{ number_format($project->budget, 0) }}</span></div>
        @endif
        @if($project->deadline)
            <div>📅 Due {{ $project->deadline->format('M j, Y') }}</div>
        @endif
        @if($project->experience_level)
            <div>🎓 {{ config('skillbridge.experience_levels')[$project->experience_level] ?? $project->experience_level }}</div>
        @endif
        @if($project->work_arrangement)
            <div>🏢 {{ config('skillbridge.work_arrangements')[$project->work_arrangement] ?? $project->work_arrangement }}</div>
        @endif
        <div>👤 {{ $project->client->name }}</div>
    </div>

    {{-- Skills tags --}}
    @if($project->skills->isNotEmpty())
        <div class="flex flex-wrap gap-1">
            @foreach($project->skills as $skill)
                <span class="text-xs bg-gray-100 text-gray-600 px-2 py-0.5 rounded">{{ $skill->name }}</span>
            @endforeach
        </div>
    @endif

    {{-- CTA --}}
    <a href="{{ route('projects.show', $project) }}"
       class="mt-auto text-center text-xs font-semibold bg-indigo-600 text-white px-3 py-2 rounded-md hover:bg-indigo-700 transition">
        View Details
    </a>
</div>

