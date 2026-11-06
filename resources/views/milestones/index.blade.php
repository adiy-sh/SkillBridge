<h1>{{ $project->title }}: Milestones</h1>

@if (session('success')) <p>{{ session('success') }}</p> @endif

<a href="{{ route('projects.milestones.create', $project) }}">Add milestone</a>

<table border="1" cellpadding="6">
    <tr><th>Title</th><th>Due</th><th>Status</th><th>Depends on</th><th></th></tr>
    @forelse ($milestones as $m)
        <tr>
            <td>{{ $m->title }}</td>
            <td>{{ $m->due_date->format('Y-m-d') }}</td>
            <td>{{ $m->status }}</td>
            <td>{{ $m->dependencies->pluck('title')->join(', ') ?: '-' }}</td>
            <td>
                <a href="{{ route('projects.milestones.edit', [$project, $m]) }}">Edit</a>
                <form method="POST" action="{{ route('projects.milestones.destroy', [$project, $m]) }}" style="display:inline">
                    @csrf @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
    @empty
        <tr><td colspan="5">No milestones yet.</td></tr>
    @endforelse
</table>