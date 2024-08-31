<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title',200);
            $table->string('slug',250)->unique();
            $table->string('identifier',50)->unique();
            $table->longText('content');
            $table->string('category',30);
            $table->string('author',50)->nullable();
            $table->boolean('published');
            $table->bigInteger('poster_id')->unsigned();
            $table->foreign('poster_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('posts');
    }
};
