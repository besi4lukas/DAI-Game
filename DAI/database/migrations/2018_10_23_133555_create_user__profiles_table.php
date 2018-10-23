<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user__profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username',20);
            $table->string('firstName',50);
            $table->string('lastName',50);
            $table->text('user_image');
            $table->integer('user_coins');
            $table->integer('user_id')->unsigned();
            $table->index('user_id') ;
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('user__profiles');
    }
}
