<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $user->name }}'s Profile
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if(session('success'))
                <div class="p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
            @endif

            {{-- ── Profile header ───────────────────────────────────────────── --}}
            <div class="bg-white shadow rounded-lg p-6">
                <h2 class="text-2xl font-bold text-gray-800">{{ $user->name }}</h2>
                @if($user->freelancerProfile?->headline)
                    <p class="text-indigo-600 mt-1">{{ $user->freelancerProfile->headline }}</p>
                @endif
                <div class="mt-3 flex gap-4 text-sm text-gray-500 flex-wrap">
                    @if($user->freelancerProfile?->hourly_rate)
                        <span>💰 ৳{{ number_format($user->freelancerProfile->hourly_rate, 0) }}/hr</span>
                    @endif
                    @if($user->freelancerProfile?->availability)
                        <span>🕐 {{ config('skillbridge.availability_options')[$user->freelancerProfile->availability] ?? $user->freelancerProfile->availability }}</span>
                    @endif
                </div>
                @if($user->freelancerProfile?->bio)
                    <p class="mt-4 text-gray-700 whitespace-pre-line">{{ $user->freelancerProfile->bio }}</p>
                @endif

                @if(!$isOwnProfile && $viewer)
                    <div class="mt-4">
                        <a href="{{ route('portfolio.index') }}" class="text-sm text-indigo-600 hover:underline">
                            View their portfolio ↓
                        </a>
                    </div>
                @endif
            </div>

            {{-- ── Skills + endorsements ────────────────────────────────────── --}}
            @if($user->userSkills->isNotEmpty())
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="font-semibold text-gray-700 mb-4">Skills</h3>

                <div class="space-y-3">
                    @foreach($user->userSkills as $userSkill)
                        <div class="flex items-center justify-between gap-3 p-3 bg-gray-50 rounded-lg">
                            <div>
                                <span class="font-medium text-gray-800">{{ $userSkill->skill->name }}</span>
                                <span class="ml-2 text-xs text-gray-500">
                                    {{ $proficiencyOpts[$userSkill->proficiency] ?? $userSkill->proficiency }}
                                </span>
                                <span class="ml-3 text-xs text-indigo-600 font-medium">
                                    {{ $userSkill->endorsements->count() }} endorsement(s)
                                </span>
                            </div>

                            {{-- Endorsement actions (not shown to profile owner) --}}
                            @if($viewer && !$isOwnProfile)
                                @if(isset($myEndorsements[$userSkill->id]))
                                    {{-- Already endorsed — show remove button --}}
                                    <form method="POST"
                                          action="{{ route('endorsements.destroy', $myEndorsements[$userSkill->id]) }}">
                                        @csrf @method('DELETE')
                                        <button class="text-xs text-red-500 hover:underline">
                                            Remove endorsement
                                        </button>
                                    </form>
                                @else
                                    {{-- Not yet endorsed --}}
                                    <form method="POST" action="{{ route('endorsements.store') }}">
                                        @csrf
                                        <input type="hidden" name="user_skill_id" value="{{ $userSkill->id }}">
                                        <button class="text-xs bg-indigo-600 text-white px-3 py-1 rounded-md hover:bg-indigo-700">
                                            Endorse
                                        </button>
                                    </form>
                                @endif
                            @endif
                        </div>

                        {{-- Endorsers list --}}
                        @if($userSkill->endorsements->isNotEmpty())
                            <div class="ml-3 text-xs text-gray-400">
                                Endorsed by:
                                @foreach($userSkill->endorsements as $e)
                                    <span>{{ $e->endorser->name }}</span>@unless($loop->last), @endunless
                                @endforeach
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
            @endif

            {{-- ── Portfolio items ──────────────────────────────────────────── --}}
            @if($user->freelancerProfile && $user->freelancerProfile->portfolioItems->isNotEmpty())
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="font-semibold text-gray-700 mb-4">Portfolio</h3>
                <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach($user->freelancerProfile->portfolioItems as $item)
                        @include('portfolio._item-card', [
                            'item'           => $item,
                            'editable'       => false,
                            'portfolioTypes' => $portfolioTypes,
                        ])
                    @endforeach
                </div>
            </div>
            @endif

        </div>
    </div>
</x-app-layout>

