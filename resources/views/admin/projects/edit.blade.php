@extends('layouts.app')

@section('content')

<div class="container py-5">
    <h1>Edit Project</h1>


        <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- name-input --}}
        <div class="mb-3">
            <label class="form-label">Name Project</label>
            <input type="text" 
            class="form-control @error('name') is-invalid @elseif(old('name')) is-valid  @enderror"
            value="{{$project->description}}"
            name="name">

            @error('name')
                <div class="invalid-feedback">
                {{ $message }}
                </div>
            {{-- @elseif(old('name'))
                valid-feedback
                <div class="valid-feedback">
                Ottimo lavoro!
                </div> --}}
            @enderror
        </div>

        
            {{-- type -input --}}
            <div class="mb-3">
              <label class="form-label">Typology</label>
              <select class="form-select" name="type_id">
                @foreach ($types as $type )
                  <option value="{{$type->id}}">{{$type->name}}</option>
                @endforeach
              </select>
            </div>


        {{-- description-input --}}
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea cols="30" rows="5" 
             name="description"
             class="form-control @error('description') is-invalid @enderror">{{$project->description}}</textarea>
        </div>

        {{-- cover_img input --}}
        <div class="mb-3">
            <label class="form-label">Cover Image</label>
            <input type="file" class="form-control  @error('cover_img') is-invalid @enderror" name="cover_img">
            @error('cover_img')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror 

            <img  class="img-thumbnail" src="{{asset('/storage/'. $project->cover_img)}}" alt="">
          </div>
          
          {{-- completed input --}}
          <div class="mb-3 form-check form-switch">
            <input class="form-check-input" type="checkbox" role="switch" id="switch_public" name="public"
              {{ old('public', 1) ? 'checked' : '' }} >
            <label class="form-check-label" for="switch_public">Completed</label>
          </div>

          {{-- github_link --}}
          <div class="mb-3">
            <label class="form-label">GitHub Link</label>
            <input type="url" 
            class="form-control @error('github_link') is-invalid @elseif(old('github_link')) is-valid  @enderror"
            name="{{ $errors->has('github_link') ? '' : old('github_link') }}"
            value="{{$project->github_link}}">
            
            @error('github_link')
                <div class="invalid-feedback">
                {{ $message }}
                </div>
            @enderror
        </div>
      
        <button type="submite" class="btn btn-primary">Save</button>

        <a class="btn btn-warning" href="{{route('admin.projects.index')}}">Return To Projects</a>


        <a href="{{route('admin.projects.index')}}">Return index</a>

        </form>
</div>

@endsection