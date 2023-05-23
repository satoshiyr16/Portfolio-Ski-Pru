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
        Schema::create('problem_articles', function (Blueprint $table) {
            // trueは1つずつ増える
            $table->unsignedBigInteger('id', true);
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('user_name')->nullable();
            $table->string('title',100);
            $table->string('name')->nullable();
            $table->string('path')->nullable();
            $table->longText('content');
            $table->unsignedBigInteger('user_id');
            // 論理削除を定義 deleted_atを自動生成 （データベースには残ってる）
            $table->softDeletes();
            // DBの時間を反映
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('problem_articles');
    }
};
