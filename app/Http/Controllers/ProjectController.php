<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Http\Requests\ProjectRequest;
use App\Http\Requests\ProjectUpdateRequest;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = auth()->user()->projects;

        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        $userId = auth()->user()->id;

        return view('projects.create', compact('userId'));
    }

    public function store(ProjectRequest $projectRequest)
    {
        $project = Project::create($projectRequest->all());

        return redirect('/projects');
    }

    public function show(Project $project)
    {
        $project = Project::find($project->id);

        return view('projects.show', compact('project'));
    }

    public function update(Project $project, ProjectUpdateRequest $projectUpdateRequest)
    {
        $project->owner->can('update', $project);

        $project->update($projectUpdateRequest->all());
        return redirect($project->path());
    }
}
