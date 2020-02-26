@extends('layouts.app')
@section('content')
    <div class="columns is-multiline">

        <div class="column is-three-quarters">
            <nav class="breadcrumb" aria-label="breadcrumbs">
                <ul>
                    <li><a href="/projects">Projects</a></li>
                    <li>{{ $project->title }}</li>
                </ul>
            </nav>
            <h2 class="title">My project</h1>

            <h2 class="title">Tasks</h1>

            @forelse ($project->tasks as $task)
                <div class="box project-update">
                    {!! Form::open(['method' => 'PUT', 'action' => ['ProjectTaskController@update', $project->id, $task->id]]) !!}
                        <input name="body" value="{{ $task->body }}">
                        <input type="checkbox" name="completed" onChange="this.form.submit()" {{ $task->completed ? 'checked' : '' }}>
                    {!! Form::close() !!}
                </div>
            @empty
                <div class="box">
                    Begin by adding a task
                </div>
            @endforelse

            {!! Form::open(['action' => ['ProjectTaskController@store', $project->id]]) !!}
                <input placeholder="add a new task" name="body" value="">
            {!! Form::close() !!}

            <div class="generalNotes">
                <h2 class="title">General notes</h1>
                <div class="box">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                </div>
            </div>
        </div>


        <div class="column">
            <div class="box">
                <p class="title">{{ $project->title }}</p>
            </div>
        </div>
    </div>
@endsection
