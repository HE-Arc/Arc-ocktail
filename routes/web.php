<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get("/", "HomeController@index");

Route::get("read-ingredients-from-category", "HomeController@readIngredientsFromCategory");
Route::get("search-ingredients", "HomeController@searchIngredients");
Route::resource("ingredient", "IngredientController", ["only"=> ["store", "create"]]);
Route::resource("cocktail", "CocktailController", ["only"=> ["store", "create", "show"]]);

Route::get('/findCocktail','CocktailController@findCocktail');
