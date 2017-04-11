<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStandingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('standings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('team_id');
            $table->integer('championship_id');
            $table->integer('pos')->nullable()->default(0);
            $table->integer('pts');
            $table->integer('qty_games');
            $table->integer('qty_wins');
            $table->integer('qty_loses');
            $table->integer('qty_draw');
            $table->timestamps();


            $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');  
            $table->foreign('championship_id')->references('id')->on('championships')->onDelete('cascade');          

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('standings');
    }
}
