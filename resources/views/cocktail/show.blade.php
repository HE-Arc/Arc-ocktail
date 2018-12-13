@extends('layouts.app')

@section('title')
    {{config('app.name', "Arc'ocktail")}}
@endsection

@section('content')

<div class="row p-2 m-0">

    <h1 class="col-12">{{$cocktail->name}}</h1>

    <div id="imgCocktail" class="col-12 col-lg-4 p-2">
        <div class="banner">
            <div class="banner" style="background-image: url('../uploads/{{$cocktail->name}}.jpg');">
            </div>
        </div>

    </div>

    <div id="ingredientsCocktail" class="col-12 col-lg-3 p-2">
        <div class="card rounded-0 border-0 bg-dark">
            <div class="card-header">Ingrédients</div>
            <div class="card-body">
                    <ul>
                        @foreach($ingredients as $ingredient)
                            <li>{{$ingredient->name}} ({{$ingredient->quantity}} {{$ingredient->unit}})</li>
                        @endforeach
                    <ul>
            </div>
        </div>
    </div>

    <div id="receiptCocktail" class="col-12 col-lg-5 p-2">
        <div class="card rounded-0 border-0 bg-dark">
            <div class="card-header">Recette</div>
            <div class="card-body">
                <p class="card-text">
                    {{$cocktail->recipe}}
                </p>
            </div>
        </div>
    </div>


</div>

<script type="text/javascript">
    let heightImage = $("#imgCocktail").height();
    let heightIngredients = $("#ingredientsCocktail").height();
    let heightReceipt = $("#receiptCocktail").height();
    console.log(heightImage + " " + heightIngredients + " " + heightReceipt);
</script>

@endsection
