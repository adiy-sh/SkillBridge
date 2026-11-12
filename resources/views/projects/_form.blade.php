{{-- Shared form fields for create and edit project views --}}

<div class="space-y-5">

    {{-- Title --}}
    <div>
        <x-input-label for="title" value="Project Title *" />
        <x-text-input id="title" name="title" class="mt-1 block w-full"
                      :value="old('title', $project?->title)" required />
        <x-input-error :messages="$errors->get('title')" class="mt-1" />
    </div>

    {{-- Description --}}
    <div>
        <x-input-label for="description" value="Description" />
        <textarea id="description" name="description" rows="4"
                  class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('description', $project?->description) }}</textarea>
        <x-input-error :messages="$errors->get('description')" class="mt-1" />
    </div>

    {{-- Budget --}}
    <div>
        <x-input-label for="budget" value="Budget (Taka)" />
        <x-text-input id="budget" name="budget" type="number" min="0" step="0.01"
                      class="mt-1 block w-full"
                      :value="old('budget', $project?->budget)" />
        <x-input-error :messages="$errors->get('budget')" class="mt-1" />
    </div>

    {{-- Deadline --}}
    <div>
        <x-input-label for="deadline" value="Deadline" />
        <x-text-input id="deadline" name="deadline" type="date"
                      class="mt-1 block w-full"
                      :value="old('deadline', $project?->deadline?->format('Y-m-d'))" />
        <x-input-error :messages="$errors->get('deadline')" class="mt-1" />
    </div>

    {{-- Category --}}
    <div>
        <x-input-label for="category" value="Category" />
        <select id="category" name="category"
                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
            <option value="">— Select —</option>
            @foreach($categories as $key => $label)
                <option value="{{ $key }}" @selected(old('category', $project?->category) === $key)>{{ $label }}</option>
            @endforeach
        </select>
        <x-input-error :messages="$errors->get('category')" class="mt-1" />
    </div>

    {{-- Experience level --}}
    <div>
        <x-input-label for="experience_level" value="Experience Level Required" />
        <select id="experience_level" name="experience_level"
                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
            <option value="">— Any —</option>
            @foreach($experienceLevels as $key => $label)
                <option value="{{ $key }}" @selected(old('experience_level', $project?->experience_level) === $key)>{{ $label }}</option>
            @endforeach
        </select>
        <x-input-error :messages="$errors->get('experience_level')" class="mt-1" />
    </div>

    {{-- Work arrangement --}}
    <div>
        <x-input-label for="work_arrangement" value="Work Arrangement" />
        <select id="work_arrangement" name="work_arrangement"
                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
            <option value="">— Any —</option>
            @foreach($workArrangements as $key => $label)
                <option value="{{ $key }}" @selected(old('work_arrangement', $project?->work_arrangement) === $key)>{{ $label }}</option>
            @endforeach
        </select>
        <x-input-error :messages="$errors->get('work_arrangement')" class="mt-1" />
    </div>

    {{-- Required Skills --}}
    <div>
        <x-input-label value="Required Skills (optional)" />
        <p class="text-xs text-gray-500 mb-2">Select each skill and optionally set a minimum proficiency level.</p>

        <div class="space-y-2 max-h-64 overflow-y-auto border border-gray-200 rounded-md p-3">
            @foreach($skills as $skill)
                @php
                    $checked = in_array($skill->id, old('skills', $project ? $project->skills->pluck('id')->toArray() : []));
                    $existingProficiency = $project ? optional($selectedSkills[$skill->id] ?? null)?->pivot?->min_proficiency : null;
                @endphp
                <div class="flex items-center gap-3" x-data="{ on: {{ $checked ? 'true' : 'false' }} }">
                    <input type="checkbox"
                           id="skill_{{ $skill->id }}"
                           name="skills[]"
                           value="{{ $skill->id }}"
                           x-model="on"
                           @if($checked) checked @endif
                           class="rounded border-gray-300 text-indigo-600 shadow-sm">
                    <label for="skill_{{ $skill->id }}" class="text-sm text-gray-700 flex-1">{{ $skill->name }}</label>
                    <select name="min_proficiency[{{ $skill->id }}]"
                            x-show="on"
                            class="text-xs border-gray-300 rounded shadow-sm">
                        <option value="">Any level</option>
                        @foreach(config('skillbridge.proficiency_levels') as $level => $lLabel)
                            <option value="{{ $level }}"
                                @selected(old("min_proficiency.{$skill->id}", $existingProficiency) == $level)>
                                {{ $lLabel }}
                            </option>
                        @endforeach
                    </select>
                </div>
            @endforeach
        </div>
        <x-input-error :messages="$errors->get('skills')" class="mt-1" />
    </div>

</div>

