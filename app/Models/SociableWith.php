<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SociableWith extends Model
{
    protected $table = 'sociable_with';
    protected $fillable = [
        'cats',
        'unknown',
        'dogs',
        'children',
        'pet_id'
    ];
}
