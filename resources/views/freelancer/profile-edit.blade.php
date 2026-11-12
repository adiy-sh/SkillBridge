<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">My Freelancer Profile</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if(session('success'))
                <div class="p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
            @endif

            {{-- ── Profile fields ───────────────────────────────────────────── --}}
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="font-semibold text-gray-700 mb-4">Profile Information</h3>

                @if($errors->has('headline') || $errors->has('bio') || $errors->has('hourly_rate') || $errors->has('availability'))
                    <div class="mb-4 p-3 bg-red-50 text-red-700 rounded text-sm">
                        <ul class="list-disc list-inside">
                            @foreach($errors->only(['headline','bio','hourly_rate','availability']) as $e) <li>{{ $e }}</li> @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('freelancer.profile.update') }}">
                    @csrf @method('PATCH')

                    <div class="space-y-4">
                        <div>
                            <x-input-label for="headline" value="Professional Headline" />
                            <x-text-input id="headline" name="headline" class="mt-1 block w-full"
                                          :value="old('headline', $profile->headline)"
                                          placeholder="e.g. Full-Stack Laravel Developer" />
                        </div>
                        <div>
                            <x-input-label for="bio" value="Bio" />
                            <textarea id="bio" name="bio" rows="4"
                                      class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                      placeholder="Tell clients about yourself...">{{ old('bio', $profile->bio) }}</textarea>
                        </div>
                        <div class="grid sm:grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="hourly_rate" value="Hourly Rate (Taka)" />
                                <x-text-input id="hourly_rate" name="hourly_rate" type="number" min="0" step="0.01"
                                              class="mt-1 block w-full"
                                              :value="old('hourly_rate', $profile->hourly_rate)" />
                            </div>
                            <div>
                                <x-input-label for="availability" value="Availability" />
                                <select id="availability" name="availability"
                                        class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="">— Select —</option>
                                    @foreach($availabilityOpts as $key => $label)
                                        <option value="{{ $key }}" @selected(old('availability', $profile->availability) === $key)>{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="mt-5">
                        <x-primary-button>Save Profile</x-primary-button>
                    </div>
                </form>
            </div>

            {{-- ── Skills ───────────────────────────────────────────────────── --}}
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="font-semibold text-gray-700 mb-4">My Skills</h3>

                {{-- Existing skills --}}
                @if($userSkills->isNotEmpty())
                    <div class="space-y-2 mb-5">
                        @foreach($userSkills as $userSkill)
                            <div class="flex items-center justify-between gap-3 p-2 bg-gray-50 rounded">
                                <div class="flex items-center gap-2">
                                    <span class="font-medium text-sm text-gray-800">{{ $userSkill->skill->name }}</span>
                                    <span class="text-xs text-gray-500">
                                        — {{ $proficiencyOpts[$userSkill->proficiency] ?? $userSkill->proficiency }}
                                    </span>
                                </div>
                                <form method="POST" action="{{ route('freelancer.skills.remove', $userSkill) }}">
                                    @csrf @method('DELETE')
                                    <button class="text-xs text-red-500 hover:underline">Remove</button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-sm text-gray-500 mb-4">No skills added yet.</p>
                @endif

                {{-- Add / update skill form --}}
                <form method="POST" action="{{ route('freelancer.skills.add') }}" class="flex gap-3 flex-wrap">
                    @csrf

                    @if($errors->has('skill_id') || $errors->has('proficiency'))
                        <div class="w-full p-2 bg-red-50 text-red-700 rounded text-sm">
                            @foreach($errors->only(['skill_id','proficiency']) as $e) {{ $e }} @endforeach
                        </div>
                    @endif

                    <div class="flex-1 min-w-40">
                        <select name="skill_id"
                                class="block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-sm">
                            <option value="">— Choose skill —</option>
                            @foreach($skills as $skill)
                                <option value="{{ $skill->id }}" @selected(old('skill_id') == $skill->id)>{{ $skill->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="min-w-36">
                        <select name="proficiency"
                                class="block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-sm">
                            @foreach($proficiencyOpts as $val => $label)
                                <option value="{{ $val }}" @selected(old('proficiency', 3) == $val)>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>

                    <x-primary-button type="submit">Add / Update Skill</x-primary-button>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>

