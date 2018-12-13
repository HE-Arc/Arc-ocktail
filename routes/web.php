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

Route::get("/", "HomeController@index")->name("home");

Route::get("read-ingredients-from-category", "HomeController@readIngredientsFromCategory");
Route::get("search-ingredients", "HomeController@searchIngredients");
Route::resource("ingredient", "IngredientController", ["only"=> ["store", "create"]]);
Route::resource("cocktail", "CocktailController", ["only" => ["show"]]);
Route::resource("cocktail_creation", "CocktailCreationController", ["only" => ["store", "create"]]);

Route::get('/findCocktail','CocktailController@findCocktail');

/*Route::get('login', array('uses' => 'HomeController@showLogin'));
Route::post('login', array('uses' => 'HomeController@doLogin'));*/

Auth::routes();
