<form method="GET" action="{{ route('projects.index') }}"
      class="bg-white rounded-lg shadow p-4 space-y-4">

    <h3 class="font-semibold text-gray-700 text-sm uppercase tracking-wide">Filters</h3>

    {{-- Budget range --}}
    <div>
        <label class="block text-xs font-medium text-gray-600 mb-1">Budget (৳)</label>
        <div class="flex gap-2">
            <input type="number" name="budget_min" placeholder="Min"
                   value="{{ $criteria['budget_min'] ?? '' }}"
                   class="w-full border-gray-300 rounded-md shadow-sm text-sm">
            <input type="number" name="budget_max" placeholder="Max"
                   value="{{ $criteria['budget_max'] ?? '' }}"
                   class="w-full border-gray-300 rounded-md shadow-sm text-sm">
        </div>
    </div>

    {{-- Category --}}
    <div>
        <label class="block text-xs font-medium text-gray-600 mb-1">Category</label>
        <select name="category" class="w-full border-gray-300 rounded-md shadow-sm text-sm">
            <option value="">All categories</option>
            @foreach($categories as $key => $label)
                <option value="{{ $key }}" @selected(($criteria['category'] ?? '') === $key)>{{ $label }}</option>
            @endforeach
        </select>
    </div>

    {{-- Deadline before --}}
    <div>
        <label class="block text-xs font-medium text-gray-600 mb-1">Deadline before</label>
        <input type="date" name="deadline_before"
               value="{{ $criteria['deadline_before'] ?? '' }}"
               class="w-full border-gray-300 rounded-md shadow-sm text-sm">
    </div>

    {{-- Experience level --}}
    <div>
        <label class="block text-xs font-medium text-gray-600 mb-1">Experience level</label>
        <select name="experience_level" class="w-full border-gray-300 rounded-md shadow-sm text-sm">
            <option value="">Any level</option>
            @foreach($experienceLevels as $key => $label)
                <option value="{{ $key }}" @selected(($criteria['experience_level'] ?? '') === $key)>{{ $label }}</option>
            @endforeach
        </select>
    </div>

    {{-- Work arrangement --}}
    <div>
        <label class="block text-xs font-medium text-gray-600 mb-1">Work arrangement</label>
        <select name="work_arrangement" class="w-full border-gray-300 rounded-md shadow-sm text-sm">
            <option value="">Any arrangement</option>
            @foreach($workArrangements as $key => $label)
                <option value="{{ $key }}" @selected(($criteria['work_arrangement'] ?? '') === $key)>{{ $label }}</option>
            @endforeach
        </select>
    </div>

    {{-- Sort --}}
    <div>
        <label class="block text-xs font-medium text-gray-600 mb-1">Sort by</label>
        <select name="sort" class="w-full border-gray-300 rounded-md shadow-sm text-sm">
            <option value="newest"       @selected(($criteria['sort'] ?? 'newest') === 'newest')>Newest first</option>
            <option value="budget_desc"  @selected(($criteria['sort'] ?? '') === 'budget_desc')>Budget: high → low</option>
            <option value="budget_asc"   @selected(($criteria['sort'] ?? '') === 'budget_asc')>Budget: low → high</option>
            <option value="deadline_asc" @selected(($criteria['sort'] ?? '') === 'deadline_asc')>Deadline: soonest</option>
        </select>
    </div>

    <div class="flex gap-2 pt-2">
        <button type="submit"
                class="flex-1 bg-indigo-600 text-white text-sm py-2 rounded-md hover:bg-indigo-700 transition">
            Apply
        </button>
        <a href="{{ route('projects.index') }}"
           class="flex-1 text-center bg-gray-100 text-gray-700 text-sm py-2 rounded-md hover:bg-gray-200 transition">
            Clear
        </a>
    </div>
</form>

