@extends('layouts.app')

@section('title')
    {{config('app.name', "Arc'ocktail")}}
@endsection

@push('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Script for sending with ajax the categorie form -->
<script>
$(document).ready(function(){
            $('#categorieSubmit').click(function(e){
               e.preventDefault();

               $.ajax({
                  url: "{{ url('/ingredient') }}",
                  method: 'post',
                  data: {
                      _token: '{{csrf_token()}}',
                     categorieName: $('#categorieName').val()
                  },
                  success: function(data){
                      if(data.error){
                      printErrorMsg(data.error);
                      }else{
                          $('#addCategorieForm')[0].reset();
                          $(".print-success-msg").find("ul").html('');
                          $(".print-success-msg").css('display','block');
                          $(".print-error-msg").css('display','none');
                          $(".print-success-msg").find("ul").append('<li>Record Inserted Successfully.</li>');
                      }}
                  });
               });

               $('#unitSubmit').click(function(e){
                  e.preventDefault();

                  $.ajax({
                     url: "{{ url('/ingredient') }}",
                     method: 'post',
                     data: {
                         _token: '{{csrf_token()}}',
                        unitName: $('#unitName').val()
                     },
                     success: function(data){
                         if(data.error){
                         printErrorMsg(data.error);
                         }else{
                             $('#addUnitForm')[0].reset();
                             $(".print-success-msg").find("ul").html('');
                             $(".print-success-msg").css('display','block');
                             $(".print-error-msg").css('display','none');
                             $(".print-success-msg").find("ul").append('<li>Record Inserted Successfully.</li>');
                         }}
                 });
                  });

                  $('#ingredientSubmit').click(function(e){
                     e.preventDefault();
                     var fd = new FormData();
                     fd.append('image', $("#image").get(0).files[0]);
                     fd.append('_token', "{{csrf_token()}}");
                     fd.append('ingredientName', $('#ingredientName').val());
                     fd.append('alcoholDegree', $('#alcoholDegree').val());
                     fd.append('categorie', $('#categorieId').val());
                     fd.append('unit', $('#unitId').val());
                     $.ajax({
                        url: "{{ url('/ingredient') }}",
                        method: 'post',
                        data: fd,
                        cache : false,
                        processData: false,
                        contentType: false,
                        success: function(data){
                            if(data.error){
                            printErrorMsg(data.error);
                            }else{
                                $('#addIngredientForm')[0].reset();
                                $(".print-success-msg").find("ul").html('');
                                $(".print-success-msg").css('display','block');
                                $(".print-error-msg").css('display','none');
                                $(".print-success-msg").find("ul").append('<li>Record Inserted Successfully.</li>');
                            }}
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

<div class="row m-2">
    <!-- Button and form to add a categorie-->
    <div class="p-0 col-lg-4 col-md-6 col-sm-12 m-2">
        <button type="button" class="btn btn-primary btn-lg w-100 m-0" data-toggle="modal" data-target="#addCategorie">Ajouter une catégorie</button>
    </div>
    <form method="post" action="{{url('ingredient')}}" id="addCategorieForm">
            @csrf

    <div class="modal fade" id="addCategorie" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="alert alert-danger print-error-msg" style="display:none">
            <ul></ul>
            </div>

            <div class="alert alert-success print-success-msg" style="display:none">
            <ul></ul>
            </div>
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


    <!-- Button and form to add a unit-->
    <div class="p-0 col-lg-4 col-md-6 col-sm-12 m-2">
        <button type="button" class="btn btn-primary btn-lg w-100 m-0" data-toggle="modal" data-target="#addUnit">Ajouter une unité</button>
    </div>
    <form method="post" action="{{url('ingredient')}}" id="addUnitForm">
            @csrf

    <div class="modal fade" id="addUnit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="alert alert-danger print-error-msg" style="display:none">
            <ul></ul>
            </div>

            <div class="alert alert-success print-success-msg" style="display:none">
            <ul></ul>
            </div>
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ajouter une unité</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <div class="row">
                    <label for="Name">Nom de l'unité:</label>
                    <input type="text" class="form-control" name="unitName" id="unitName">
              </div>
          </div>
          <div class="modal-footer">
          	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button  class="btn btn-success" id="unitSubmit">Save changes</button>
        </div>
        </div>
      </div>
    </div>
    </form>


    <!-- Button and form to add an ingredient-->
    <div class="p-0 col-lg-4 col-md-6 col-sm-12 m-2">
        <button type="button" class="btn btn-primary btn-lg w-100 m-0" data-toggle="modal" data-target="#addIngredient">Ajouter un ingrédient</button>
    </div>
    <form method="post" action="{{url('ingredient')}}" id="addIngredientForm" enctype="multipart/form-data">
            @csrf

    <div class="modal fade" id="addIngredient" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="alert alert-danger print-error-msg" style="display:none">
            <ul></ul>
            </div>

            <div class="alert alert-success print-success-msg" style="display:none">
            <ul></ul>
            </div>
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
              <div class="row">
                    <label for="Name">Image :</label>
                    <input type="file" name="image" id="image">
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
</div>

@endsection
