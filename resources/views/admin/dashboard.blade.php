@extends('layouts.admin')

@section('content')

    <div id="dashboard-container" class="container p-5">
        
        <h1 class="display-5 fw-bold mb-5">
            Welcome to your projects portfolio, {{ Auth::user()->name }}!
        </h1>

        <p>Here you can choose what to do next:</p>

        <div class="content">

            <div class="mb-2">
                <button class="btn btn-dark">
                    <a href="{{route('admin.projects.index')}}">Show all projects</a>
                </button>
    
                <button class="btn btn-dark">
                    <a href="{{route('admin.projects.create')}}">Add a new project</a>
                </button>
            </div>

            <div>
                <button class="btn btn-dark">
                    <a href="{{route('admin.technologies.index')}}">Show all technologies</a>
                </button>
    
                <button class="btn btn-dark">
                    <a href="{{route('admin.technologies.create')}}">Add a new technology</a>
                </button>
            </div>
            
        </div>

    </div>

@endsection