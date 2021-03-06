<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    protected $table = 'pets';
    protected $fillable = [
        'name',
        'description',
        'avatar_filename',
        'species_id',
        'size_id',
        'genre_id',
        'city_id',
        'user_id'
    ];

    public function veterinary_care()
    {
        return $this->hasOne('App\Models\VeterinaryCare', 'pet_id');
    }

    public function temperament()
    {
        return $this->hasOne('App\Models\Temperament', 'pet_id');
    }

    public function live_well_in()
    {
        return $this->hasOne('App\Models\LiveWellIn', 'pet_id');
    }

    public function sociable_with()
    {
        return $this->hasOne('App\Models\SociableWith', 'pet_id');
    }
}
