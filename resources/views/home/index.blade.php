@extends('layouts.app')

@section('title')
    {{config('app.name', "Arc'ocktail")}}
@endsection

@section('content')

    <div class="row p-2 m-0">
        <div class="col-sm-12 col-md-8 col-lg-8">
            <div class="row p-2">
                <!-- <div class="row m-2"> -->
                    @foreach ($data['categories'] as $categorie)
                        <div class="col-lg-2 col-md-3 col-6 p-1">
                            <button id="{{$categorie->name}}Button" type="button" class="btn btn-lg btn-outline-light rounded-0 w-100 text-truncate">{{$categorie->name}}</button>
                        </div>
                    @endforeach
                <!-- </div> -->
                <input id="search" type="text" placeholder="Rechercher..." class="mt-3 form-control rounded-0 border-0"></input>
                <div id="sadFace" class="col-12 text-center">
                  <img src="uploads/noIngredients.png" class="my-3" style="opacity: 0.5;">
                  <p>Aucun ingrédient trouvé</p>
                </div>
            </div>
            <div id="ingredients" class="row"></div>
        </div>
        <div class="sticky-top col-sm-12 col-md-4 col-lg-4 pb-3">
            <div class="sticky-top">
                <h2 class="col-12 pt-3 text-center">Vos ingrédients</h2>
                <div id="emptyCart">
                  <img src="uploads/cart.png" class="col-6 offset-3 my-3" style="opacity: 0.5">
                  <div class="col-12 mt-1 text-center">
                    <p>Aucun ingrédient sélectionné</p>
                  </div>
                </div>
                <form action="{{url('findCocktail')}}" method="get" id="cocktailForm">
                    <button class="btn btn-info btn-lg w-100 mt-2 mb-3 rounded-0" id="btnFindCocktail">Trouver des cocktails</button>
                    <ul class="list-group rounded-0 text-dark"></ul>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('script')

    <script type="text/javascript">
    let ingredients = [];
    let loadedIngredients = [];
    showOrHideFindButton();
    $("#sadFace").hide();

    // Search option for the ingredients
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
                  var counter = 0;
                  $.each(data, function(i, value)
                  {
                      var tr = $([
                      "<div id='" + (value.name + "Card").replace(/\s+/g, '') + "' class='col-6 col-md-6 col-lg-4 p-2'>",
                      "  <div class='card rounded-0 border-0'>",
                      "    <img class='card-img-top p-1' src='uploads/", value.name, ".jpg'>",
                      "    <div class='card-body p-3'>",
                      "      <h5 class='card-title text-dark'>",
                          value.name,
                      "      </h5>",
                      "      <button id='" + value.name.replace(/\s+/g, '') + "' name='" + value.name.replace(/\s+/g, '') + "' value='", value.id, "' class='btn btn-info btnIngredient w-100 rounded-0'>Ajouter</button>",
                      "    </div>",
                      "  </div>",
                      "</div>"
                      ].join("\n"));
                      $('#ingredients').append(tr);

                      if (ingredients.indexOf(value.id) != -1) {
                          $(("#" + value.name + "Card").replace(/\s+/g, '')).hide();
                      } else {
                          counter++;
                      }
                  })
                  if (counter > 0) $("#sadFace").hide();
                  else $("#sadFace").show();
                },
                error: function (e) {
                    console.log(e.responseText);
                }
            });
        } else {
            $('#ingredients').html("");
        }
    });

    // Add ingredient in cart
    $('#ingredients').on('click', '.btnIngredient', function (e){
        let ingredient = e.target;
        let id = ingredient.value;
        $(("#" + ingredient.name + "Card").replace(/\s+/g, '')).hide();
        if (!ingredients.includes(parseInt(id)))
        {
            ingredients.push(parseInt(id));
            $('.list-group').append("<li class='list-group-item p-2 rounded-0 border-0' value='" + encodeHTML(id) + "'><span class=''>" + encodeHTML(ingredient.name) + "</span><button name='" + ingredient.name + "' value='" + encodeHTML(id) +"' class='close btnRemoveIngredient'>&times;</button></li>");
            $('.list-group').append("<input type='hidden' class='hidden-item' name='ingredients[]' value='" + id + "' />");
            showOrHideFindButton();
            checkForEmptyCategory();
        }
    });

    function encodeHTML(s) {
        return s.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/'/g, '&#x27;').replace(/\//g, '&#x2F;').replace(/"/g, '&quot;');
    }

    function checkForEmptyCategory() {
        let empty = true;
        for (let i = 0; i < loadedIngredients.length; i++) {
            if (ingredients.indexOf(loadedIngredients[i]) == -1) {
                empty = false;
            }
        }
        if (empty) $("#sadFace").show();
        else $("#sadFace").hide();
    }

    // Remove ingredient in cart on delete click
    $('.list-group').on('click', '.btnRemoveIngredient', function (e) {
        let ingredient = e.target;
        let id = ingredient.value;

        var index = ingredients.indexOf(parseInt(id));
        if (index > -1) {
          ingredients.splice(index, 1);
        }
        $(".list-group-item[value='"+id+"']").remove();
        $(".hidden-item[value='"+id+"']").remove();
        showOrHideFindButton();
        checkForEmptyCategory();
        $(("#" + ingredient.name + "Card").replace(/\s+/g, '')).show();
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
        if (ingredients.length > 0) {
            $("#btnFindCocktail").show();
            $("#emptyCart").hide();
        } else {
            $("#btnFindCocktail").hide();
            $("#emptyCart").show();
        }
    }
    </script>

    <!-- Load all ingredients from a category on it's selection -->
    @foreach ($data['categories'] as $key => $categorie)
        <script type="text/javascript">
            $('#{{$categorie->name}}Button').click(function()
            {
                $("#search").val("");
                category = '#{{$categorie->name}}';
                $.ajax({
                    url: "{{ URL::to('read-ingredients-from-category') }}",
                    type: 'GET',
                    data: 'categorie=' + "{{$categorie->name}}",
                    dataType: 'JSON',
                    success: function (data) {
                        $('#ingredients').html("");
                        var counter = 0;
                        loadedIngredients = [];
                        $.each(data, function(i, value) {
                            loadedIngredients.push(parseInt(value.id));
                            var tr = $([
                            "<div id='" + value.name.replace(/\s+/g, '') + "Card' class='col-6 col-md-6 col-lg-4 p-2'>",
                            "  <div class='card rounded-0 border-0'>",
                            "    <img class='card-img-top p-1' src='uploads/", value.name, ".jpg'>",
                            "    <div class='card-body p-3'>",
                            "      <h5 class='card-title text-dark'>",
                                value.name,
                            "      </h5>",
                            "      <button id='" + value.name.replace(/\s+/g, '') + "' name='" + value.name + "' value='", value.id, "' class='btn btn-info btnIngredient w-100 rounded-0'>Ajouter</button>",
                            "    </div>",
                            "  </div>",
                            "</div>"
                            ].join("\n"));
                            $('#ingredients').append(tr);

                            if (ingredients.indexOf(value.id) != -1) {
                                $(("#" + value.name + "Card").replace(/\s+/g, '')).hide();
                            } else {
                                counter++;
                            }
                        })
                        if (counter == 0) $("#sadFace").show();
                        else $("#sadFace").hide();
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
