@extends('layouts.app')

@section('content')
    {{-- creo la mia tabella --}}
            {{-- aggiungo bottone aggiungo categoria --}}
            <a href="{{route('admin.projects.create')}}">Create</a>
    <div class="container">
        
        <div class="row row-cols-1 row-cols-md-4 g-4">
            @foreach ($projects as $project)
                <div class="col">
                    <div class="card">
                        <img src="{{asset('/storage/'.  $project->cover_img)}}" class="card-img-top" alt="...">
                        <div class="card-body pt-5">
                            <h5 class="card-title"> {{$project->name}}</h5>
                            <p class="card-text">{{Str::limit($project->description , 30)}}</p>
            
                            <div class="d-flex gap-3 pt-4">
                                {{-- redirect show.blade.php --}}
                                <a href="{{ route('admin.projects.show', $project->id) }}" class="btn btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
    
                                {{-- redirect edit.blade.php --}}
                                <a href="{{ route('admin.projects.edit', $project->id) }}" class="btn btn-warning">
                                    <i class="fas fa-pencil"></i>
                                </a>
    
                                {{-- delete-button --}}
                                <form action="{{ route('admin.projects.destroy', $project->id) }}" method="POST">
                                    @csrf()
                                    @method('delete')
                    
                                    <button class="btn btn-danger">
                                    <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                                {{-- creo un input  con type="hidden" e value="0" 
                                sopra il checkbox che l'utente deve fleggare 
                                cosi se non viene fleggato viene inviato il valore del mio input hidden

                                se viene fleggato il secondo input allora vengono inviati due valori:
                                il primo: public= 0
                                il  secondo public=1
                                quindi il secono lo sovrascrive --}}    
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- src="{{Vite::asset('resources/img/dc-logo.png')}}" --}}


    </div>
    @endsection