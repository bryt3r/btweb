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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug', 250)->unique();
            $table->string('identifier', 50)->unique();
            $table->string('category');
            $table->string('brand');
            $table->string('condition');
            $table->longText('description');
            $table->boolean('price_set');
            $table->boolean('is_listed');
            $table->boolean('is_sold');
            $table->boolean('discounted');
            $table->decimal('costprice', 15, 7);
            $table->decimal('sellingprice', 15, 7)->nullable();
            $table->decimal('saleprice', 15, 7)->nullable();
            $table->decimal('discount', 2, 2)->nullable();
            $table->bigInteger('lister_id')->unsigned();
            $table->foreign('lister_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('products');
    }
};
