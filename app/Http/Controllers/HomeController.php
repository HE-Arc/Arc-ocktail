<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;
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

      /*  $selectedIngredients = [];
        $selectedIngredientsId = json_decode(Cookie::get('ingredients'));
        if (!is_null($selectedIngredientsId))
        {
            $selectedIngredientsName = DB::table('ingredients')->whereIn('id', $selectedIngredientsId)->pluck('name');
            foreach($selectedIngredientsId as $key => $id)
            {
                $selectedIngredients[$id] = $selectedIngredientsName[$key];
            }
        }*/

      return view('home.index', ['data' => $data/*, 'selectedIngredients' => json_encode($selectedIngredients)*/]);
    }

    public function readIngredientsFromCategory(Request $request)
    {
      $categorie = DB::table('categories')->where('name', $request->input("categorie"))->get();
      return $ingredients[] = DB::table('ingredients')->where('categorie_id', $categorie[0]->id)->OrderBy("name")->get();
    }

    public function searchIngredients(Request $request)
    {
      return DB::table('ingredients')->where('name', 'like', '%'.$request->input("ingredient").'%')->OrderBy("name")->get();
    }
}
