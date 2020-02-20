@extends('layouts.app')
@section('content')
    <div class="box">
        <h1 class="title">Create a project</h1>
        {!! Form::open(['action' => 'ProjectController@store']) !!}
            <input type="hidden" name="owner_id" value="{{ $userId }}">
            <label class="label">Project title</label>
            <input class="input" type="text" name="title" value="">

            <label class="label">Project description</label>
            <input class="input" type="text" name="description" value="">

            <button type="submit" name="button" class="button">Create a project</button>
        {!! Form::close() !!}
    </div>
@endsection
