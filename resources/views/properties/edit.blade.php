{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Ajouter un nouveau bien</h1>
    <form action="{{ route('properties.update',$property->id) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nom</label>
            <input type="text" class="form-control" id="name" name="name" required value="{{$property->name}}">
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Catégorie</label>
            <input type="text" class="form-control" id="category" name="category" required value="{{$property->category}}">
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" class="form-control" id="image" name="image" value="{{$property->image}}">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="4" required >{{$property->description}}</textarea>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Adresse</label>
            <input type="text" class="form-control" id="address" name="address" required value="{{$property->address}}">
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Statut</label>
            <select class="form-select" id="status" name="status" >
                <option value="occupe">Occupé</option>
                <option value="vacant">Libre</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Modfier</button>
    </form>
</div>
@endsection --}}
