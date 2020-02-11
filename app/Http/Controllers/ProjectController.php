<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Http\Requests\ProjectRequest;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all();

        return view('projects.index', compact('projects'));
    }

    public function store(ProjectRequest $projectRequest)
    {
        $attributes['owner_id'] = $auth->id;
        $project = Project::create(request()->all());

        return back();
    }

    public function show(Project $project)
    {
        $project = Project::findOrFail($project);

        return view('projects.show', compact('project'));
    }
}
