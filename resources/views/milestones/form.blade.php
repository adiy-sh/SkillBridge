<div>
    <label class="block text-sm font-medium text-gray-700">Title</label>
    <input type="text" name="title" value="{{ old('title', $milestone->title ?? '') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm border p-2">
</div>

<div>
    <label class="block text-sm font-medium text-gray-700">Description</label>
    <textarea name="description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm border p-2">{{ old('description', $milestone->description ?? '') }}</textarea>
</div>

<div>
    <label class="block text-sm font-medium text-gray-700">Acceptance Criteria</label>
    <textarea name="acceptance_criteria" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm border p-2">{{ old('acceptance_criteria', $milestone->acceptance_criteria ?? '') }}</textarea>
</div>

<div class="grid grid-cols-2 gap-4">
    <div>
        <label class="block text-sm font-medium text-gray-700">Amount ($)</label>
        <input type="number" step="0.01" name="amount" value="{{ old('amount', $milestone->amount ?? '') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm border p-2">
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Due Date</label>
        <input type="date" name="due_date" value="{{ old('due_date', isset($milestone) && $milestone->due_date ? $milestone->due_date->format('Y-m-d') : '') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm border p-2">
    </div>
</div>

<div class="grid grid-cols-2 gap-4">
    <div>
        <label class="block text-sm font-medium text-gray-700">Status</label>
        <select name="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm border p-2">
            <option value="pending" {{ (old('status', $milestone->status ?? '') === 'pending') ? 'selected' : '' }}>Pending</option>
            <option value="in_progress" {{ (old('status', $milestone->status ?? '') === 'in_progress') ? 'selected' : '' }}>In Progress</option>
            <option value="completed" {{ (old('status', $milestone->status ?? '') === 'completed') ? 'selected' : '' }}>Completed</option>
            <option value="released" {{ (old('status', $milestone->status ?? '') === 'released') ? 'selected' : '' }}>Released</option>
        </select>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Depends on (Optional)</label>
        <select name="dependencies[]" multiple class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm border p-2 h-24">
            @foreach($project->milestones as $existing)
                @if(!isset($milestone) || $existing->id !== $milestone->id)
                    <option value="{{ $existing->id }}" {{ (isset($milestone) && $milestone->dependencies->contains($existing->id)) ? 'selected' : '' }}>
                        {{ $existing->title }}
                    </option>
                @endif
            @endforeach
        </select>
    </div>
</div>