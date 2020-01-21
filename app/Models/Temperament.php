<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Temperament extends Model
{
    protected $table = 'temperaments';
    protected $fillable = [
        'docile',
        'aggressive',
        'calm',
        'playful',
        'sociable',
        'aloof',
        'independent',
        'needy',
        'pet_id',
    ];
}
