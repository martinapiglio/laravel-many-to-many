
@extends('layouts/admin')

@section('content')

    <div class="container p-5">
        
        <h3 class="display-5 fw-bold mb-5">
            All technologies
        </h3>

        <table class="table table-striped">

            <thead class="text-white bg-secondary">
                <th>Name</th>
                <th>Color</th>
                <th>Details</th>
            </thead>
          
            <tbody>
                @foreach($technologies as $technology)
                    <tr>
                        <td>{{$technology->name}}</td>
                        <td>{{$technology->color}}</td>
                        <td><a href="{{route('admin.technologies.show', $technology->slug)}}">click here</a></td>
                    </tr>
                @endforeach          
            </tbody>

        </table>

    </div>

@endsection