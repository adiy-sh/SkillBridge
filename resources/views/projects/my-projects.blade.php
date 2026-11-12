<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">My Projects</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
            @endif

            <div class="mb-4 flex justify-end">
                <a href="{{ route('projects.create') }}"
                   class="px-4 py-2 bg-indigo-600 text-white text-sm rounded-md hover:bg-indigo-700">
                    + Post a Project
                </a>
            </div>

            @if($projects->isEmpty())
                <div class="bg-white rounded-lg shadow p-8 text-center text-gray-500">
                    You haven't posted any projects yet.
                </div>
            @else
                <div class="space-y-4">
                    @foreach($projects as $project)
                        <div class="bg-white rounded-lg shadow p-5 flex items-center justify-between gap-4">
                            <div>
                                <h3 class="font-semibold text-gray-800">
                                    <a href="{{ route('projects.show', $project) }}"
                                       class="hover:text-indigo-600">{{ $project->title }}</a>
                                </h3>
                                <div class="text-sm text-gray-500 mt-1 flex gap-3 flex-wrap">
                                    <span class="px-2 py-0.5 rounded-full text-xs
                                        {{ $project->status === 'open' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                                        {{ ucfirst($project->status) }}
                                    </span>
                                    @if($project->budget)
                                        <span>৳{{ number_format($project->budget, 0) }}</span>
                                    @endif
                                    @if($project->deadline)
                                        <span>Due {{ $project->deadline->format('M j, Y') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="flex gap-2 shrink-0">
                                <a href="{{ route('projects.edit', $project) }}"
                                   class="px-3 py-1 text-sm border border-gray-300 rounded hover:bg-gray-50">Edit</a>
                                <a href="{{ route('projects.show', $project) }}"
                                   class="px-3 py-1 text-sm bg-indigo-600 text-white rounded hover:bg-indigo-700">View</a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-6">{{ $projects->links() }}</div>
            @endif
        </div>
    </div>
</x-app-layout>

