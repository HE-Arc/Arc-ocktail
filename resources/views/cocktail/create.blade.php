@extends('layouts.app')

@section('title')
    {{config('app.name', "Arc'ocktail")}}
@endsection

@section('content')

<h1>Ajout de catégorie</h1>
{!! Form::open(['route' => 'cocktail.store']) !!}
{!! Form::label('name', 'Nom de la catégorie') !!}
{!! Form::text('categorieName') !!}

{!!Form::submit('Ajouter une catégorie') !!}
{!! Form::close() !!}

@endsection
