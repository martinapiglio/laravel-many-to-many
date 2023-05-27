@extends('layouts/admin')

@section('content')

    <div class="container p-5">

        <h3 class="display-5 fw-bold mb-5">
            All '{{$type->title}}' projects
        </h3>

        
        @if(count($type->projects) > 0)

        <table id="technologies-projects-table" class="table table-striped">

            <thead class="text-white bg-secondary">
                <th>Title</th>
                <th>Technology</th>
                <th>Year</th>
                <th>Repository name</th>
                <th>Details</th>
            </thead>

            <tbody>
                @foreach($type->projects as $project)
                    <tr>
                        <td>{{$project->title}}</td>
                        <td>{{$project->technology}}</td>
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

       <div  class="mb-4">No projects</div> 

        @endif

        <button class="btn btn-dark">
            <a href="{{route('admin.types.edit', $type->slug)}}">Change</a>
        </button>

        {{-- modal --}}
        <button type="button" class="btn bg-danger text-white" data-bs-toggle="modal" data-bs-target="#deleteProject">
            Delete Type
        </button>

        <div class="modal fade text-dark" id="deleteProject" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Delete</h1>
                    </div>

                    <div class="modal-body">
                        Do you want to delete the selected type? Please consider that this action is irreversible.
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    
                        <form action="{{route('admin.types.destroy', $type->slug)}}" method="POST">
                            @csrf
                            @method('DELETE')
                    
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </form>

                    </div>

                </div>
            </div>
        </div> 
        {{-- // modal --}}

        <div class="my-3">
            <a id="back-link" href="{{route('admin.types.index')}}">Back to all types preview</a>
        </div>
    
    </div>

@endsection