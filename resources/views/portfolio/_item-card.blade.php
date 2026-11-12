{{-- Portfolio item card. Props: $item (PortfolioItem), $editable (bool, default false) --}}
@php $editable = $editable ?? false; @endphp

<div class="bg-white rounded-lg shadow p-5 flex flex-col gap-3">

    {{-- Type badge + title --}}
    <div class="flex items-start justify-between gap-2">
        <span class="text-xs font-medium px-2 py-0.5 rounded-full
            {{ $item->type === 'certificate' ? 'bg-yellow-50 text-yellow-700' : ($item->type === 'link' ? 'bg-blue-50 text-blue-700' : 'bg-green-50 text-green-700') }}">
            {{ $portfolioTypes[$item->type] ?? ucfirst($item->type) }}
        </span>
        @if($editable)
            <a href="{{ route('portfolio.edit', $item) }}"
               class="text-xs text-gray-400 hover:text-indigo-600 shrink-0">Edit</a>
        @endif
    </div>

    <h4 class="font-semibold text-gray-800 text-sm leading-snug">{{ $item->title }}</h4>

    @if($item->description)
        <p class="text-xs text-gray-500 line-clamp-3">{{ $item->description }}</p>
    @endif

    {{-- Links / file --}}
    <div class="flex gap-3 mt-auto flex-wrap">
        @if($item->url)
            <a href="{{ $item->url }}" target="_blank"
               class="text-xs text-indigo-600 hover:underline">🔗 Visit link</a>
        @endif
        @if($item->file_path)
            <a href="{{ Storage::url($item->file_path) }}" target="_blank"
               class="text-xs text-indigo-600 hover:underline">📄 View file</a>
        @endif
    </div>
</div>

