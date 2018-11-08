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
                    <button id="{{$categorie->name}}Button">{{$categorie->name}}</button>
                @endforeach
            </ul>

            <div id="container" class="container"></div>
        </div>
    </div>

    <div class="col-md-3">Ingerdients</div>
</div>
@endsection

@section('script')

  @foreach ($data['categories'] as $key => $categorie)
    <script type="text/javascript">
      $('#{{$categorie->name}}Button').on('click', function()
      {
        $.get("{{ URL::to('read-data') }}", function(data)
        {
          $('#container').html("");
          $.each(data.ingredients[{{$key}}], function(i, value)
          {
            var tr = $([
              "<div class='col-sm-12 col-md-6 col-lg-4'>",
              "  <div class='card'>",
              "    <img class='card-img-top' src='", value.name, ".png'>",
              "    <div class='card-body'>",
              "      <h5 class='card-title'>",
                       value.name,
              "      </h5>",
              "      <a href='#' class='btn btn-primary'>Ajouter</a>",
              "    </div>",
              "  </div>",
              "</div>"
            ].join("\n"));
            $('#container').append(tr);
          })

        })

      });
    </script>
  @endforeach

@endsection
