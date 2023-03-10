<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Faker\Generator as Faker;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = $request->query('filter');

        $query = Project::orderBy('id');

        if ($filter) {
            $value = $filter === 'draft' ? 0 : 1;
            $query->where('is_published', $value);
        }

        //get projects from db
        $projects = $query->paginate(10);

        //return projects index with projects
        return view('admin.projects.index', compact('projects', 'filter'));
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
        // ! validation
        $request->validate(
            [
                'title' => 'required|string|unique:projects|max:40',
                'description' => 'required|string',
                'image' => 'nullable|image|mimes:png,jpeg,jpg',
                'repo_link' => 'nullable|url'
            ],
            [
                'title.required' => 'A title must be given',
                'title.string' => 'The title must be a text',
                'title.unique' => 'This title is already taken',
                'title.max' => 'Max length exceeded',
                'description.required' => 'A description must be given',
                'description.string' => 'The description must be a text',
                'image.image' => 'Please, give an image file',
                'image.mimes' => 'Only jpeg, jpg and png file supported',
                'repo_link.url' => 'Please, give a valid URL'
            ]
        );

        // retrieve the input values
        $data = $request->all();

        // create a new project
        $project = new Project();

        // check if an image is given
        if (Arr::exists($data, 'image')) {
            // define a variable where the file is saved in a path storage/app/public/{} that return a correct URL
            $img_url = Storage::put('projects', $data['image']);
            // change the file given with the correct url
            $data['image'] = $img_url;
        }

        // fill new project with data from form
        $project->fill($data);

        // define publish or not
        $project->is_published = Arr::exists($data, 'is_published');

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
        // ! validation
        $request->validate(
            [
                'title' => ['required', 'string', Rule::unique('projects')->ignore($project->id), 'max:40'],
                'description' => 'required|string',
                'image' => 'nullable|image|mimes:png,jpeg,jpg',
                'repo_link' => 'nullable|url'
            ],
            [
                'title.required' => 'A title must be given',
                'title.string' => 'The title must be a text',
                'title.unique' => 'This title is already taken',
                'title.max' => 'Max length exceeded',
                'description.required' => 'A description must be given',
                'description.string' => 'The description must be a text',
                'image.image' => 'Please, give an image file',
                'image.mimes' => 'Only jpeg, jpg and png file supported',
                'repo_link.url' => 'Please, give a valid URL'
            ]
        );

        $data = $request->all();

        // check if an image is given
        if (Arr::exists($data, 'image')) {
            // if exists an image, delete it to make space for the newest
            if ($project->image) Storage::delete($project->image);
            // define a variable where the file is saved in a path storage/app/public/{} that return a correct URL
            $img_url = Storage::put('projects', $data['image']);
            // change the file given with the correct url
            $data['image'] = $img_url;
        }

        // define publish or not
        $data['is_published'] = Arr::exists($data, 'is_published');

        $project->update($data);

        return to_route('admin.projects.show', $project->id)->with('message', "$project->title updated succesfully.")->with('type', 'warning');;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        // if exists an image, delete it to make space for the newest
        if ($project->image) Storage::delete($project->image);

        $project->delete();

        return to_route('admin.projects.index')->with('message', "$project->title deleted succesfully.")->with('type', 'danger');;
    }
}
