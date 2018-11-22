@extends('layouts.app')

@section('title')
    {{config('app.name', "Arc'ocktail")}}
@endsection

@section('content')

@foreach ($cocktails as $key => $cocktail)
<div class='col-sm-12 col-md-6 col-lg-4 p-2'>
    <a href="{{url('cocktail/' . $cocktail->id)}}">
        <div class='card'>
            <img class='card-img-top p-1' src='uploads/{{$cocktail->name}}.jpg'>
                <div class='card-body'>
                    <h5 class='card-title'>
                    {{$cocktail->name}}
                    </h5>
                </div>
        </div>
    </a>
</div>
@endforeach

@endsection
