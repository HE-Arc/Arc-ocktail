<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quantities', function (Blueprint $table) {
            // $table->foreign('cocktail_id')->references('id')->on('cocktails')->onDelete('cascade')->onUpdate('cascade');
            // $table->foreign('ingredient_id')->references('id')->on('ingredients')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('cocktail_id')->references('id')->on('cocktails');
            $table->foreign('ingredient_id')->references('id')->on('ingredients');
        });

        Schema::table('ingredients', function (Blueprint $table) {
            // $table->foreign('categorie_id')->references('id')->on('categories')->onDelete('set null')->onUpdate('cascade');
            // $table->foreign('unit_id')->references('id')->on('units')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('categorie_id')->references('id')->on('categories');
            $table->foreign('unit_id')->references('id')->on('units');
        });

        Schema::table('users', function (Blueprint $table) {
            // $table->foreign('role_id')->references('id')->on('roles')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('role_id')->references('id')->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
