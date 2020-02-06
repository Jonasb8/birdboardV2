<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    public function store()
    {
        $project = Project::create(request()->all());
    }
}
