
@extends('layouts/admin')

@section('content')

    <div class="container p-5">
        
        <h3 class="display-5 fw-bold mb-5">
            Add a new technology
        </h3>
        
        <form action=" {{ route('admin.technologies.update', $technology->slug) }} " method="POST">
            @csrf 
            @method('PUT')
  
            <div class="input-group mb-3">
                <label for="name">Name</label>
                <input class="mx-3 form-control" type="text" id="name" name="name" value="{{old('name') ?? $technology->name}}" required>
            </div>

            <div class="input-group mb-3" style="width:200px">
                <label for="color">Color</label>
                <input class="mx-3 form-control" type="color" id="color" name="color" value="{{old('color') ?? $technology->color}}" required>
            </div>
  
            <button class="btn btn-dark" type="submit">Change</button>
        </form>

        <div class="mb-2">
            <a id="back-link" href="{{route('admin.technologies.show', $technology->slug)}}">Back to technology details</a>
        </div>

    </div>

@endsection