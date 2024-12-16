@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Gestion des biens</h1>
    <a href="{{ route('properties.create') }}" class="btn btn-success mb-3">Ajouter un bien</a>
    <table class="table">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Catégorie</th>
                <th>Status</th>
                <th>Date d'ajout</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($properties as $property)
            <tr>
                <td>{{ $property->name }}</td>
                <td>{{ $property->category }}</td>
                <td>{{ $property->status }}</td>
                <td>{{ $property->created_at->format('d/m/Y') }}</td>
                <td><img style="width: 100px " src="{{asset('storage/' . $property->image) }}" class="card-img-top" alt="{{ $property->name }}"></td>
                <td>
                    <a href="{{ route('properties.edit', $property->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                    <form action="{{ route('properties.destroy', $property->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
