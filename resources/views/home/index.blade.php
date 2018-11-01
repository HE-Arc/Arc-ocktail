@extends('layouts.app')

@section('title')
    {{config('app.name', "Arc'ocktail")}}
@endsection

@section('content')


<div class="row">
    <div class="col-md-9">
        <div class="row">
            <ul class="nav nav-tabs col-md-12">
                @foreach ($data['categories'] as $categorie)
                    <li><a data-toggle="tab" href="#{{$categorie->name}}">{{$categorie->name}}</a></li>
                @endforeach
            </ul>

            @foreach ($data['categories'] as $key => $categorie)
                <div id="{{$categorie->name}}" class="tab-pane fade">
                    @foreach($data['ingredients'][$key] as $ingredient)
                        <div class="col-md-3">
                            {{$ingredient->name}}
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>

    <div class="col-md-3">Ingerdients</div>
</div>
@endsection
