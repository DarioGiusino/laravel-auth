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
    <div class="text-end">
      <a class="btn btn-small btn-secondary" href="{{ route('admin.projects.index') }}">Go back</a>
    </div>
  </section>
@endsection
