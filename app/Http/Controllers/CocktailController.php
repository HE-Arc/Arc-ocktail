<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Ingredient;
use App\Cocktail;
use App\Quantity;
use Validator;

class CocktailController extends Controller
{

    public function create()
    {
        $ingredients = Ingredient::pluck('name', 'id');
        return view("cocktail.create", ["ingredients"=> $ingredients]);
    }

    public function store(Request $request)
    {
        $rules = [];
        $rules["cocktailName"] = 'required';
        $rules["alcoholDegree"] = 'required';
        $rules["recipe"] = 'required';
        $rules["image"] = 'required';

        foreach($request->input('ingredient') as $key => $value) {
            $rules["ingredient.{$key}"] = 'required';
            $rules["quantity.{$key}"] = 'required';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->passes()) {

            $cocktail = new Cocktail;
            $cocktail->name = $request->cocktailName;
            $cocktail->alcohol_degree = $request->alcoholDegree;
            $cocktail->recipe = $request->recipe;
            $cocktail->save();

            foreach($request->input('ingredient') as $key => $value) {
                Quantity::create(['quantity' => $request->input('quantity')[$key], "cocktail_id" => $cocktail->id, "ingredient_id" => $value]);
            }

            $file = $request->image;
            //Move Uploaded File
            $destinationPath = 'uploads';
            $file->move($destinationPath,$file->getClientOriginalName());

            return response()->json(['success'=>'Entry successfully added']);
        }
        return response()->json(['error'=>$validator->errors()->all()]);
    }

    public function findCocktail()
    {
        $ingredients = Input::get('ingredients');
        $possibleCocktails = DB::table('cocktails')
            ->join('quantities', 'quantities.cocktail_id', '=', 'cocktails.id')
            ->whereIn('ingredient_id', $ingredients)
            ->select('cocktail_id', 'name')
            ->get();
            //->pluck('cocktail_id', 'ingredient_id');
        // TODO ingredients contains the id of the ingredient, must return the possible cocktail
        //$possibleCocktails = [1, 2, 3];

        $this->fillIngredient($possibleCocktails);
        $this->setPercentageList($possibleCocktails, $ingredients);
        $possibleCocktails = $possibleCocktails->sortByDesc('percentage');

        return view("cocktail.showcocktails", ["cocktails"=> $possibleCocktails]);
    }

    private function fillIngredient($possibleCocktails)
    {
        foreach($possibleCocktails as $cocktail)
        {
            $cocktail->ingredients = DB::table('quantities')
                ->select('ingredient_id')
                ->where('cocktail_id', $cocktail->cocktail_id)
                ->pluck('ingredient_id')->toArray();
        }
    }

    private function setPercentageList($possibleCocktails, $ingredients)
    {
        foreach($possibleCocktails as $cocktail)
        {
            $nbrIngredient = 0;
            foreach($cocktail->ingredients as $ingredient)
            {
                if (in_array($ingredient, $ingredients))
                    $nbrIngredient++;
            }
            $cocktail->percentage = $nbrIngredient / count($cocktail->ingredients);
        }
    }

    public function show($id)
    {
        $cocktail = DB::table('cocktails')->where('id', $id)->first();
        $ingredients = DB::table('quantities')
            ->join('ingredients', 'quantities.ingredient_id', '=', 'ingredients.id')
            ->join('units', 'ingredients.unit_id', '=', 'units.id')
            ->select('ingredients.name', 'quantities.quantity', 'units.unit', 'quantities.cocktail_id')
            ->where('cocktail_id', $id)
            ->get();

        return view("cocktail.show", ["cocktail" => $cocktail, "ingredients" => $ingredients]);
    }
}
