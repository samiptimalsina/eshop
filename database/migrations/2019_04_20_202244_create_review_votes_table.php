<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewVotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('review_votes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();

            $table->integer('review_id')->unsigned()->index();
            $table->foreign('review_id')->references('id')->on('reviews')->onDelete('cascade');

            $table->integer('help_full');
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
        Schema::dropIfExists('review_votes');
    }
}
