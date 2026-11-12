<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Browse Open Projects
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col lg:flex-row gap-6">

            {{-- ── Filters sidebar ──────────────────────────────────────────── --}}
            <aside class="w-full lg:w-64 shrink-0">
                @include('projects._filters')
            </aside>

            {{-- ── Project cards ────────────────────────────────────────────── --}}
            <main class="flex-1">
                @if(session('success'))
                    <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
                @endif

                @if($projects->isEmpty())
                    <div class="bg-white rounded-lg shadow p-8 text-center text-gray-500">
                        No open projects match your filters.
                    </div>
                @else
                    <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-3">
                        @foreach($projects as $project)
                            @include('projects._project-card', ['project' => $project])
                        @endforeach
                    </div>

                    <div class="mt-6">
                        {{ $projects->links() }}
                    </div>
                @endif
            </main>

        </div>
    </div>
</x-app-layout>

