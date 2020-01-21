<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;
use App\Models\Pet;
use App\Models\VeterinaryCare;
use App\Models\Temperament;
use App\Models\LiveWellIn;

class PetController extends Controller
{
    public function index()
    {
        return response()->json(Pet::with('veterinary_care', 'temperament', 'live_well_in')->get(), 200);
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
            'city_id' => 'required|integer|exists:cities,id',
            'castrated' => 'required|boolean',
            'vaccinated' => 'required|boolean',
            'dewormed' => 'required|boolean',
            'need_special_care' => 'required|boolean',
            'docile' => 'required|boolean',
            'aggressive' => 'required|boolean',
            'calm' => 'required|boolean',
            'playful' => 'required|boolean',
            'sociable' => 'required|boolean',
            'aloof' => 'required|boolean',
            'independent' => 'required|boolean',
            'needy' => 'required|boolean',
            'house_with_backyard' => 'required|boolean',
            'apartment' => 'required|boolean'
        ]);

        $uuid4 = Uuid::uuid4();
        $filename = $uuid4->toString() . '.' . $request->file('avatar')->extension();
        
        $request->merge(['avatar_filename' => $filename]);

        $avatar_path = Storage::putFileAs('avatars', $request->file('avatar'), $filename);
        
        DB::beginTransaction();

        try {
            $pet = new Pet($request->all());
            $pet->save();

            $request->merge(['pet_id' => $pet->id]);

            $veterinaryCare = new VeterinaryCare($request->all());
            $veterinaryCare->save();

            $temperament = new Temperament($request->all());
            $temperament->save();

            $liveWellIn = new LiveWellIn($request->all());
            $liveWellIn->save();

            DB::commit();

            $pet = Pet::with('veterinary_care', 'temperament', 'live_well_in')->where('id', $pet->id)->first();

            return response()->json($pet, 201);
        }
        catch(\Throwable $e) {
            DB::rollBack();

            Storage::delete($avatar_path);

            throw $e;
        }
    }

    public function show($id)
    {
        $pet = Pet::with('veterinary_care', 'temperament', 'live_well_in')->where('id', $id)->first();
        
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
            'city_id' => 'integer|exists:cities,id',
            'castrated' => 'boolean',
            'vaccinated' => 'boolean',
            'dewormed' => 'boolean',
            'need_special_care' => 'boolean',
            'docile' => 'boolean',
            'aggressive' => 'boolean',
            'calm' => 'boolean',
            'playful' => 'boolean',
            'sociable' => 'boolean',
            'aloof' => 'boolean',
            'independent' => 'boolean',
            'needy' => 'boolean',
            'house_with_backyard' => 'boolean',
            'apartment' => 'boolean'
        ]);

        $pet = Pet::find($id);
        
        if (!$pet) {
            return response()->json(null, 404);
        }

        if ($request->hasFile('avatar')) {
            Storage::putFileAs('avatars', $request->file('avatar'), $pet->avatar_filename);
        }

        DB::beginTransaction();

        try {
            $pet->update($request->all());
            $pet->save();

            $veterinaryCare = VeterinaryCare::where('pet_id', $pet->id)->first();
            $veterinaryCare->update($request->all());
            $veterinaryCare->save();

            $temperament = Temperament::where('pet_id', $pet->id)->first();
            $temperament->update($request->all());
            $temperament->save();

            $liveWellIn = LiveWellIn::where('pet_id', $pet->id)->first();
            $liveWellIn->update($request->all());
            $liveWellIn->save();

            DB::commit();

            $pet = Pet::with('veterinary_care', 'temperament', 'live_well_in')->where('id', $id)->first();

            return response()->json($pet, 200);
        }
        catch(\Throwable $e) {
            DB::rollBack();

            throw $e;
        }
    }

    public function destroy($id)
    {
        $pet = Pet::find($id);

        if (!$pet) {
            return response()->json(null, 404);
        }

        DB::beginTransaction();

        try {
            $veterinaryCare = VeterinaryCare::where('pet_id' , $pet->id)->first();
            $veterinaryCare->delete();

            $temperament = Temperament::where('pet_id' , $pet->id)->first();
            $temperament->delete();

            $liveWellIn = LiveWellIn::where('pet_id' , $pet->id)->first();
            $liveWellIn->delete();

            $pet->delete();

            DB::commit();

            Storage::delete('avatars/' . $pet->avatar_filename);

            return response()->json(null, 204);
        }
        catch(\Throwable $e) {
            DB::rollBack();

            throw $e;
        }
    }
}
