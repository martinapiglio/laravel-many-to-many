
@extends('layouts/admin')

@section('content')

    <div class="container p-5">
        
        <h3 class="display-5 fw-bold mb-5">
            Add a new type
        </h3>
        
        <form action=" {{ route('admin.types.update', $type->slug) }} " method="POST">
            @csrf 
            @method('PUT')
  
            <div class="input-group mb-3">
                <label for="title">Title</label>
                <input class="mx-3 form-control @error('title') is-invalid @enderror" type="text" id="title" name="title" value="{{old('title') ?? $type->title}}" required>
                
                @error('title')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>

            <div class="input-group mb-3">
                <label for="description">Description</label>
                <textarea class="mx-3 form-control @error('description') is-invalid @enderror" id="description" name="description" required>{{old('description') ?? $type->description}}</textarea>
                            
                @error('description')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            
            </div>
  
            <button class="btn btn-dark" type="submit">Change</button>
        </form>

        <div class="mb-2">
            <a id="back-link" href="{{route('admin.types.show', $type->slug)}}">Back to type details</a>
        </div>

    </div>

@endsection