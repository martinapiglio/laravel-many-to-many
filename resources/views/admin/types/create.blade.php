
@extends('layouts/admin')

@section('content')

    <div class="container p-5">
        
        <h3 class="display-5 fw-bold mb-5">
            Add a new type
        </h3>
        
        <form action=" {{ route('admin.types.store') }} " method="POST">
            @csrf 
  
            <div class="input-group mb-3">
                <label for="title">Title</label>
                <input class="mx-3 form-control @error('title') is-invalid @enderror" type="text" id="title" name="title" value="{{old('title')}}" required>
                
                @error('title')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>

            <div class="input-group mb-3">
                <label for="description">Description</label>
                <textarea class="mx-3 form-control @error('description') is-invalid @enderror" id="description" name="description" required>{{old('description')}}</textarea>
                            
                @error('description')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            
            </div>
  
            <button class="btn btn-dark" type="submit">Add</button>
        </form>

        <div class="mb-2">
            <a id="back-link" href="{{route('admin.types.index')}}">Show all types</a>
        </div>

    </div>

@endsection