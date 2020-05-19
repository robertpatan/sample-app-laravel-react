<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('uid')->nullable();
            $table->text('body')->nullable();
            $table->string('cert')->nullable();
            $table->string('class')->nullable();
            $table->integer('duration')->default(0);
            $table->string('headline')->nullable();
            $table->string('quote')->nullable();
            $table->integer('review_author_id')->nullable();
            $table->integer('rating')->default(0);
            $table->integer('year')->default(0);
            $table->string('sky_go_id')->nullable();
            $table->string('sky_go_url')->nullable();
            $table->string('sum')->nullable();
            $table->text('synopsis')->nullable();
            $table->string('url')->nullable();
            $table->timestamps();
            
            $table->index('uid');
    
            $table->foreign('review_author_id')->references('id')->on('persons');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movies');
    }
}
