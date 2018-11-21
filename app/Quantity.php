<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quantity extends Model
{
    protected $table = 'quantities';
    protected $fillable = ['quantity', 'cocktail_id', 'ingredient_id'];
}
