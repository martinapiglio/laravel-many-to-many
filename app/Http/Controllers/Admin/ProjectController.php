<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $technologies = Technology::all();

        return view('admin.projects.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $formData = $request->all();

        $this->validation($request);
        
        $formData['github_repo'] = $formData['github_repo'] . '-repo';

        $newProject = new Project();

        if($request->hasFile('thumbnail')){

            $path = Storage::put('project_img', $request->thumbnail);

            $formData['thumbnail'] = $path;
        };
        
        $newProject->fill($formData);
        $newProject->slug = Str::slug($formData['title'], '-');

        $newProject->save(); 

        if(array_key_exists('technologies', $formData)){
            $newProject->technologies()->attach($formData['technologies']);
        }

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

        $technologies = Technology::all();

        return view('admin.projects.edit', compact('project', 'types', 'technologies'));
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
        $formData = $request->all();

        $this->validation($request);

        if($request->hasFile('thumbnail')) {

            if($project->thumbnail) {
                Storage::delete($project->thumbnail);
            }

            $path = Storage::put('project_img', $request->thumbnail);

            $formData['thumbnail'] = $path;

        }

        $project->update($formData);

        if(array_key_exists('technologies', $formData)){
            $project->technologies()->sync($formData['technologies']);
        } else {
            $project->technologies()->detach();
        }

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
        if($project->thumbnail) {
            Storage::delete($project->thumbnail);
        }

        $project->delete();

        return redirect()->route('admin.projects.index');
    }

    private function validation($request) {

        $formData = $request->all(); 

        $validator = Validator::make($formData, [
            'title' => 'required|min:5|max:50',
            'description' => 'required|max:255',
            'type_id' => 'nullable|exists:types,id',
            'technologies' => 'exists:technologies,id',
            'thumbnail' => 'nullable|image|max:4096',
            'year' => 'nullable|min:4|max:4|gte:2015|lte:2023',
            'github_repo' => 'required',
        ], [
            'title.required' => 'Title field is mandatory.',
            'title.min' => 'Title field cannot be shorter than 5 characters.',
            'title.max' => 'Title field cannot be longer than 50 characters.',
            'description.required' => 'Description field is mandatory.',
            'description.max' => 'Description field cannot be longer than 255 characters.',
            'technologies.exists' => 'Please select a technology chosen among the existing ones',
            'type_id.exists' => 'Please select a type chosen among the existing ones',
            'thumb.required' => "Thumbnail must be an image file.",
            'thumb.max' => "Image size exceeding 4MB, please try again.",
            'year.min' => "Year must be 4 digits long",
            'year.max' => "Year must be 4 digits long",
            'year.gte' => "Year must be greater than or equal to 2015",
            'year.lte' => "Year must be less than or equal to the current year",
            'github_repo.required' => "Github repository field is mandatory."

        ])->validate();

        return $validator;
    }
}
