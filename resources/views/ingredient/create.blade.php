@extends('layouts.app')

@section('title')
    {{config('app.name', "Arc'ocktail")}}
@endsection

@push('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Script for sending with ajax the categorie form -->
<script>
jQuery(document).ready(function(){
            jQuery('#categorieSubmit').click(function(e){
               e.preventDefault();

               jQuery.ajax({
                  url: "{{ url('/ingredient') }}",
                  method: 'post',
                  data: {
                      _token: '{{csrf_token()}}',
                     categorieName: jQuery('#categorieName').val()
                  },
                  success: function(result){
                  	if(result.errors)
                  	{
                  		jQuery('.alert-danger').html('');
                        jQuery('.alert-success').hide();
                  		jQuery.each(result.errors, function(key, value){
                  			jQuery('.alert-danger').show();
                  			jQuery('.alert-danger').append('<li>'+value+'</li>');
                  		});
                  	}
                  	else
                  	{
                        jQuery('.alert-danger').hide();
              			jQuery('.alert-success').show();
              			jQuery('.alert-success').append('<li>'+result.success+'</li>');
                        setTimeout(function() {
                            $(".alert-success").alert('close');
                        }, 2000);
                  	}
                  }});
               });
            });
</script>

<!-- Script for sending with ajax the ingredient form -->
<script>
jQuery(document).ready(function(){
            jQuery('#ingredientSubmit').click(function(e){
               e.preventDefault();

               jQuery.ajax({
                  url: "{{ url('/ingredient') }}",
                  method: 'post',
                  data: {
                      _token: '{{csrf_token()}}',
                     ingredientName: jQuery('#ingredientName').val(),
                     alcoholDegree: jQuery('#alcoholDegree').val(),
                     categorie: jQuery('#categorieId').val(),
                     unit: jQuery('#unitId').val()
                  },
                  success: function(result){
                  	if(result.errors)
                  	{
                  		jQuery('.alert-danger').html('');
                        jQuery('.alert-success').hide();
                  		jQuery.each(result.errors, function(key, value){
                  			jQuery('.alert-danger').show();
                  			jQuery('.alert-danger').append('<li>'+value+'</li>');
                  		});
                  	}
                  	else
                  	{
                        jQuery('.alert-danger').hide();
              			jQuery('.alert-success').show();
              			jQuery('.alert-success').append('<li>'+result.success+'</li>');
                        setTimeout(function() {
                            $(".alert-success").alert('close');
                        }, 2000);
                  	}
                  }});
               });
            });
</script>
@endpush

@section('content')

<!-- Button and form to add a categorie-->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCategorie">
  Ajouter une catégorie
</button>

<form method="post" action="{{url('ingredient')}}" id="addCategorieForm">
        @csrf

<div class="modal fade" id="addCategorie" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="alert alert-danger" style="display:none"></div>
        <div class="alert alert-success" style="display:none"></div>
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ajouter une catégorie</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="row">
                <label for="Name">Nom de la catégorie:</label>
                <input type="text" class="form-control" name="categorieName" id="categorieName">
          </div>
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button  class="btn btn-success" id="categorieSubmit">Save changes</button>
    </div>
    </div>
  </div>
</div>
</form>

<!-- Button and form to add an ingredient-->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addIngredient">
  Ajouter un ingrédient
</button>

<form method="post" action="{{url('ingredient')}}" id="addIngredientForm">
        @csrf

<div class="modal fade" id="addIngredient" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="alert alert-danger" style="display:none"></div>
        <div class="alert alert-success" style="display:none"></div>
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ajouter un ingrédient</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="row">
                <label for="Name">Nom de l'ingrédient :</label>
                <input type="text" class="form-control" name="ingredientName" id="ingredientName">
          </div>

          <div class="row">
                <label for="Name">Degré d'alcool :</label>
                <input type="number" class="form-control" name="alcoholDegree" id="alcoholDegree">
          </div>

          <div class="row">
                <label for="Name">Catégorie :</label>
                <select name="categorieId" id="categorieId">
                @foreach($data["categories"] as $categorie)
                    <option value="{{ $categorie->id }}">
                        {{ $categorie->name }}
                    </option>
                @endforeach
                </select>
          </div>

          <div class="row">
                <label for="Name">Unité :</label>
                <select name="unit" id="unitId">
                @foreach($data["units"] as $unit)
                    <option value="{{ $unit->id }}">
                        {{ $unit->unit }}
                    </option>
                @endforeach
                </select>
          </div>
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button  class="btn btn-success" id="ingredientSubmit">Save changes</button>
    </div>
    </div>
  </div>
</div>
</form>

@endsection
