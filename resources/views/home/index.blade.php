@extends('layouts.app')

@section('title')
    {{config('app.name', "Arc'ocktail")}}
@endsection

@section('content')
<ul class="nav nav-tabs">
    @foreach ($data['categories'] as $categorie)
        <li><a data-toggle="tab" href="#{{$categorie->name}}">{{$categorie->name}}</a></li>
    @endforeach
</ul>

<div class="tab-content">

    @foreach ($data['categories'] as $key => $categorie)
        <div id="{{$categorie->name}}" class="tab-pane fade">
            @foreach($data['ingredients'][$key] as $ingredient)
                <div>
                    {{$ingredient->name}}
                </div>
            @endforeach
        </div>
    @endforeach
</div>

@endsection
