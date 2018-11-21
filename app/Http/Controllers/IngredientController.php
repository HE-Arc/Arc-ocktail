<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Categorie;
use App\Ingredient;
use App\Quantity;
use App\Unit;
use Validator;

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
        $requestOk = false;
        $validator = null;
        if ($request->has("categorieName"))
        {
            $rules = [];
            $rules["categorieName"] = 'required';

            $validator = Validator::make($request->all(), $rules);

            if ($validator->passes())
            {
                $this->createCategorie($request);
                $requestOk = true;
            }

        }
        elseif ($request->has("ingredientName"))
        {
            $rules = [];
            $rules["ingredientName"] = 'required';
            $rules["alcoholDegree"] = 'required';
            $rules["categorie"] = 'required';
            $rules["unit"] = 'required';
            $rules["image"] = 'required';

            $validator = Validator::make($request->all(), $rules);

            if ($validator->passes())
            {
                $this->createIngredient($request);
                $requestOk = true;
            }
        }

        elseif ($request->has("unitName"))
        {
            $rules = [];
            $rules["unitName"] = 'required';

            $validator = Validator::make($request->all(), $rules);

            if ($validator->passes())
            {
                $this->createUnit($request);
                $requestOk = true;
            }
        }

        if ($requestOk)
            return response()->json(['success'=>'Entry successfully added']);
        return response()->json(['error'=>$validator->errors()->all()]);

    }

    private function createCategorie(Request $request)
    {
        $categorie = new Categorie;
        $categorie->name = $request->categorieName;
        $categorie->save();
    }

    private function createIngredient(Request $request)
    {
        $ingredient = new Ingredient;
        $ingredient->name = $request->ingredientName;
        $ingredient->alcohol_degree = $request->alcoholDegree;
        $ingredient->categorie_id = $request->categorie;
        $ingredient->unit_id = $request->unit;
        $ingredient->save();

        $file = $request->image;
        //Move Uploaded File
        $destinationPath = 'uploads';
        $file->move($destinationPath, $request->ingredientName . "." . $file->getClientOriginalExtension());
    }

    private function createUnit(Request $request)
    {
        $unit = new unit;
        $unit->unit = $request->unitName;
        $unit->save();
    }
}
