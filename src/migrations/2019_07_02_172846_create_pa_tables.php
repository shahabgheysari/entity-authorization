<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name',150);
            $table->timestamps();
        });

        Schema::create('role_page',function(Blueprint $table){
            $table->increments('id')->unsigned();
            $table->integer('role_id')->unsigned();
            $table->integer('page_id')->unsigned();
            $table->tinyInteger('granted')->default(1);
            $table->timestamps();
            $table->foreign('role_id')->references('id')->on('roles');
            $table->foreign('page_id')->references('id')->on('pages')->onDelete('cascade');
        });

        Schema::create('permission_page',function(Blueprint $table){
            $table->increments('id')->unsigned();
            $table->integer('permission_id')->unsigned();
            $table->integer('page_id')->unsigned();
            $table->tinyInteger('granted')->default(1);
            $table->timestamps();
            $table->foreign('permission_id')->references('id')->on('permissions');
            $table->foreign('page_id')->references('id')->on('pages')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pages');
        Schema::dropIfExists('role_page');
        Schema::dropIfExists('permission_page');
    }
}
