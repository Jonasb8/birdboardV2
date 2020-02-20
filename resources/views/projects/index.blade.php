@extends('layouts.app')
@section('content')
    <div class="columns is-multiline">
        @foreach ($projects as $project)
        <div class="column is-one-third">

            <div class="card">
                <header class="card-header">
                <p class="card-header-title">
                    <a href="{{ $project->path() }}">
                        {{ $project->title }}
                    </a>
                </p>
                </header>
                <div class="card-content">
                    <div class="content">
                        {{ $project->description }}
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endsection
