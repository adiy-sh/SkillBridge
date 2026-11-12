<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">My Portfolio</h2>
            <a href="{{ route('portfolio.create') }}"
               class="px-4 py-2 bg-indigo-600 text-white text-sm rounded-md hover:bg-indigo-700">
                + Add Item
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
            @endif

            {{-- Storage link reminder --}}
            @if(! file_exists(public_path('storage')))
                <div class="mb-4 p-3 bg-yellow-50 border border-yellow-200 text-yellow-800 rounded text-sm">
                    ⚠️ Run <code class="font-mono bg-yellow-100 px-1 rounded">php artisan storage:link</code>
                    to enable file uploads to be served publicly.
                </div>
            @endif

            @if($items->isEmpty())
                <div class="bg-white rounded-lg shadow p-8 text-center text-gray-500">
                    No portfolio items yet. Add your first one!
                </div>
            @else
                <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach($items as $item)
                        @include('portfolio._item-card', ['item' => $item, 'editable' => true])
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>

