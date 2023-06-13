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
        Schema::create('skin_diaries', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->date('date');
            $table->string('skin_tone');
            $table->string('skin_status');
            $table->text('skin_status_text')->nullable();
            $table->string('acne');
            $table->text('acne_status_text')->nullable();
            $table->string('food');
            $table->text('food_content_text')->nullable();
            $table->string('skincare');
            $table->text('skincare_content_text')->nullable();
            $table->string('sleep');
            $table->string('defecation');
            $table->string('face_wash');
            $table->string('menstruation');
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
        Schema::dropIfExists('skin_diary');
    }
};
