<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeagueRankingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('league__rankings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('score');
            $table->integer('league_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->index('league_id') ;
            $table->index('user_id') ;
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('league_id')->references('id')->on('leagues')->onDelete('cascade');
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
        Schema::dropIfExists('league__rankings');
    }
}
