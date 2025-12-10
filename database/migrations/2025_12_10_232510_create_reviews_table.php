<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id()->index();
            $table->bigInteger('item_id')->index(); // 商品ID
            $table->bigInteger('user_id')->index(); // ユーザーID
            $table->string('image_path'); // 商品画像
            $table->string('name'); // 商品名
            $table->smallInteger('rating'); // 評価
            $table->string('review'); // 商品レビュー
            $table->string('spare1'); //予備1
            $table->string('spare2'); //予備2
            $table->integer('spare3'); //予備3
            $table->integer('spare4'); //予備4
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
