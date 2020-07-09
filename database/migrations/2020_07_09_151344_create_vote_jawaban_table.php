<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVoteJawabanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vote_jawaban', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('count');
            $table->timestamps();
            $table->unsignedBigInteger('jawaban_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('jawaban_id')->references('id')->on('jawaban');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('votejawaban');
    }
}
