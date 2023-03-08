@if ($project->exists)
  <form action="{{ route('admin.projects.update', $project->id) }}" method="post">
    {{-- * method helper --}}
    @method('PUT')
  @else
    <form action="{{ route('admin.projects.store') }}" method="post">
@endif
{{-- ! cross-site request forgery --}}
@csrf

<div class="row">
  {{-- title --}}
  <div class="col-4">
    <div class="mb-3">
      <label for="title" class="form-label">Title</label>
      <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
        value="{{ $project->title }}" required maxlength="40">
      @error('title')
        <div class="invalid-feedback">{{ $message }}</div>
      @else
        <div class="form-text">Add a project title</div>
      @enderror
    </div>
  </div>

  {{-- repo_link --}}
  <div class="col-4">
    <div class="mb-3">
      <label for="repo_link" class="form-label">Repository link</label>
      <input type="url" class="form-control @error('repo_link') is-invalid @enderror" id="repo_link"
        name="repo_link" value="{{ $project->repo_link }}">
      @error('repo_link')
        <div class="invalid-feedback">{{ $message }}</div>
      @else
        <div class="form-text">Link to the project repository</div>
      @enderror
    </div>
  </div>

  {{-- image --}}
  <div class="col-4">
    <div class="mb-3">
      <label for="image" class="form-label">Image</label>
      <input type="url" class="form-control @error('image') is-invalid @enderror" id="image" name="image"
        value="{{ $project->image }}">
      @error('image')
        <div class="invalid-feedback">{{ $message }}</div>
      @else
        <div class="form-text">Insert a project image</div>
      @enderror
    </div>
  </div>

  {{-- description --}}
  <div class="col">
    <div class="mb-3">
      <label for="description" class="form-label">Description</label>
      <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description"
        rows="10" required>{{ $project->description }}</textarea>
    </div>
  </div>
</div>

<hr>

{{-- form buttons --}}
<div class="text-end me-2">
  <button class="btn btn-sm btn-success">Save</button>
  <a class="btn btn-sm btn-secondary" href="{{ route('admin.projects.index') }}">Go back</a>
</div>
</form>