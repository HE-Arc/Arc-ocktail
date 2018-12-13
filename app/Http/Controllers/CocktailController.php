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
            //->pluck('cocktail_id', 'ingredient_id');

        $this->fillIngredient($possibleCocktails);
        $this->setPercentageList($possibleCocktails, $ingredients);

        if (is_null($direction))
            $direction = "desc";

        if (is_null($order))
            $order = "percentage";

        if ($direction === "asc")
            $possibleCocktails = $possibleCocktails->sortBy($order);
        else {
            $possibleCocktails = $possibleCocktails->sortByDesc($order);
        }

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
            $cocktail->percentage = round($nbrIngredient / count($cocktail->ingredients), 2);
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
