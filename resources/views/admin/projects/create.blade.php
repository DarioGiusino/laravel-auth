@extends('layouts.app')

@section('content')
  <section id="project-create" class="container">
    {{-- page title --}}
    <header>
      <h3 class="text-center my-4">Add a new project</h3>
    </header>

    {{-- # create form --}}
    <form action="{{ route('admin.project.store') }}" method="post">

      {{-- ! cross-site request forgery --}}
      @csrf

      <div class="row">
        {{-- title --}}
        <div class="col-4">
          <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title">
            <div class="form-text">Add a project title</div>
          </div>
        </div>

        {{-- repo_link --}}
        <div class="col-4">
          <div class="mb-3">
            <label for="repo_link" class="form-label">Repository link</label>
            <input type="text" class="form-control" id="repo_link" name="repo_link">
            <div class="form-text">Link to the project repository</div>
          </div>
        </div>

        {{-- image --}}
        <div class="col-4">
          <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="text" class="form-control" id="image" name="image">
            <div class="form-text">Insert a project image</div>
          </div>
        </div>

        {{-- description --}}
        <div class="col">
          <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" name="description" id="description" rows="10"></textarea>
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
  </section>
@endsection
