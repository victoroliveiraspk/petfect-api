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
        'city_id'
    ];
}
