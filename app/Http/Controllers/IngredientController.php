<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Categorie;
use App\Ingredient;
use App\Quantity;
use App\Unit;

class IngredientController extends Controller
{
    public function index()
    {

    }

    public function create()
    {
        $ingredients = Ingredient::all();
        $categories = Categorie::all();
        $quantities = Quantity::all();
        $units = Unit::all();
        $data = [
            'categories'  => $categories,
            'ingredients' => $ingredients,
            'quantities' => $quantities,
            'units' => $units
        ];
        return view("ingredient.create", ["data" => $data]);
    }

    public function store(Request $request)
    {
        if ($request->has("categorieName"))
        {
            $task = new Categorie;
            $task->name = $request->categorieName;
            $task->save();

            return response()->json(['success'=>'Les données ont étés correctement ajoutés']);
        }
        elseif ($request->has("ingredientName"))
        {
            $task = new Ingredient;
            $task->name = $request->ingredientName;
            $task->alcohol_degree = $request->alcoholDegree;
            $task->categorie_id = $request->categorie;
            $task->unit_id = $request->unit;
            $task->save();

            return response()->json(['success'=>'Les données ont étés correctement ajoutés']);
        }

        return response()->json(['errors'=>"Impossible d'ajouter les données"]);

    }
}
