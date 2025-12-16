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
            $table->id();
            $table->unsignedBigInteger('item_id')->index();
            $table->unsignedBigInteger('user_id')->index();
            $table->smallInteger('rating'); // 評価
            $table->text('review'); // 商品レビュー
            $table->timestamps();

            // 予備
            $table->string('spare1')->nullable();
            $table->string('spare2')->nullable();
            $table->integer('spare3')->nullable();
            $table->integer('spare4')->nullable();
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
