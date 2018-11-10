<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CocktailController extends Controller
{
    public function index()
    {

    }

    public function create()
    {
        // $ingredients = Ingredient::all();
        // $categories = Categorie::all();
        // $quantities = Quantity::all();
        // $units = Unit::all();
        return view("cocktail.create", ["cocktail"=>""]);
    }

    public function store(Request $request)
    {
        // TODO
    }
}
