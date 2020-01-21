<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LiveWellIn extends Model
{
    protected $table = 'lives_well_in';
    protected $fillable = [
        'house_with_backyard',
        'apartment',
        'pet_id'
    ];
}
