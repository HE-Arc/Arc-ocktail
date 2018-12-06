@extends('layouts.app')

@section('title')
    {{config('app.name', "Arc'ocktail")}}
@endsection

@section('content')

    <div class="row m-2">
        <div class="col-sm-12 col-md-8 col-lg-8">
            <div class="row">
                <div class="btn-group p-2 col-12" role="group" aria-label="Basic example">
                    @foreach ($data['categories'] as $categorie)
                        <button id="{{$categorie->name}}Button" type="button" class="btn btn-lg btn-dark">{{$categorie->name}}</button>
                    @endforeach
                </div>
                <!-- TODO - select a suitable place for the search and replace it's CSS -->
                <input id="search" type="text" placeholder="Rechercher..." class="m-2 form-control"></input>
                <!-- -->
            </div>
            <div id="ingredients" class="row"></div>
        </div>
        <div class="sticky-top col-sm-12 col-md-4 col-lg-4">
            <div class="sticky-top">
                <h2 class="p-2">Vos ingrédients</h2>
                <form action="{{url('findCocktail')}}" method="get" id="cocktailForm">
                    <button class="btn btn-success btn-lg w-100 mt-2 mb-3" id="btnFindCocktail">Trouver des cocktails</button>
                    <ul class="list-group"></ul>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('script')

    <script type="text/javascript">
    let ingredients = [];
    showOrHideFindButton();

    $("#search").focus(function() {
      $("#search").val("");
    });
    $("#search").on("change paste keyup", function() {
        if ($("#search").val() != "")
        {
            $.ajax({
                url: "{{ URL::to('search-ingredients') }}",
                type: 'GET',
                data: 'ingredient=' + $("#search").val(),
                dataType: 'JSON',
                success: function (data) {
                  $('#ingredients').html("");
                  $.each(data, function(i, value)
                  {
                      var tr = $([
                      "<div class='col-sm-12 col-md-6 col-lg-4 p-2'>",
                      "  <div class='card'>",
                      "    <img class='card-img-top p-1' src='uploads/", value.name, ".jpg'>",
                      "    <div class='card-body'>",
                      "      <h5 class='card-title'>",
                          value.name,
                      "      </h5>",
                      "      <button name='" + value.name + "' value='", value.id, "' class='btn btn-primary btnIngredient'>Ajouter</button>",
                      "    </div>",
                      "  </div>",
                      "</div>"
                      ].join("\n"));
                      $('#ingredients').append(tr);
                  })
                },
                error: function (e) {
                    console.log(e.responseText);
                }
            });
        } else {
            $('#ingredients').html("");
        }
    });

    $('#ingredients').on('click', '.btnIngredient', function (e){
        let ingredient = e.target;
        let id = ingredient.value;
        if (!ingredients.includes(id))
        {
            ingredients.push(id);
            $('.list-group').append("<li class='list-group-item p-2' value='" + encodeHTML(id) +"'><span class=''>" + encodeHTML(ingredient.name) + "</span><button value='" + encodeHTML(id) +"' class='close btnRemoveIngredient'>&times;</button></li>");
            $('.list-group').append("<input type='hidden' class='hidden-item' name='ingredients[]' value='" + id + "' />");
            showOrHideFindButton();
        }
    });

    function encodeHTML(s) {
        return s.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/'/g, '&#x27;').replace(/\//g, '&#x2F;').replace(/"/g, '&quot;');
    }

    $('.list-group').on('click', '.btnRemoveIngredient', function (e){
        let ingredient = e.target;
        let id = ingredient.value;

        var index = ingredients.indexOf(id);
        if (index > -1) {
          ingredients.splice(index, 1);
        }
        $(".list-group-item[value='"+id+"']").remove();
        $(".hidden-item[value='"+id+"']").remove();
        showOrHideFindButton();
    });

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });

    $("#btnFindCocktail").click(function(e) {
        $("#cocktailForm").submit();
    });

    function showOrHideFindButton()
    {
        if (ingredients.length > 0)
            $("#btnFindCocktail").show();
        else
            $("#btnFindCocktail").hide();
    }
    </script>

    <!-- Load all ingredients from a category on it's selection -->
    @foreach ($data['categories'] as $key => $categorie)
        <script type="text/javascript">
            $('#{{$categorie->name}}Button').click(function()
            {
                $.ajax({
                    url: "{{ URL::to('read-ingredients-from-category') }}",
                    type: 'GET',
                    data: 'categorie=' + "{{$categorie->name}}",
                    dataType: 'JSON',
                    success: function (data) {
                      console.log(data);
                      $('#ingredients').html("");
                      $.each(data, function(i, value)
                      {
                          var tr = $([
                          "<div class='col-sm-12 col-md-6 col-lg-4 p-2'>",
                          "  <div class='card'>",
                          "    <img class='card-img-top p-1' src='uploads/", value.name, ".jpg'>",
                          "    <div class='card-body'>",
                          "      <h5 class='card-title'>",
                              value.name,
                          "      </h5>",
                          "      <button name='" + value.name + "' value='", value.id, "' class='btn btn-primary btnIngredient'>Ajouter</button>",
                          "    </div>",
                          "  </div>",
                          "</div>"
                          ].join("\n"));
                          $('#ingredients').append(tr);
                      })
                    },
                    error: function (e) {
                        console.log(e.responseText);
                    }
                });
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
