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
            $table->string('image_path'); // 商品画像
            $table->string('name');       // 商品名
            $table->unsignedBigInteger('price'); // 価格
            $table->unsignedBigInteger('type');  // 分類
            $table->string('storage');           // 保管場所
            $table->unsignedBigInteger('stock'); // 在庫数
            $table->decimal('avg_rating', 3, 2)->default(0); // 平均評価 例: 4.25
            $table->string('description')->nullable(); // 備考（nullableに変更）
            $table->boolean('resolved')->default(false); // 完了チェック
            $table->string('spare1')->nullable(); // 予備
            $table->string('spare2')->nullable();
            $table->integer('spare3')->nullable();
            $table->integer('spare4')->nullable();

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
