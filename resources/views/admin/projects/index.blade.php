
@extends('layouts/admin')

@section('content')

    <div class="container p-5">
        
        <h3 class="display-5 fw-bold mb-5">
            All projects
        </h3>

        <table id="project-table" class="table table-striped">

            <thead class="text-white">
                <th>Title</th>
                <th>Technologies</th>
                <th>Type</th>
                <th>Year</th>
                <th>Repository name</th>
                <th>Details</th>
            </thead>
          
            <tbody>
          
              @foreach($projects as $project)
                <tr>
                    <td>{{$project->title}}</td>
                    <td>
                        @php

                            $technologiesNames = [];

                            foreach($project->technologies as $technology){
                                $technologiesNames[] = $technology->name;
                            }
                            
                            echo implode(', ', $technologiesNames);

                        @endphp
                    </td>
                    <td>{{$project->type?->title}}</td>
                    <td>{{$project->year}}</td>
                    <td>{{$project->github_repo}}</td>
                    <td><a href="{{route('admin.projects.show', $project->slug)}}">click here</a></td>
                </tr>
              @endforeach
          
            </tbody>

        </table>

        <button class="btn btn-dark">
            <a href="{{route('admin.projects.create')}}">Add a new project</a>
        </button>

    </div>

@endsection