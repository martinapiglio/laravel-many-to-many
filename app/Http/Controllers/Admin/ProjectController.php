<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Type;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();

        return view('admin.projects.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validation($request);
        
        $formData = $request->all();
        $formData['github_repo'] = $formData['github_repo'] . '-repo';

        $newProject = new Project();
        $newProject->slug = Str::slug($formData['title'], '-');

        $newProject->fill($formData);

        $newProject->save(); 

        return redirect()->route('admin.projects.show', $newProject->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $types = Type::all();

        return view('admin.projects.edit', compact('project', 'types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $this->validation($request);

        $formData = $request->all();

        $project->update($formData);

        return redirect()->route('admin.projects.show', $project->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('admin.projects.index');
    }

    private function validation($request) {

        $formData = $request->all(); 

        $validator = Validator::make($formData, [
            'title' => 'required|min:5|max:50',
            'description' => 'required|max:255',
            'type_id' => 'nullable|exists:types,id',
            'thumbnail' => 'required',
            'languages' => 'required',
            'year' => 'nullable|min:4|max:4|gte:2015|lte:2023',
            'github_repo' => 'required',
        ], [
            'title.required' => 'Title field is mandatory.',
            'title.min' => 'Title field cannot be shorter than 5 characters.',
            'title.max' => 'Title field cannot be longer than 50 characters.',
            'description.required' => 'Description field is mandatory.',
            'description.max' => 'Description field cannot be longer than 255 characters.',
            'type_id.exists' => 'Please select a type chosen among the existing ones',
            'thumb.required' => "Thumbnail path is mandatory.",
            'languages.required' => "Languages field is mandatory.",
            'year.min' => "Year must be 4 digits long",
            'year.max' => "Year must be 4 digits long",
            'year.gte' => "Year must be greater than or equal to 2015",
            'year.lte' => "Year must be less than or equal to the current year",
            'github_repo.required' => "Github repository field is mandatory."

        ])->validate();

        return $validator;
    }
}
