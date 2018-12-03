@extends('layouts.app')

@section('title')
    {{config('app.name', "Arc'ocktail")}}
@endsection

@section('content')

<div class="row m-0 p-1">
    <div class="col-12 p-1">

        <div class="rounded border banner">
            <div class="blur banner" style="background-image: url('../uploads/{{$cocktail->name}}.jpg');">
            </div>
        </div>

    </div>

    <div class="col-lg-4 col-md-5 col-sm-12 p-1">
        <div class="card">
            <div class="card-header">
                Ingrédients
            </div>
            <div class="card-body">
                    <ul>
                        @foreach($ingredients as $ingredient)
                            <li>{{$ingredient->name}} ({{$ingredient->quantity}} {{$ingredient->unit}})</li>
                        @endforeach
                    <ul>
            </div>
        </div>
    </div>

    <div class="col-lg-8 col-md-7 col-sm-12 p-1">
        <div class="card">
            <div class="card-header">
                Recette
            </div>
            <div class="card-body">
                <p class="card-text">
                    {{$cocktail->recipe}}
                </p>
            </div>
        </div>
    </div>
</div>

@endsection
