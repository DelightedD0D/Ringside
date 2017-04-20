{{ csrf_field() }}

<div class="form-group @if ($errors->has('name')) {{ 'has-error' }} @endif">
    <label class="control-label" for="name">Name</label>
    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') ?? $title->name }}"/>
    @if ($errors->has('name')) <small class="help-block">{{ $errors->first('name') }}</small> @endif
</div>

<div class="form-group @if ($errors->has('slug')) {{ 'has-error' }} @endif">
    <label class="control-label" for="slug">Slug</label>
    <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug') ?? $title->slug }}"/>
    @if ($errors->has('slug')) <small class="help-block">{{ $errors->first('slug') }}</small> @endif
</div>

<div class="form-group @if ($errors->has('introduced_at')) {{ 'has-error' }} @endif">
    <label class="control-label" for="introduced_at">Date Introduced</label>
    <input type="date" class="form-control" id="introduced_at" name="introduced_at" value="{{ old('introduced_at') ?? $title->introduced_at }}"/>
    @if ($errors->has('introduced_at')) <small class="help-block">{{ $errors->first('introduced_at') }}</small> @endif
</div>

<div class="form-group">
    <button type="submit" class="btn btn-primary">
        {{ $submitButtonText ?? 'Create Title' }}
    </button>
</div>
