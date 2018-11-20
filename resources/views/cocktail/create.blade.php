@extends('layouts.app')

@section('title')
    {{config('app.name', "Arc'ocktail")}}
@endsection

@push('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Script for sending with ajax the categorie form -->
<script>
$(document).ready(function(){
    var i=1;
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
                              $(".print-success-msg").find("ul").html('');
                              $(".print-success-msg").css('display','block');
                              $(".print-error-msg").css('display','none');
                              $(".print-success-msg").find("ul").append('<li>Record Inserted Successfully.</li>');
                          }
                      }
                 });
            });

        function printErrorMsg (msg) {
         $(".print-error-msg").find("ul").html('');
         $(".print-error-msg").css('display','block');
         $(".print-success-msg").css('display','none');
         $.each( msg, function( key, value ) {
            $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
         });
      }

});




</script>
@endpush

@section('content')

<h1>Ajout de cocktail</h1>
{!! Form::open(['route' => 'cocktail.store', 'files' => true, 'id' => 'addCocktail']) !!}
<div class="alert alert-danger print-error-msg" style="display:none">
<ul></ul>
</div>

<div class="alert alert-success print-success-msg" style="display:none">
<ul></ul>
</div>

<div class="form-group">
{!! Form::label('cocktailName', 'Nom du cocktail') !!}
{!! Form::text('cocktailName') !!}
</div>
<div class="form-group">
{!! Form::label('alcoholDegree', "Degré d'alcool") !!}
{!! Form::number('alcoholDegree') !!}
</div>
{!! Form::label('recipe', 'Recette') !!}
{!! Form::textarea('recipe') !!}
<div id="ingredientsList">
    <div class="form-group" id="ingredientsTemplate">
            {!! Form::label('ingredient[]', 'Ingrédient') !!}
            {{ Form::select('ingredient[]', $ingredients) }}
            {!! Form::label('quantity[]', "Quantité") !!}
            {!! Form::number('quantity[]') !!}
    </div>
</div>
<div class="form-group">
{!! Form::label('image', "Photo du cocktail") !!}
{!! Form::file('image') !!}
</div>
<button type="button" class="btn btn-primary" id="addIngredient">
Ajouter un ingrédient
</button>
<button  class="btn btn-success" id="cocktailSubmit">Sauvegarder le cocktail</button>
{!! Form::close() !!}

@endsection
