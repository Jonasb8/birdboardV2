<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TaskRequest;
use App\Models\Task;
use App\Models\Project;

class ProjectTaskController extends Controller
{
    public function store(Project $project, TaskRequest $taskRequest)
    {
        if ($project->owner->id === auth()->user()->id) {
            $project->addTask($taskRequest->all());
            return redirect($project->path());
        } else {
            abort(403);
        }
    }
}