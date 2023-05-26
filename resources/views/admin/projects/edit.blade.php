
@extends('layouts/admin')

@section('content')

    <div class="container p-5">

        <h3 class="display-5 fw-bold mb-5">
            Change the selected project
        </h3>
        
        <form action=" {{ route('admin.projects.update',  $project->slug) }} " method="POST" enctype="multipart/form-data">
            @csrf 
            @method('PUT')
  
            <div class="input-group mb-3">
                <label for="title">Title</label>
                <input class="mx-3 form-control @error('title') is-invalid @enderror" type="text" id="title" name="title" value="{{old('title') ?? $project->title}}" required>
                
                @error('title')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="input-group mb-3">
                <label for="description">Description</label>
                <textarea class="mx-3 form-control @error('description') is-invalid @enderror" id="description" name="description" required>{{old('description') ?? $project->description}}</textarea>
                            
                @error('description')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- thumbnail --}}
            <div class="input-group mb-3">
                <label for="thumbnail">Thumbnail</label>
                <input class="mx-3 form-control @error('thumb') is-invalid @enderror" type="file" id="thumbnail" name="thumbnail">
                                
                @error('thumb')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            {{-- // thumbnail --}}

            {{-- type select --}}
            <div class="input-group mb-3">
                <label for="type_id">Type</label>
                <select name="type_id" id="type_id" class="mx-3 form-select @error('type_id') is-invalid @enderror">

                    <option value="" disabled selected>Choose a type for your project</option>
                    <option value="">None</option>

                    @foreach($types as $type) 
                        <option value="{{$type->id}}" {{$type->id == old('type_id', $project->type_id) ? 'selected' : ''}}>{{$type->title}}</option>
                    @endforeach

                </select>
                            
                @error('type_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            {{-- // type select --}}

            {{-- technologies --}}
            <div class="input-group mb-3">
                Technologies:
                
                <div class="form-check">

                    @foreach($technologies as $technology)
                    
                        @if($errors->any())
                            <input type="checkbox" id="technology-{{$technology->id}}" name="technologies[]" value="{{$technology->id}}" @checked(in_array($technology->id, old('technologies', [])))>
                        @else
                            <input type="checkbox" id="technology-{{$technology->id}}" name="technologies[]" value="{{$technology->id}}" @checked($project->technologies->contains($technology->id))>
                        @endif

                            <label for="technology-{{$technology->id}}">{{$technology->name}}</label>

                    @endforeach

                </div>
                    
                @error('technologies') 
                    <div class="text-danger">
                        {{$message}}
                    </div>
                @enderror
            </div>            
            {{-- // technologies --}}

            <div class="input-group mb-3">
                <label for="year">Year</label>
                <input class="mx-3 form-control @error('year') is-invalid @enderror" type="number" id="year" name="year" value="{{old('year') ?? $project->year}}">
                            
                @error('year')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="input-group mb-3">
                <label for="github_repo">Github Repository Name</label>
                <input class="mx-3 form-control @error('github_repo') is-invalid @enderror" type="text" id="github_repo" name="github_repo" value="{{old('github_repo') ?? $project->github_repo}}" required>
                            
                @error('github_repo')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <button class="btn btn-dark" type="submit">Change</button>
  
        </form>

        <div class="mb-2">
            <a id="back-link" href="{{route('admin.projects.show', $project->slug)}}">Back to project details</a>
        </div>

    </div>

@endsection