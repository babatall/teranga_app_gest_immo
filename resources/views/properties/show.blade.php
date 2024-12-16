@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $property->name }}</h1>
    <p><strong>Catégorie :</strong> {{ $property->category }}</p>
    <p><strong>Dimensions :</strong> {{ $property->dimensions }} m²</p>
    <p><strong>Nombre de chambres :</strong> {{ $property->nombre_chambres }}</p>
    <p><strong>Dimensions des chambres :</strong> {{ json_encode($property->dimensions_chambres, JSON_PRETTY_PRINT) }}</p>
    <p><strong>Nombre de toilettes :</strong> {{ $property->nombre_toilets }}</p>
    <p><strong>Nombre de balcons :</strong> {{ $property->nombre_balcons }}</p>
    <p><strong>Nombre d'espaces verts :</strong> {{ $property->nombre_spacesVerts }}</p>
    <p><strong>Description :</strong> {{ $property->description }}</p>
    <p><strong>Adresse :</strong> {{ $property->address }}</p>
    <p><strong>Statut :</strong> {{ $property->status }}</p>

    <h3>Images des chambres :</h3>
    @if($property->rooms_images)
        @foreach($property->images_chambres as $image)
            <img src="{{ asset('storage/' . $image) }}" alt="Image de la chambre" style="width: 150px; margin-right: 10px;">
        @endforeach
    @endif

    <h3>Image principale :</h3>
    <img src="{{ asset('storage/' . $property->image) }}" alt="{{ $property->name }}" style="width: 300px;">

    <a href="{{ route('properties.index') }}" class="btn btn-secondary mt-3">Retour à la liste</a>
</div>
@endsection
