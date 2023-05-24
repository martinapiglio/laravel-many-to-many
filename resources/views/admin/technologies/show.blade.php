
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

        <button id="change-btn" class="btn text-white">
            <a href="{{route('admin.technologies.edit', $technology->slug)}}">Change</a>
        </button>

        {{-- modal --}}
        <button type="button" class="btn bg-danger text-white" data-bs-toggle="modal" data-bs-target="#deleteProject">
            Delete Technology
        </button>

        <div class="modal fade text-dark" id="deleteProject" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Delete</h1>
                    </div>

                    <div class="modal-body">
                        Do you want to delete the selected technology? Please consider that this action is irreversible.
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    
                        <form action="{{route('admin.technologies.destroy', $technology->slug)}}" method="POST">
                            @csrf
                            @method('DELETE')
                    
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </form>

                    </div>

                </div>
            </div>
        </div> 
        {{-- // modal --}}

        <div class="mb-2">
            <a id="back-link" href="{{route('admin.technologies.index')}}">Back to all technologies preview</a>
        </div>

    </div>


@endsection