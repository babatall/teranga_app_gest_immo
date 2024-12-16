<!DOCTYPE html>
<html>
<head>
    <title>Nouveau bien disponible</title>
</head>
<body>
    <h1>Un nouveau bien est disponible : {{ $property->name }}</h1>
    <p>Catégorie : {{ $property->category }}</p>
    <p>Dimensions : {{ $property->dimensions }} m²</p>
    <p>Description : {{ $property->description }}</p>
    <p>Adresse : {{ $property->address }}</p>
    <p>Statut : {{ $property->status }}</p>

    <a href="{{ route('properties.show', $property) }}" style="color: white; background: blue; padding: 10px 20px; text-decoration: none;">Voir les détails</a>
</body>
</html>
