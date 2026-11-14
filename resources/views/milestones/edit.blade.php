<x-app-layout>
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <div class="mb-6">
                    <h2 class="text-2xl font-bold text-gray-900">{{ $project->title }}: Edit Milestone</h2>
                    <p class="text-sm text-gray-500 mt-1">Update milestone details, status, or dependencies.</p>
                </div>

                @if ($errors->any())
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded text-sm">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('projects.milestones.update', [$project, $milestone]) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')
                    
                    @include('milestones.form')

                    <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200">
                        <a href="{{ route('projects.milestones.index', $project) }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300 text-sm font-medium">
                            Cancel
                        </a>
                        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 text-sm font-medium">
                            Update Milestone
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>