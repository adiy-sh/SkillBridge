<h1>{{ $milestone->exists ? 'Edit' : 'New' }} milestone</h1>

@if ($errors->any())
    <ul>@foreach ($errors->all() as $e) <li>{{ $e }}</li> @endforeach</ul>
@endif

<form method="POST" action="{{ $milestone->exists
    ? route('projects.milestones.update', [$project, $milestone])
    : route('projects.milestones.store', $project) }}">
    @csrf
    @if ($milestone->exists) @method('PUT') @endif

    <p>Title<br><input name="title" value="{{ old('title', $milestone->title) }}"></p>
    <p>Description<br><textarea name="description">{{ old('description', $milestone->description) }}</textarea></p>
    <p>Acceptance criteria<br><textarea name="acceptance_criteria">{{ old('acceptance_criteria', $milestone->acceptance_criteria) }}</textarea></p>
    <p>Amount<br><input name="amount" value="{{ old('amount', $milestone->amount) }}"></p>
    <p>Due date<br><input type="date" name="due_date" value="{{ old('due_date', optional($milestone->due_date)->format('Y-m-d')) }}"></p>
    <p>Status<br>
        <select name="status">
            @foreach (\App\Models\Milestone::STATUSES as $s)
                <option value="{{ $s }}" @selected(old('status', $milestone->status ?: 'pending') === $s)>{{ $s }}</option>
            @endforeach
        </select>
    </p>
    <p>Depends on<br>
        <select name="dependencies[]" multiple>
            @foreach ($others as $o)
                <option value="{{ $o->id }}" @selected(in_array($o->id, old('dependencies', $milestone->exists ? $milestone->dependencies->pluck('id')->all() : [])))>{{ $o->title }}</option>
            @endforeach
        </select>
    </p>
    <button type="submit">Save</button>
</form>