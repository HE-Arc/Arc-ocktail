@extends('layouts.app')

@section('title')
    {{config('app.name', "Arc'ocktail")}}
@endsection

@section('content')

@if (count($cocktails) === 0)
    <h1>Aucun cocktail trouvé !</h1>
@else

    <div id="cocktails" class="row m-2">
        <h1>Voici les cocktail que vous pouvez faire </h1>
    </div>
    <div id="cocktails" class="row m-2">
    @foreach ($cocktails as $key => $cocktail)
    <div class='col-sm-12 col-md-6 col-lg-3 p-2'>
        <a href="{{url('cocktail/' . $cocktail->cocktail_id)}}">
            <div class='card'>
                <img class='card-img-top p-1' src='uploads/{{$cocktail->name}}.jpg'>
                    <div class='card-body'>
                        <h5 class='card-title'>
                        {{$cocktail->name}}
                        </h5>
                        <div class="progress">
                            <div class="progress-bar bg-success" style="width: {{$cocktail->percentage*100}}%" role="progressbar">{{$cocktail->percentage*100}}%</div>
                        </div>
                    </div>
            </div>
        </a>
    </div>
    @endforeach
</div>
@endif

@endsection
