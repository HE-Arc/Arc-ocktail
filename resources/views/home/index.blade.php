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
                  <button class="col-10 col-md-9 btn btn-info btn-lg my-3 rounded-0 text-truncate" id="btnFindCocktail" style="width: 80%">Trouver des cocktails</button>
                  <button class="col-2 col-md-3 btn btn-danger btn-lg my-3 rounded-0" id="btnDeleteIngredients" style="float:right">X</button>
                  <ul class="list-group rounded-0 text-dark"></ul>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('script')

    <script type="text/javascript">

    $(document).ready(function()
    {
        let cookie = getCookie("ingredients");
        if (typeof cookie !== "undefined") {
            let cookieSplited = cookie.split("*");
            let ids = JSON.parse(cookieSplited[0]);
            let names = JSON.parse(cookieSplited[1]);
            if (cookieSplited.length == 2)
            {
                for(let i = 0; i < ids.length; i++)
                {
                    selectIngredient(ids[i].toString(), names[i].toString());
                }
            }
        }
    });

    function getCookie(name) {
        var value = "; " + document.cookie;
        var parts = value.split("; " + name + "=");
        if (parts.length == 2) return parts.pop().split(";").shift();
    }

    let ingredients = [];
    let ingredientsName = [];
    let loadedIngredients = [];
    let loadedIngredientsName = [];
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
                      "    <img class='card-img-top p-1' src='" + '{{url('/uploads/')}}' + "/" + value.name + "'.jpg'>",
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
                          $(("#" + value.name + "Card").replace(/\s+/g, '')).hide(200);
                      } else {
                          counter++;
                      }
                  })
                  if (counter > 0) $("#sadFace").hide();
                  else $("#sadFace").show(500);
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
        selectIngredient(id, ingredient.name)
    });

    function selectIngredient(id, name)
    {
        $(("#" + name + "Card").replace(/\s+/g, '')).hide(200);
        if (!ingredients.includes(parseInt(id)))
        {
            ingredients.push(parseInt(id));
            ingredientsName.push(name);
            $('.list-group').append("<li id='listItem" + parseInt(id) + "' class='list-group-item p-2 rounded-0 border-0' value='" + parseInt(id) + "'><span class=''>" + encodeHTML(name) + "</span><button name='" + name + "' value='" + encodeHTML(id) +"' class='close btnRemoveIngredient'>&times;</button></li>");
            $('.list-group').append("<input type='hidden' class='hidden-item' name='ingredients[]' value='" + parseInt(id) + "' />");
            $('#listItem' + parseInt(id)).hide();
            $('#listItem' + parseInt(id)).show(500);
            showOrHideFindButton();
            checkForEmptyCategory();
            writeCookie();
        }
    }

    function writeCookie()
    {
        document.cookie = "ingredients=" + JSON.stringify(ingredients) + "*" + JSON.stringify(ingredientsName);
    }

    function encodeHTML(s) {
        return s.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/'/g, '&#x27;').replace(/\//g, '&#x2F;').replace(/"/g, '&quot;');
    }

    // If the category doesn't have ingredients anymore, display sad face
    function checkForEmptyCategory() {
        let empty = true;
        for (let i = 0; i < loadedIngredients.length; i++) {
            if (ingredients.indexOf(loadedIngredients[i]) == -1) {
                empty = false;
            }
        }
        if (empty) $("#sadFace").show(500);
        else $("#sadFace").hide(200);
    }

    // Remove ingredient in cart on delete click
    $('.list-group').on('click', '.btnRemoveIngredient', function (e) {
        let ingredient = e.target;
        let id = ingredient.value;

        var index = ingredients.indexOf(parseInt(id));
        if (index > -1) {
          ingredients.splice(index, 1);
          ingredientsName.splice(index, 1);
        }
        $(".list-group-item[value='" + parseInt(id) + "']").remove();
        $(".hidden-item[value='" + parseInt(id) + "']").remove();
        showOrHideFindButton();
        checkForEmptyCategory();
        $(("#" + ingredient.name + "Card").replace(/\s+/g, '')).show();

        writeCookie();
    });

    // Delete all the content of the cart
    $("#btnDeleteIngredients").click(function(e) {
        e.preventDefault();
        // Remove the group items of the cart
        for (let i = 0; i < ingredients.length; i++) {
            let id = ingredients[i];
            $(".list-group-item[value='" + id + "']").remove();
            $(".hidden-item[value='" + id + "']").remove();
        }
        // Show the cards of the ingredients
        for (let i = 0; i < loadedIngredientsName.length; i++) {
            let name = loadedIngredientsName[i];
            $(("#" + name + "Card").replace(/\s+/g, '')).show(500);
        }
        // Adapt the state of the cart visually
        ingredients = [];
        ingredientsName = [];
        showOrHideFindButton();
        checkForEmptyCategory();

        writeCookie();
    });

    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function showOrHideFindButton()
    {
        if (ingredients.length > 0) {
            $("#btnFindCocktail").show(500);
            $("#btnDeleteIngredients").show(500);
            $("#emptyCart").hide(200);
        } else {
            $("#btnFindCocktail").hide();
            $("#btnDeleteIngredients").hide();
            $("#emptyCart").show(500);
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
                        loadedIngredientsName = [];
                        $.each(data, function(i, value) {
                            loadedIngredients.push(parseInt(value.id));
                            loadedIngredientsName.push(value.name);
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
                                $(("#" + value.name + "Card").replace(/\s+/g, '')).hide(200);
                            } else {
                                counter++;
                            }
                        })
                        if (counter == 0) $("#sadFace").show(500);
                        else $("#sadFace").hide(200);
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
