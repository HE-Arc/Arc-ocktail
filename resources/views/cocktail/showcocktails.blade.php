@extends('layouts.app')

@section('title')
    {{config('app.name', "Arc'ocktail")}}
@endsection

@section('content')

@if (count($cocktails) === 0)
    <h1>Aucun cocktail trouvé !</h1>
@else
    @foreach ($cocktails as $key => $cocktail)
    <div class='col-sm-12 col-md-6 col-lg-4 p-2'>
        <a href="{{url('cocktail/' . $cocktail->cocktail_id)}}">
            <div class='card'>
                <img class='card-img-top p-1' src='uploads/{{$cocktail->name}}.jpg'>
                    <div class='card-body'>
                        <h5 class='card-title'>
                        {{$cocktail->name}} ({{$cocktail->percentage}} match)
                        </h5>
                    </div>
            </div>
        </a>
    </div>
    @endforeach
@endif

@endsection
