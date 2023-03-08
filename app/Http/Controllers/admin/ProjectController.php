<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Faker\Generator as Faker;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //get projects from db
        $projects = Project::all();

        //return projects index with projects
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $project = new Project;
        return view('admin.projects.create', compact('project'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Faker $faker)
    {
        // retrieve the input values
        $data = $request->all();

        // TODO remove (adding a random image)
        $data['image'] = $faker->imageUrl(200, 200);

        // create a new project
        $project = new Project();

        // fill new project with data from form
        $project->fill($data);

        // save new project on db
        $project->save();

        // redirect to its detail
        return to_route('admin.projects.show', $project->id)->with('message', "$project->title created succesfully.")->with('type', 'success');;
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $data = $request->all();

        $project->update($data);

        return to_route('admin.projects.show', $project->id)->with('message', "$project->title updated succesfully.")->with('type', 'warning');;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return to_route('admin.projects.index')->with('message', "$project->title deleted succesfully.")->with('type', 'danger');;
    }
}
