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
        Schema::create('diary_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('skin_diary_id');
            $table->string('path');
            $table->foreign('skin_diary_id')->references('id')->on('skin_diaries')->onDelete('cascade');
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
        Schema::dropIfExists('diary_images');
    }
};
