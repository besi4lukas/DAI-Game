<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('results', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('winner_id')->unsigned() ;
            $table->integer('loser_id')->unsigned() ;
            $table->integer('game_id')->unsigned() ;
            $table->index('game_id') ;
            $table->index('winner_id') ;
            $table->index('loser_id') ;
            $table->foreign('winner_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('loser_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('game_id')->references('id')->on('games')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('results');
    }
}
