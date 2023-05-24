
@extends('layouts/admin')

@section('content')

    <div class="container p-5">
        
        <h3 class="display-5 fw-bold mb-5">
            Technology: {{$technology->name}}
        </h3>

        @if(count($technology->projects) > 0)

        <table class="table table-striped">

            <thead class="text-white bg-secondary">
                <th>Title</th>
                <th>Type</th>
                <th>Year</th>
                <th>Repository name</th>
                <th>Details</th>
            </thead>

            <tbody>
                @foreach($technology->projects as $project)
                    <tr>
                        <td>{{$project->title}}</td>
                        <td>{{$project->type?->title}}</td>
                        <td>{{$project->year}}</td>
                        <td>{{$project->github_repo}}</td>
                        <td>
                        <a href="{{route('admin.projects.show', $project->slug)}}">click here</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>

        @else  

        No projects

        @endif

    </div>

@endsection