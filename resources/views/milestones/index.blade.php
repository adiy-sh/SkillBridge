@php
    $badge = [
        'pending'     => 'bg-gray-100 text-gray-700',
        'in_progress' => 'bg-blue-100 text-blue-800',
        'submitted'   => 'bg-yellow-100 text-yellow-800',
        'completed'   => 'bg-green-100 text-green-800',
    ];
@endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $project->title }}: Milestones</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 space-y-4">
            @if (session('success'))
                <div class="rounded-md bg-green-50 p-3 text-sm text-green-800">{{ session('success') }}</div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <div class="flex items-center justify-between mb-3">
                    <div>
                        <p class="text-sm text-gray-500">Project progress</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $projectProgress }}%</p>
                    </div>
                    <div class="flex items-center gap-4">
                        <a href="{{ route('projects.show', $project) }}" class="text-sm text-gray-600 hover:underline">Back to project</a>
                        <a href="{{ route('projects.milestones.create', $project) }}"
                           class="inline-flex items-center px-4 py-2 bg-gray-800 text-white text-xs font-semibold uppercase tracking-widest rounded-md hover:bg-gray-700">Add milestone</a>
                    </div>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-indigo-600 h-2 rounded-full" style="width: {{ $projectProgress }}%"></div>
                </div>
            </div>

            <div class="bg-white shadow-sm sm:rounded-lg overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-50 text-left text-xs font-medium uppercase text-gray-500">
                        <tr>
                            <th class="px-4 py-3">Title</th>
                            <th class="px-4 py-3">Due</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3">Progress</th>
                            <th class="px-4 py-3">Depends on</th>
                            <th class="px-4 py-3"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($milestones as $m)
                            <tr>
                                <td class="px-4 py-3 font-medium text-gray-900">{{ $m->title }}</td>
                                <td class="px-4 py-3 text-gray-600">{{ $m->due_date->format('Y-m-d') }}</td>
                                <td class="px-4 py-3">
                                    <span class="px-2 py-1 rounded-full text-xs {{ $badge[$m->status] ?? $badge['pending'] }}">{{ str_replace('_', ' ', $m->status) }}</span>
                                    @if ($m->is_overdue)
                                        <span class="ml-1 px-2 py-1 rounded-full text-xs bg-red-100 text-red-700 font-semibold">OVERDUE</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-gray-600">{{ $progressByMilestone[$m->id] }}%</td>
                                <td class="px-4 py-3 text-gray-600">{{ $m->dependencies->pluck('title')->join(', ') ?: '-' }}</td>
                                <td class="px-4 py-3 text-right whitespace-nowrap">
                                    <a href="{{ route('projects.milestones.edit', [$project, $m]) }}" class="text-indigo-600 hover:underline">Edit</a>
                                    <form method="POST" action="{{ route('projects.milestones.destroy', [$project, $m]) }}" class="inline"
                                          onsubmit="return confirm('Delete this milestone?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="ml-3 text-red-600 hover:underline">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="px-4 py-6 text-center text-gray-500">No milestones yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>