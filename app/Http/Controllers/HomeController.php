<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = DB::table('categories')->get();
        $ingredients = array();
        foreach($categories as $categorie)
        {
            $ingredients[] = DB::table('ingredients')->where('categorie_id', $categorie->id)->get();
        }

        $data = [
            'categories'  => $categories,
            'ingredients' => $ingredients
        ];

        return view('home.index', ['data' => $data]);
    }

    public function readIngredientsFromCategory(Request $request)
    {
      $categorie = DB::table('categories')->where('name', $request->input("categorie"))->get();
      return $ingredients[] = DB::table('ingredients')->where('categorie_id', $categorie[0]->id)->get();
    }

    public function searchIngredients(Request $request)
    {
      return DB::table('ingredients')->where('name', 'like', '%'.$request->input("ingredient").'%')->get();
    }
}
