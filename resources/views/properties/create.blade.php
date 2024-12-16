{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Ajouter un nouveau bien</h1>
    <form action="{{ route('properties.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nom</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Catégorie</label>
            <input type="text" class="form-control" id="category" name="category" required>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" class="form-control" id="image" name="image">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Adresse</label>
            <input type="text" class="form-control" id="address" name="address" required>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Statut</label>
            <select class="form-select" id="status" name="status">
                <option value="occupe">Occupé</option>
                <option value="vacant">Libre</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
</div>
@endsection --}}


@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ isset($property) ? 'Modifier le bien' : 'Ajouter un bien' }}</h1>
    <form action="{{ isset($property) ? route('properties.update', $property) : route('properties.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($property))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label for="name" class="form-label">Nom du bien</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $property->name ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="category" class="form-label">Catégorie</label>
            <select name="category" id="category" class="form-control" required>
                <option value="Luxe" {{ (isset($property) && $property->category == 'Luxe') ? 'selected' : '' }}>Luxe</option>
                <option value="Moyen" {{ (isset($property) && $property->category == 'Moyen') ? 'selected' : '' }}>Moyen</option>
                {{-- <option value="Standard" {{ (isset($property) && $property->category == 'Standard') ? 'selected' : '' }}>Standard</option> --}}
            </select>
        </div>

        <div class="mb-3">
            <label for="dimensions" class="form-label">Dimensions (m²)</label>
            <input type="number" step="0.01" name="dimensions" id="dimensions" class="form-control" value="{{ old('dimensions', $property->dimensions ?? '') }}">
        </div>

        <div class="mb-3">
            <label for="number_of_rooms" class="form-label">Nombre de chambres</label>
            <input type="number" name="nombre_chambres" id="number_of_rooms" class="form-control" value="{{ old('nombre_chambres', $property->nombre_chambres ?? '') }}">
        </div>

        <div class="mb-3">
            <label for="rooms_dimensions" class="form-label">Dimensions des chambres (JSON)</label>
            <textarea name="dimensions_chambres" id="rooms_dimensions[] " class="form-control">{{ old('dimensions_chambres', json_encode($property->dimensions_chambres ?? [], JSON_PRETTY_PRINT)) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="rooms_images" class="form-label">Images des chambres (upload multiple)</label>
            <input type="file" name="images_chambres[]" id="rooms_images" class="form-control" multiple>
        </div>

        <div class="mb-3">
            <label for="number_of_toilets" class="form-label">Nombre de toilettes</label>
            <input type="number" name="nombre_toilets" id="number_of_toilets" class="form-control" value="{{ old('number_of_toilets', $property->nombre_toilets ?? '') }}">
        </div>

        <div class="mb-3">
            <label for="nombre_balcons" class="form-label">Nombre de balcons</label>
            <input type="number" name="nombre_balcons" id="nombre_balcons" class="form-control" value="{{ old('nombre_balcons', $property->nombre_balcons ?? '') }}">
        </div>

        <div class="mb-3">
            <label for="nombre_spacesVerts" class="form-label">Nombre d'espaces verts</label>
            <input type="number" name="nombre_spacesVerts" id="nombre_spacesVerts" class="form-control" value="{{ old('nombre_spacesVerts', $property->nombre_spacesVerts ?? '') }}">
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control" required>{{ old('description', $property->description ?? '') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Adresse</label>
            <input type="text" name="address" id="address" class="form-control" value="{{ old('address', $property->address ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="image_path" class="form-label">Image principale</label>
            <input type="file" name="image" id="image_path" class="form-control">
            @if(isset($property) && $property->image)
                <p>Image actuelle : <img src="{{ asset('storage/' . $property->image) }}" alt="Image actuelle" style="width: 150px;"></p>
            @endif
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Statut</label>
            <select name="status" id="status" class="form-control" required>
                <option value="Libre" {{ (isset($property) && $property->status == 'Libre') ? 'selected' : '' }}>Libre</option>
                <option value="Occupé" {{ (isset($property) && $property->status == 'Occupé') ? 'selected' : '' }}>Occupé</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">{{ isset($property) ? 'Modifier' : 'Ajouter' }}</button>
    </form>
</div>
@endsection

