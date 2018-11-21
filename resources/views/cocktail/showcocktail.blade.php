@extends('layouts.app')

@section('title')
    {{config('app.name', "Arc'ocktail")}}
@endsection

@section('content')

@foreach ($cocktails as $key => $cocktail)
{{$cocktail}}
@endforeach

@endsection
