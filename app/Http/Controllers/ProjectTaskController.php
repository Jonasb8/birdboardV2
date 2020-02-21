<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Project;

class ProjectTaskController extends Controller
{
    public function store(Project $project)
    {
        $project->addTask(request()->all());

        return redirect('/projects');
    }
}
