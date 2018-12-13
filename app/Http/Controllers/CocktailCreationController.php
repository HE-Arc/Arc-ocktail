<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Ingredient;
use App\Cocktail;
use App\Quantity;
use Validator;

class CocktailCreationController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        $ingredients = Ingredient::pluck('name', 'id');
        return view("cocktail_creation.create", ["ingredients"=> $ingredients]);
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

}
