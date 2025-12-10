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
        Schema::create('items', function (Blueprint $table) {
            $table->id()->index();
            $table->string('image_path'); //商品画像
            $table->string('name'); //商品名
            $table->bigInteger('price'); //価格
            $table->bigInteger('type'); //分類
            $table->string('storage'); //保管場所
            $table->bigInteger('stock'); //在庫数
            $table->bigInteger('avg_rating'); //平均評価
            $table->string('description')->default(null); //備考
            $table->boolean('resolved')->default(false); //完了チェック
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
        Schema::dropIfExists('items');
    }
};
