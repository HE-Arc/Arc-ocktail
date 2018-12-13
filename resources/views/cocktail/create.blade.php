@extends('layouts.app')

@section('title')
    {{config('app.name', "Arc'ocktail")}}
@endsection

@push('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Script for sending with ajax the categorie form -->
<script>
$(document).ready(function(){
    $('#addIngredient').click(function(){
        let newIngredient = $('#ingredientsTemplate').clone();
        $(newIngredient).addClass("dynamic-added");
        $('#ingredientsList').append(newIngredient);
      });


      $.ajaxSetup({
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#cocktailSubmit').click(function(e){
                e.preventDefault();
                var formData = new FormData($('#addCocktail')[0]);
                 $.ajax({
                      url:"{{ url('/cocktail') }}",
                      method:"POST",
                      data: formData,
                      type:'json',
                      processData: false,
                      contentType: false,
                      success: function(data){
                          if(data.error){
                          printErrorMsg(data.error);
                          }else{
                              $('.dynamic-added').remove();
                              $('#addCocktail')[0].reset();
                              $(".no-error").find("span").html('');
                              $(".no-error").css('display','block');
                              $(".error").css('display','none');
                              $(".no-error").find("span").append('Le cocktail a bien été ajouté');
                          }
                      }
                 });
            });

        function printErrorMsg (msg) {
         $(".error").find("span").html('');
         $(".error").css('display','block');
         $(".no-error").css('display','none');
         $.each( msg, function( key, value ) {
            $(".error").find("span").append(value);
         });
      }

});




</script>
@endpush

@section('content')

    <div class="row p-2 m-0">
        <h1 class="col-12 p-1">Ajout de cocktail</h1>

        {!! Form::open(['route' => 'cocktail.store', 'files' => true, 'id' => 'addCocktail', 'class' => ['col-12', 'p-0', 'm-0']]) !!}
            <div class="row m-0 p-1">
                {!! Form::label('cocktailName', 'Nom du cocktail', ['class' => ['col-12 col-lg-5 m-0 p-1 border-0']]) !!}
                {!! Form::text('cocktailName', '', ['class' => ['col-12 col-lg-7 m-0 p-1 border-0']]) !!}
            </div>

            <div class="row m-0 p-1">
                {!! Form::label('alcoholDegree', "Degré d'alcool", ['class' => ['col-12 col-lg-5 m-0 p-1 border-0']]) !!}
                {!! Form::number('alcoholDegree', '', ['class' => ['col-12 col-lg-7 m-0 p-1 border-0']]) !!}
            </div>

            <div class="row m-0 p-1">
                {!! Form::label('recipe', 'Recette', ['class' => ['col-12 col-lg-5 m-0 p-1 border-0']]) !!}
                {!! Form::textarea('recipe', '', ['class' => ['col-12 col-lg-7 m-0 p-1 border-0']]) !!}
            </div>

            <div id="ingredientsList">
                <div class="row m-0 p-1" id="ingredientsTemplate">
                    {!! Form::label('ingredient[]', 'Ingrédient', ['class' => ['col-3 col-lg-5 m-0 p-1 border-0']]) !!}
                    {!! Form::number('quantity[]', '0', ['class' => ['col-2 col-lg-1 m-0 p-1 border-0']]) !!}

                    <div class="col-7 col-lg-6 p-0 pl-2">
                        {!! Form::select('ingredient[]', $ingredients, null, ['class' => ['w-100 m-0 p-1 border-0']]) !!}
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-7 offset-0 offset-lg-5 p-1 pl-lg-0">
                <button type="button" class="btn btn-primary rounded-0 w-100" id="addIngredient">Ajouter un ingrédient</button>
            </div>

            <div class="row m-0 p-1">
                {!! Form::label('image', "Photo du cocktail", ['class' => ['col-3 col-lg-5 m-0 p-1 border-0']]) !!}
                {!! Form::file('image', ['class' => ['col-9 col-lg-7 m-0 py-1 p-0 border-0']]) !!}
            </div>

            <div class="error alert bg-danger text-white rounded-0 border-0 my-2" style="display:none">
                <span></span>
            </div>
            <div class="no-error alert bg-success text-white rounded-0 border-0 my-2" style="display:none">
                <span></span>
            </div>
            <div class="row m-0 p-1">
                <button class="btn btn-success rounded-0 col-12 col-lg-7 offset-lg-5" id="cocktailSubmit">Sauvegarder le cocktail</button>
            </div>
        {!! Form::close() !!}

    <div>
@endsection
