
@extends('layouts/admin')

@section('content')

    <div class="container p-5">
        
        <h3 class="display-5 fw-bold mb-5">
            All project types
        </h3>

        <table id="types-table" class="table table-striped">

            <thead class="text-white bg-secondary">
                <th>Title</th>
                <th>Description</th>
                <th>No. projects</th>
                <th>Details</th>
            </thead>
          
            <tbody>
          
              @foreach($types as $type)
                <tr>
                    <td>{{$type->title}}</td>
                    <td>{{$type->description}}</td>
                    <td>{{count($type->projects)}}</td>
                    <td><a href="{{route('admin.types.show', $type->slug)}}">click here</a></td>
                </tr>
              @endforeach
          
            </tbody>

        </table>

        <button class="btn btn-dark">
            <a href="{{route('admin.types.create')}}">Add a new type</a>
        </button>

    </div>

@endsection