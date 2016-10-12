<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoutesRelatedTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('routes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->char('method', 20);
            $table->string('uri');
            $table->char('group', 20)->default('');
            $table->timestamps();
            $table->unique(['method', 'uri']);
        });

        Schema::create('role_route', function (Blueprint $table) {
            $table->integer('role_id')->unsigned();
            $table->integer('route_id')->unsigned();
            $table->foreign('role_id')->references('id')->on('roles')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('route_id')->references('id')->on('routes')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->primary(['role_id', 'route_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('role_route');
        Schema::drop('routes');
    }
}
