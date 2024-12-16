@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center my-4">Bienvenue sur Horizon Bâtisseur</h1>
    <div class="row">
        @foreach($properties as $property)
        <div class="col-md-4">
            <div class="card mb-4">
                <img src="{{asset('storage/' . $property->image) }}" class="card-img-top" alt="{{ $property->name }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $property->name }}</h5>
                    <p class="card-text">{{ $property->category }}</p>
                    <p class="card-text"><strong>Status:</strong> {{ $property->status }}</p>
                    <a href="{{ route('properties.show', $property->id) }}" class="btn btn-primary">Voir les détails</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
