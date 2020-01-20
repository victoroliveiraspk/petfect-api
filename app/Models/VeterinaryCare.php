<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VeterinaryCare extends Model
{
    protected $table = 'veterinary_care';
    protected $fillable = [
        'castrated',
        'vaccinated',
        'dewormed',
        'need_special_care',
        'pet_id'
    ];
}
