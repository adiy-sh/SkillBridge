<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Add Portfolio Item</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6">

                @if($errors->any())
                    <div class="mb-4 p-3 bg-red-50 text-red-700 rounded text-sm">
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $e) <li>{{ $e }}</li> @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('portfolio.store') }}" enctype="multipart/form-data"
                      x-data="{ type: '{{ old('type', 'project') }}' }">
                    @csrf
                    @include('portfolio._form', ['item' => null])

                    <div class="mt-6 flex gap-3">
                        <x-primary-button>Add Item</x-primary-button>
                        <a href="{{ route('portfolio.index') }}" class="px-4 py-2 text-sm text-gray-600 hover:underline">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

