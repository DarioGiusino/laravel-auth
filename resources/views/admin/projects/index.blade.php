@extends('layouts.app')

@section('content')
  <section id="projects-list" class="container">
    {{-- page title --}}
    <header>
      <h3 class="text-center my-4">Projects List</h3>
    </header>

    {{-- projects table --}}
    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Title</th>
          <th scope="col" class="text-end">Commands</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($projects as $project)
          <tr>
            <th scope="row">{{ $project->id }}</th>
            <td>{{ $project->title }}</td>
            <td class="text-end">
              <a class="btn btn-sm btn-primary" href="{{ route('admin.projects.show', $project->id) }}">Open</a>
              <a class="btn btn-sm btn-warning" href="{{ route('admin.projects.edit', $project->id) }}">Edit</a>
              <a class="btn btn-sm btn-danger" href="{{ route('admin.projects.destroy', $project->id) }}">Delete</a>
            </td>
          </tr>
        @empty
          <h1 class="text-center">Projects list is empty</h1>
        @endforelse
      </tbody>
    </table>
    <hr>
    <div class="text-end">
      <a class="btn btn-sm btn-success me-2" href="{{ route('admin.projects.create') }}">Add</a>
    </div>
  </section>
@endsection
