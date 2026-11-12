{{-- Shared form fields for portfolio create/edit. Requires x-data="{ type: '...' }" on the parent form. --}}

<div class="space-y-5">

    {{-- Title --}}
    <div>
        <x-input-label for="title" value="Title *" />
        <x-text-input id="title" name="title" class="mt-1 block w-full"
                      :value="old('title', $item?->title)" required />
        <x-input-error :messages="$errors->get('title')" class="mt-1" />
    </div>

    {{-- Type --}}
    <div>
        <x-input-label for="type" value="Type *" />
        <select id="type" name="type" x-model="type"
                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
            @foreach($types as $key => $label)
                <option value="{{ $key }}" @selected(old('type', $item?->type ?? 'project') === $key)>{{ $label }}</option>
            @endforeach
        </select>
        <x-input-error :messages="$errors->get('type')" class="mt-1" />
    </div>

    {{-- Description --}}
    <div>
        <x-input-label for="description" value="Description" />
        <textarea id="description" name="description" rows="3"
                  class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('description', $item?->description) }}</textarea>
        <x-input-error :messages="$errors->get('description')" class="mt-1" />
    </div>

    {{-- URL (shown for link type, hidden for certificate/project if file preferred) --}}
    <div>
        <x-input-label for="url" value="URL / Link" />
        <x-text-input id="url" name="url" type="url" class="mt-1 block w-full"
                      :value="old('url', $item?->url)" placeholder="https://..." />
        <x-input-error :messages="$errors->get('url')" class="mt-1" />
    </div>

    {{-- File upload (project samples & certificates) --}}
    <div x-show="type !== 'link'">
        <x-input-label for="file" value="Upload File (PDF, JPG, PNG — max 5 MB)" />
        <input id="file" name="file" type="file" accept=".pdf,.jpg,.jpeg,.png"
               class="mt-1 block w-full text-sm text-gray-600
                      file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0
                      file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700
                      hover:file:bg-indigo-100">
        @if($item?->file_path)
            <p class="mt-1 text-xs text-gray-500">
                Current file:
                <a href="{{ Storage::url($item->file_path) }}" target="_blank"
                   class="text-indigo-600 hover:underline">view</a>
                (upload a new file to replace it)
            </p>
        @endif
        <x-input-error :messages="$errors->get('file')" class="mt-1" />
    </div>

    {{-- Sort order --}}
    <div>
        <x-input-label for="sort_order" value="Display order" />
        <x-text-input id="sort_order" name="sort_order" type="number" min="0"
                      class="mt-1 block w-32"
                      :value="old('sort_order', $item?->sort_order ?? 0)" />
        <x-input-error :messages="$errors->get('sort_order')" class="mt-1" />
    </div>

</div>

@once
    @push('scripts')
        {{-- Alpine already loaded via app.js --}}
    @endpush
@endonce

