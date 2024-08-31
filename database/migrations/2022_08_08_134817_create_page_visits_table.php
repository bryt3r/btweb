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
        Schema::create('page_visits', function (Blueprint $table) {
            $table->id();
            $table->string('url')->nullable();
            $table->string('page_identifier',50);
            $table->string('username')->nullable();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->string('device_info')->nullable();
            $table->string('user_state')->nullable();
            $table->string('user_country')->nullable();
            $table->string('device_brand')->nullable();
            $table->string('os_version')->nullable();
            $table->string('browser')->nullable();
            $table->string('user_ip')->nullable();
            $table->string('user_agent')->nullable();
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
        Schema::dropIfExists('page_visits');
    }
};
