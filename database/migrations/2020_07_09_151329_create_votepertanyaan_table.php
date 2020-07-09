<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVotepertanyaanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('votepertanyaan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('count');
            $table->timestamps();
            $table->integer('pertanyaan_id')->references('id')->on('pertanyaan');
            $table->integer('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('votepertanyaan');
    }
}
