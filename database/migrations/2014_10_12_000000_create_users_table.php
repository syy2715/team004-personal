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
Schema::create('users', function (Blueprint $table) {
    $table->id()->index();
    $table->string('name')->index();    // 名前
    $table->string('email')->unique();  // メールアドレス
    $table->timestamp('email_verified_at')->nullable(); // 確認日時
    $table->string('password');  // パスワード
    $table->integer('age')->nullable();      // 年齢
    $table->string('address')->nullable(); // 住所
    $table->string('phone')->nullable();   // 電話番号
    $table->unsignedBigInteger('group')->nullable(); // 部署
    $table->unsignedBigInteger('role')->nullable();  // 役職
    $table->unsignedBigInteger('sales_office')->nullable(); // 営業所
    $table->timestamp('start_day')->nullable(); // 入社日
    $table->string('remember_token')->nullable(); // トークン

    // 予備
    $table->string('spare1')->nullable();
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
        Schema::dropIfExists('users');
    }
};
