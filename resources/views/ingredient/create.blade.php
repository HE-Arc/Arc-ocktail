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
                      printErrorMsg(data.error, "cat-");
                      }else{
                          $('#addCategorieForm')[0].reset();
                          $(".cat-no-error").find("span").html('');
                          $(".cat-no-error").css('display','block');
                          $(".cat-error").css('display','none');
                          $(".cat-no-error").find("span").append('La catégorie a bien été ajoutée !');
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
                         printErrorMsg(data.error, "unit-");
                         }else{
                             $('#addUnitForm')[0].reset();
                             $(".unit-no-error").find("span").html('');
                             $(".unit-no-error").css('display','block');
                             $(".unit-error").css('display','none');
                             $(".unit-no-error").find("span").append('L\'unité a bien été ajoutée !');
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
                            printErrorMsg(data.error, "ing-");
                            }else{
                                $('#addIngredientForm')[0].reset();
                                $(".ing-no-error").find("span").html('');
                                $(".ing-no-error").css('display','block');
                                $(".ing-error").css('display','none');
                                $(".ing-no-error").find("span").append('L\'ingérdient a bien été ajouté !');
                            }}
                     });
                 });

                     function printErrorMsg (msg, elem) {
                      $("."+elem+"error").find("span").html('');
                      $("."+elem+"error").css('display','block');
                      $("."+elem+"no-error").css('display','none');
                      $.each( msg, function( key, value ) {
                         $("."+elem+"error").find("span").append(value);
                      });
                   }
            });
</script>

@endpush

@section('content')

<div class="row p-2 m-0">
    <h1 class="col-12">Création d'éléments</h1>

    <!-- Button and form to add a categorie-->
    <div class="col-12 col-md-6 col-lg-4 p-2">
        <button type="button" class="btn btn-primary btn-lg w-100 m-0 rounded-0" data-toggle="modal" data-target="#addCategorie">Ajouter une catégorie</button>
    </div>
    <form method="post" action="{{url('ingredient')}}" id="addCategorieForm">
        @csrf
        <div class="modal fade" id="addCategorie" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content p-2 rounded-0 bg-dark">
                    <div class="modal-header p-2 border-0">
                        <h5 class="modal-title" id="exampleModalLabel">Ajouter une catégorie</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body p-2 border-0">
                        <label for="Name">Nom de la catégorie :</label>
                        <input type="text" class="form-control rounded-0" name="categorieName" id="categorieName">

                        <div class="cat-error alert bg-danger text-white rounded-0 border-0 my-2" style="display:none">
                            <span></span>
                        </div>
                        <div class="cat-no-error alert bg-success text-white rounded-0 border-0 my-2" style="display:none">
                            <span></span>
                        </div>

                    </div>
                    <div class="modal-footer p-2 border-0">
                        <button type="button" class="btn btn-secondary rounded-0" data-dismiss="modal">Close</button>
                        <button  class="btn btn-success rounded-0" id="categorieSubmit">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Button and form to add a unit-->
    <div class="col-12 col-md-6 col-lg-4 p-2">
        <button type="button" class="btn btn-primary btn-lg w-100 m-0 rounded-0" data-toggle="modal" data-target="#addUnit">Ajouter une unité</button>
    </div>
    <form method="post" action="{{url('ingredient')}}" id="addUnitForm">
        @csrf
        <div class="modal fade" id="addUnit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content p-2 rounded-0 bg-dark">
                    <div class="modal-header p-2 border-0">
                        <h5 class="modal-title" id="exampleModalLabel">Ajouter une unité</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body p-2 border-0">
                        <label for="Name">Nom de l'unité :</label>
                        <input type="text" class="form-control rounded-0" name="unitName" id="unitName">

                        <div class="unit-error alert bg-danger text-white rounded-0 border-0 my-2" style="display:none">
                            <span></span>
                        </div>
                        <div class="unit-no-error alert bg-success text-white rounded-0 border-0 my-2" style="display:none">
                            <span></span>
                        </div>
                    </div>
                    <div class="modal-footer p-2 border-0">
                        <button type="button" class="btn btn-secondary rounded-0" data-dismiss="modal">Close</button>
                        <button  class="btn btn-success rounded-0" id="unitSubmit">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Button and form to add an ingredient-->
    <div class="col-12 col-md-6 col-lg-4 p-2">
        <button type="button" class="btn btn-primary btn-lg w-100 m-0 rounded-0" data-toggle="modal" data-target="#addIngredient">Ajouter un ingrédient</button>
    </div>
    <form method="post" action="{{url('ingredient')}}" id="addIngredientForm" enctype="multipart/form-data">
        @csrf
        <div class="modal fade" id="addIngredient" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content p-2 rounded-0 bg-dark">
                    <div class="modal-header p-2  border-0">
                        <h5 class="modal-title" id="exampleModalLabel">Ajouter un ingrédient</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body p-2  border-0">
                        <div class="row p-0 py-1 m-0">
                            <label for="Name">Nom de l'ingrédient :</label>
                            <input type="text" class="form-control rounded-0" name="ingredientName" id="ingredientName">
                        </div>

                        <div class="row p-0 py-1 m-0">
                            <label for="Name" class="col-6">Degré d'alcool :</label>
                            <input type="number" class="form-control col-6 rounded-0" name="alcoholDegree" id="alcoholDegree">
                        </div>

                        <div class="row p-0 py-1 m-0">
                            <label for="Name" class="col-6">Catégorie :</label>
                            <select name="categorieId" class="col-6" id="categorieId">
                                @foreach($data["categories"] as $categorie)
                                    <option value="{{ $categorie->id }}">{{ $categorie->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="row p-0 py-1 m-0">
                            <label for="Name" class="col-6">Unité :</label>
                            <select name="unit" id="unitId" class="col-6">
                                @foreach($data["units"] as $unit)
                                    <option value="{{ $unit->id }}">{{ $unit->unit }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row p-0 py-1 m-0">
                            <label for="Name" class="col-6">Image :</label>
                            <input type="file" class="col-6" name="image" id="image">
                        </div>

                        <div class="ing-error alert bg-danger text-white rounded-0 border-0 my-2" style="display:none">
                            <span></span>
                        </div>
                        <div class="ing-no-error alert bg-success text-white rounded-0 border-0 my-2" style="display:none">
                            <span></span>
                        </div>
                    </div>
                    <div class="modal-footer p-2  border-0">
                        <button type="button" class="btn btn-secondary rounded-0" data-dismiss="modal">Close</button>
                        <button  class="btn btn-success rounded-0" id="ingredientSubmit">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection
