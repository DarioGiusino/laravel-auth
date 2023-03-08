@extends('layouts.app')

@section('content')
  <section id="project-detail" class="container">
    {{-- project title --}}
    <header>
      <h2 class="text-center my-4">{{ $project->title }}</h2>
    </header>
    <div class="row row-cols-2">
      <div class="col d-flex justify-content-center align-items-center">
        <img src="{{ $project->image }}" alt="{{ $project->title }}">
      </div>
      <div class="col p-3">{{ $project->description }}</div>
    </div>
    <hr>
    <div class="d-flex align-items-center justify-content-between">
      <form action="{{ route('admin.projects.destroy', $project->id) }}" method="post">
        @csrf @method('delete')
        <button class="btn btn-sm btn-danger">Delete</button>
      </form>
      <div>
        <a class="btn btn-sm btn-warning" href="{{ route('admin.projects.edit', $project->id) }}">Edit</a>
        <a class="btn btn-sm btn-secondary" href="{{ route('admin.projects.index') }}">Go back</a>
      </div>
    </div>
  </section>
@endsection
