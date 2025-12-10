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
            $table->string('name')->index(); //名前
            $table->string('email')->index(); //メールアドレス
            $table->timestamp('email_verified_at')->default(null); //メールアドレス確認日時
            $table->string('password'); //パスワード
            $table->integer('age'); //年齢
            $table->string('address')->default(null); //住所
            $table->string('phone')->default(null); //電話番号
            $table->bigInteger('group'); //部署
            $table->bigInteger('role'); //役職
            $table->bigInteger('sales_office'); //営業所
            $table->timestamp('start_day')->nullable(); //入社日
            $table->string('remember_token')->default(null); //保持トークン
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
        Schema::dropIfExists('users');
    }
};
