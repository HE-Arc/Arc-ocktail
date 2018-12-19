@extends('layouts.app')

@section('title')
    {{config('app.name', "Arc'ocktail")}}
@endsection

@section('content')


<div class="row p-2 m-0">
@if (count($cocktails) === 0)
    <h1>Aucun cocktail trouvé !</h1>
@else
    <div class="col-12">
        <div class="row">
            <h1 class="col-12">Voici les cocktails que vous pouvez faire </h1>
            <div class="dropdown p-2 col-6 col-lg-4 align-self-center">
                <button class="btn btn-light dropdown-toggle w-100 rounded-0" type="button" id="orderMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Trier par</button>
                <div class="dropdown-menu w-75 rounded-0 border-0 m-0" aria-labelledby="orderMenu">
                    <a class="dropdown-item text-truncate" href="{{url()->full()}}&orderby=name">Nom</a>  <!--Not the cleaniest solution-->
                    <a class="dropdown-item text-truncate" href="{{url()->full()}}&orderby=alcohol_degree">Degré d'alcool</a>
                    <a class="dropdown-item text-truncate" href="{{url()->full()}}&orderby=percentage">Pourcentage d'ingrédient</a>
                </div>
            </div>

            <div class="dropdown p-2 col-6 col-lg-4">
                <button class="btn btn-light dropdown-toggle w-100 rounded-0" type="button" id="orderDirection" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Ordre</button>
                <div class="dropdown-menu w-75 rounded-0 border-0 m-0" aria-labelledby="orderDirection">
                    <a class="dropdown-item text-truncate" href="{{url()->full()}}&direction=asc">Ascendant</a>
                    <a class="dropdown-item text-truncate" href="{{url()->full()}}&direction=desc">Descendant</a>
                </div>
            </div>
        </div>

        <div id="cocktails" class="row">
            @foreach ($cocktails as $key => $cocktail)
                <div class='col-6 col-lg-3 p-2'>
                    <a href="{{url('cocktail/' . $cocktail->cocktail_id)}}" class="no-underline">
                        <div class='card rounded-0 border-0 h-100'>
                            <img class='card-img-top p-1' src='uploads/{{strtolower($cocktail->name)}}.jpg'>
                            <div class='card-body p-3 align-text-bottom'>
                                <h5 class='card-title'>{{$cocktail->name}} ({{$cocktail->alcohol_degree}}°)</h5>
                                <div class="progress rounded-0 mb-1">
                                    <div class="progress-bar bg-success" style="width: {{$cocktail->percentage*100}}%" role="progressbar">{{$cocktail->percentage*100}}%</div>
                                </div>
                                <div class="progress rounded-0">
                                    <div class="progress-bar bg-danger" style="width: {{$cocktail->alcohol_degree}}%" role="progressbar">Alcool</div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
        @endif
</div>
@endsection
