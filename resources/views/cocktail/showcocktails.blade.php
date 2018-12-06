@extends('layouts.app')

@section('title')
    {{config('app.name', "Arc'ocktail")}}
@endsection

@section('content')

@if (count($cocktails) === 0)
    <h1>Aucun cocktail trouvé !</h1>
@else
    <div id="cocktails" class="row m-2">
        <h1>Voici les cocktails que vous pouvez faire </h1>
    </div>



    <div class="row m-2">
        <div class="dropdown m-2">
          <button class="btn btn-secondary dropdown-toggle" type="button" id="orderMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Trier par
          </button>
          <div class="dropdown-menu" aria-labelledby="orderMenu">
            <a class="dropdown-item" href="{{url()->full()}}&orderby=name">Nom</a>  <!--Not the cleaniest solution-->
            <a class="dropdown-item" href="{{url()->full()}}&orderby=alcohol_degree">Degré d'alcool</a>
            <a class="dropdown-item" href="{{url()->full()}}&orderby=percentage">Pourcentage d'ingrédient</a>
          </div>
        </div>

        <div class="dropdown m-2">
          <button class="btn btn-secondary dropdown-toggle" type="button" id="orderDirection" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Ordre
          </button>
          <div class="dropdown-menu" aria-labelledby="orderDirection">
            <a class="dropdown-item" href="{{url()->full()}}&direction=asc">Ascendant</a>
            <a class="dropdown-item" href="{{url()->full()}}&direction=desc">Descendant</a>
          </div>
        </div>
    </div>
    <div id="cocktails" class="row m-2">
    @foreach ($cocktails as $key => $cocktail)
    <div class='col-sm-12 col-md-6 col-lg-3 p-2'>
        <a href="{{url('cocktail/' . $cocktail->cocktail_id)}}">
            <div class='card'>
                <img class='card-img-top p-1' src='uploads/{{$cocktail->name}}.jpg'>
                    <div class='card-body'>
                        <h5 class='card-title'>
                        {{$cocktail->name}} ({{$cocktail->alcohol_degree}}°)
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
