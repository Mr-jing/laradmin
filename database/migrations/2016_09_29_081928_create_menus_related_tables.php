<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusRelatedTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('uri');
            $table->string('params');
            $table->integer('parent_id')->unsigned();
            $table->integer('sort');
            $table->boolean('status');
            $table->timestamps();
        });

        Schema::create('role_menu', function (Blueprint $table) {
            $table->integer('role_id')->unsigned();
            $table->integer('menu_id')->unsigned();
            $table->foreign('role_id')->references('id')->on('roles')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('menu_id')->references('id')->on('menus')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->primary(['role_id', 'menu_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('role_menu');
        Schema::drop('menus');
    }
}
