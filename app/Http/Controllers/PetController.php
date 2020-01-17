<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use Ramsey\Uuid\Uuid;
use App\Models\Pet;

class PetController extends Controller
{
    public function index()
    {
        return response()->json(Pet::all(), 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'string|max:255',
            'avatar' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
            'species_id' => 'required|integer|exists:species,id',
            'size_id'=> 'required|integer|exists:sizes,id',
            'genre_id'=> 'required|integer|exists:genres,id',
            'city_id' => 'required|integer|exists:cities,id'
        ]);

        $uuid4 = Uuid::uuid4();
        $filename = $uuid4->toString() . '.' . $request->file('avatar')->extension();

        Storage::putFileAs('avatars', $request->file('avatar'), $filename);

        $petValues = array_merge($request->all(), ['avatar_filename' => $filename]);

        $pet = new Pet($petValues);
        $pet->save();

        return response()->json($pet, 201);
    }

    public function show($id)
    {
        $pet = Pet::find($id);
        
        if (!$pet) {
            return response()->json(null, 404);
        }

        return response()->json($pet, 200);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'string|max:255',
            'description' => 'string|max:255',
            'avatar' => 'image|mimes:jpeg,png,jpg,svg|max:2048',
            'species_id' => 'integer|exists:species,id',
            'size_id'=> 'integer|exists:sizes,id',
            'genre_id'=> 'integer|exists:genres,id',
            'city_id' => 'integer|exists:cities,id'
        ]);

        $pet = Pet::find($id);
        
        if (!$pet) {
            return response()->json(null, 404);
        }

        if ($request->hasFile('avatar')) {
            Storage::putFileAs('avatars', $request->file('avatar'), $pet->avatar_filename);
        }

        $pet->update($request->all());
        $pet->save();

        return response()->json($pet, 200);
    }

    public function destroy($id)
    {
        $pet = Pet::find($id);

        if (!$pet) {
            return response()->json(null, 404);
        }

        Storage::delete('avatars/' . $pet->avatar_filename);

        $pet->delete();

        return response()->json(null, 204);
    }
}
