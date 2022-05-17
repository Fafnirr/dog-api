<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Dog;
use Illuminate\Http\Request;

class DogController extends Controller
{
    public function index() {
        $dogs = Dog::all();
        return response()->json($dogs, 200);
    }

    public function store(Request $request){
        // La validation de données
        $this->validate($request, [
            'name' => 'required',
            'age' => 'required',
            'breed' => 'required',
            'available' => 'required',
        ]);

        // On crée un nouvel utilisateur
        $dogs = Dog::create([
            'name' => $request->name,
            'breed' => $request->breed,
            'picture' => $request->picture,
            'available' => $request->available
        ]);

        // On retourne les informations du nouvel utilisateur en JSON
        return response()->json($dogs, 201);
    }

    public function show(Dog $dog) {
        return response()->json($dog);
    }

    public function update(Request $request, Dog $dog) {
          // La validation de données
        $this->validate($request, [
            'name' => 'required',
            'age' => 'required',
            'breed' => 'required',
            'available' => 'required',
        ]);

        // On modifie les informations de l'utilisateur
        $dog->update([
            'name' => $request->name,
            'breed' => $request->breed,
            'picture' => $request->picture,
            'available' => $request->available
        ]);

        // On retourne la réponse JSON
        return response()->json();

    }

    public function destroy(Dog $dog) {
        // On supprime l'utilisateur
    $dog->delete();

    // On retourne la réponse JSON
    return response()->json();
    }
}