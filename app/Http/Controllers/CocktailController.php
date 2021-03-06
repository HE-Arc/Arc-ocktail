<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Cookie;
use App\Ingredient;
use App\Cocktail;
use App\Quantity;
use Validator;

class CocktailController extends Controller
{
    /*
    * Used to show the cocktail creation form
    */
    public function create()
    {
        $ingredients = Ingredient::pluck('name', 'id');
        return view("cocktail.create", ["ingredients"=> $ingredients]);
    }

    /**
    * Used when submitting the form to create a cocktail and add it to the database if all the required fields are filled
    */
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
            $file->move($destinationPath, $cocktail->name . ".jpg");

            return response()->json(['success'=>'Entry successfully added']);
        }
        return response()->json(['error'=>$validator->errors()->all()]);
    }

    /**
    * Find the cocktails that use at least one ingredient specified in the request.
    */
    public function findCocktail()
    {
        $order = Input::get('orderby');
        $direction = Input::get('direction');
        $ingredients = Input::get('ingredients');

        $possibleCocktails = DB::table('cocktails')
            ->join('quantities', 'quantities.cocktail_id', '=', 'cocktails.id')
            ->whereIn('ingredient_id', $ingredients)
            ->select('cocktail_id', 'name', 'alcohol_degree')
            ->groupBy('cocktail_id')
            ->get();

        // Add the list of ingredients required for every cocktails
        $this->fillIngredient($possibleCocktails);
        // Add the percentage of completion of the cocktail
        $this->setPercentageList($possibleCocktails, $ingredients);

        if (is_null($direction))
            $direction = "desc";

        if (is_null($order))
            $order = "percentage";

        // Sort the cocktails
        if ($direction === "asc")
            $possibleCocktails = $possibleCocktails->sortBy($order);
        else {
            $possibleCocktails = $possibleCocktails->sortByDesc($order);
        }

        return view("cocktail.showcocktails", ["cocktails"=> $possibleCocktails]);
    }

    /*
    * Add the list of required ingredients for each cocktails
    */
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

    /*
    * Calculate for each cocktails inside $possibleCocktails the percentage of ingredients available from $ingredients
    */
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
            $cocktail->percentage = round($nbrIngredient / count($cocktail->ingredients), 2);
        }
    }

    /*
    * Called to show a cocktail by its id
    */
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
