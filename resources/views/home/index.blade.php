@extends('layouts.app')

@section('title')
    {{config('app.name', "Arc'ocktail")}}
@endsection

@section('content')

    <div class="row m-2">
        <div class="col-sm-12 col-md-8 col-lg-8">
            <div class="row">
                <div class="btn-group p-2" role="group" aria-label="Basic example">
                    @foreach ($data['categories'] as $categorie)
                        <button id="{{$categorie->name}}Button" type="button" class="btn btn-light">{{$categorie->name}}</button>
                    @endforeach
                </div>
            </div>
            <div id="ingredients" class="row"></div>
        </div>
        <div class="col-sm-12 col-md-4 col-lg-4">
            <h2>Vos ingrédients</h2>
            <ul class="list-group">
                <!-- TODO - foreach selected ingredients -->
                <!-- <li class="list-group-item">Citron</li> -->
            </ul>
        </div>
    </div>

@endsection

@section('script')

    @foreach ($data['categories'] as $key => $categorie)
        <script type="text/javascript">
            $('#{{$categorie->name}}Button').on('click', function()
            {
                $.get("{{ URL::to('read-data') }}", function(data)
                {
                    $('#ingredients').html("");
                    $.each(data.ingredients[{{$key}}], function(i, value)
                    {
                        var tr = $([
                        "<div class='col-sm-12 col-md-6 col-lg-4 p-2'>",
                        "  <div class='card'>",
                        "    <img class='card-img-top p-1' src='uploads/", value.name, ".jpg'>",
                        "    <div class='card-body'>",
                        "      <h5 class='card-title'>",
                            value.name,
                        "      </h5>",
                        "      <a href='#' class='btn btn-primary'>Ajouter</a>",
                        "    </div>",
                        "  </div>",
                        "</div>"
                        ].join("\n"));
                        $('#ingredients').append(tr);
                    })
                })
            });
        </script>
    @endforeach

    <script type="text/javascript">
    function eventFire(el, etype){
      if (el.fireEvent) {
        el.fireEvent('on' + etype);
      } else {
        var evObj = document.createEvent('Events');
        evObj.initEvent(etype, true, false);
        el.dispatchEvent(evObj);
      }
    }
    eventFire(document.getElementById('{{$data['categories'][0]->name}}Button'), 'click');
    </script>

@endsection
