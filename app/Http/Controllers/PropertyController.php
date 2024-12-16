<?php

namespace App\Http\Controllers;

use App\Mail\NewPropertyNotification;
use Illuminate\Support\Facades\Mail;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Property;
use Illuminate\Support\Facades\Storage;

class PropertyController extends Controller
{
     /**
     * Affiche la page d'accueil avec les biens récents.
     */
    public function welcome()
    {

        $properties = Property::latest()->take(6)->get(); // Afficher les 6 biens les plus récents
        return view('welcome', compact('properties'));
    }

    /**
     * Affiche la liste des biens pour l'admin.
     */
    public function index()
    {
        $properties = auth()->user()->properties;

        return view('properties.index', compact('properties'));
    }

    /**
     * Affiche le formulaire pour ajouter un bien.
     */
    public function create()
    {
        return view('properties.create');
    }

    /**
     * Enregistre un nouveau bien.
     */
    public function store(Request $request)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Accès refusé.');
        }
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'required|string',
            'address' => 'required|string|max:255',
            'status' => 'required|string',
            'image' => 'required|image|max:2048',

            'dimensions' => 'nullable|numeric',
            'nombre_chambres' => 'nullable|integer',
            'dimensions_chambres' => 'nullable|array',
            'images_chambres' => 'nullable|array',
            'nombre_toilets' => 'nullable|integer',
            'nombre_balcons' => 'nullable|integer',
            'nombre_spacesVerts' => 'nullable|integer',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('properties', 'public');
        }

        Property::create([
            'user_id' => auth()->id(),
            'name' => $request->name,
            'category' => $request->category,
            'description' => $request->description,
            'address' => $request->address,
            'status' => $request->status,
            'image' => $imagePath,

            'dimensions' => $request->dimensions,
            'nombre_chambres' => $request->nombre_chambres,
            'dimensions_chambres' =>$request->dimensions_chambres,
            'images_chambres' => $request->images_chambres,
            'nombre_toilets' =>  $request->nombre_toilets,
            'nombre_balcons' =>  $request->nombre_balcons,
            'nombre_spacesVerts' => $request->nombre_spacesVerts,
        ]);
        // Récupération des utilisateurs "user" pour l'envoi des mails
    $users = User::where('role', 'user')->get();

    // // Envoi des emails
    // foreach ($users as $user) {
    //     Mail::to($user->email)->send(new NewPropertyNotification($property));
    // }

    return redirect()->route('properties.index')->with('success', 'Bien ajouté et notification envoyée.');


    }

    /**
     * Affiche un bien spécifique et ses détails.
     */
    public function show($id)
    {
        $property = Property::with('comments.user')->findOrFail($id);
        return view('properties.show', compact('property'));
    }

    /**
     * Affiche le formulaire pour modifier un bien.
     */
    public function edit($id)
    {
        $property = Property::findOrFail($id);
        return view('properties.edit', compact('property'));
    }

    /**
     * Met à jour un bien existant.
     */
    public function update(Request $request, $id)
    {
        $property = Property::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'required|string',
            'address' => 'required|string|max:255',
            'status' => 'required|in:occupe,vacant',
            'image' => 'nullable|image|max:2048',


            'dimensions' => 'nullable|numeric',
            'nombre_chambres' => 'nullable|integer',
            'dimensions_chambres' => 'nullable|array',
            'images_chambres' => 'nullable|array',
            'nombre_toilets' => 'nullable|integer',
            'nombre_balcons' => 'nullable|integer',
            'nombre_spacesVerts' => 'nullable|integer',

        ]);

        if ($request->hasFile('image')) {
            if ($property->image) {
                Storage::disk('public')->delete($property->image);
            }
            $property->image = $request->file('image')->store('properties', 'public');
        }

        $property->update($request->all());

        return redirect()->route('properties.index')->with('success', 'Bien mis à jour avec succès.');
    }

    /**
     * Supprime un bien existant.
     */
    public function destroy($id)
    {
        $property = Property::findOrFail($id);
        if ($property->image) {
            Storage::disk('public')->delete($property->image);
        }
        $property->delete();

        return redirect()->route('properties.index')->with('success', 'Bien supprimé avec succès.');
    }
}
