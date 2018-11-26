@extends('layouts.app')

@section('title')
    {{config('app.name', "Arc'ocktail")}}
@endsection

@section('content')

<div class='col-sm-12 col-md-6 col-lg-4 p-2'>
    <div class='card'>
        <img class='card-img-top p-1' src='../uploads/{{$cocktail->name}}.jpg'>
    </div>

    <div>
        <h1>Ingredients</h1>
        <ul>

            @foreach($ingredients as $ingredient)
                <li>{{$ingredient->name}} ({{$ingredient->quantity}} {{$ingredient->unit}})</li>
            @endforeach
        <ul>
    </div>

    <div>
        <h1>Recette</h1>
        {{$cocktail->recipe}}
    </div>
</div>

@endsection
