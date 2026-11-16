@php
    $input = 'mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500';
    $selectedDeps = old('dependencies', $milestone->exists ? $milestone->dependencies->pluck('id')->all() : []);
@endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $milestone->exists ? 'Edit' : 'New' }} milestone</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <form method="POST"
                  action="{{ $milestone->exists ? route('projects.milestones.update', [$project, $milestone]) : route('projects.milestones.store', $project) }}"
                  class="bg-white shadow-sm sm:rounded-lg p-6 space-y-4">
                @csrf
                @if ($milestone->exists) @method('PUT') @endif

                <div>
                    <label class="block text-sm font-medium text-gray-700">Title</label>
                    <input name="title" class="{{ $input }}" value="{{ old('title', $milestone->title) }}">
                    @error('title') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea name="description" rows="2" class="{{ $input }}">{{ old('description', $milestone->description) }}</textarea>
                    @error('description') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Acceptance criteria</label>
                    <textarea name="acceptance_criteria" rows="2" class="{{ $input }}">{{ old('acceptance_criteria', $milestone->acceptance_criteria) }}</textarea>
                    @error('acceptance_criteria') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Amount</label>
                        <input name="amount" class="{{ $input }}" value="{{ old('amount', $milestone->amount) }}">
                        @error('amount') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Due date</label>
                        <input type="date" name="due_date" class="{{ $input }}" value="{{ old('due_date', optional($milestone->due_date)->format('Y-m-d')) }}">
                        @error('due_date') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Status</label>
                    <select name="status" class="{{ $input }}">
                        @foreach (\App\Models\Milestone::STATUSES as $s)
                            <option value="{{ $s }}" @selected(old('status', $milestone->status ?: 'pending') === $s)>{{ str_replace('_', ' ', $s) }}</option>
                        @endforeach
                    </select>
                    @error('status') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Depends on (hold Ctrl to select several)</label>
                    <select name="dependencies[]" multiple class="{{ $input }}">
                        @foreach ($others as $o)
                            <option value="{{ $o->id }}" @selected(in_array($o->id, $selectedDeps))>{{ $o->title }}</option>
                        @endforeach
                    </select>
                    @error('dependencies') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div class="flex items-center gap-4">
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 text-white text-xs font-semibold uppercase tracking-widest rounded-md hover:bg-gray-700">Save</button>
                    <a href="{{ route('projects.milestones.index', $project) }}" class="text-sm text-gray-600 hover:underline">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>