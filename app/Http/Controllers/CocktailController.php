<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CocktailController extends Controller
{
    public function index()
    {
        return view("cocktail.index", ["cocktail"=>""]);
    }

    public function create()
    {
        return view("cocktail.create", ["cocktail" => new Cocktail()]);
    }

    public function store(Request $request)
    {
        // TODO
    }
}
