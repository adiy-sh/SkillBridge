<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Project</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6">

                @if($errors->any())
                    <div class="mb-4 p-3 bg-red-50 text-red-700 rounded">
                        <ul class="list-disc list-inside text-sm">
                            @foreach($errors->all() as $e) <li>{{ $e }}</li> @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('projects.update', $project) }}">
                    @csrf @method('PATCH')
                    @include('projects._form', ['project' => $project])

                    <div class="mt-6 flex gap-3">
                        <x-primary-button>Save Changes</x-primary-button>
                        <a href="{{ route('projects.show', $project) }}"
                           class="px-4 py-2 text-sm text-gray-600 hover:underline">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

