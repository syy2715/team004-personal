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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();                      // ID
            $table->string('name');            // 名前
            $table->string('group');           // 所属課（チーム決定）
            $table->string('email');           // メール
            $table->string('phone')->nullable(); // 電話番号
            $table->string('password');        // パスワード（ハッシュ化）
            $table->timestamps();              // created_at, updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
