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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();
            // $table->foreignId('employee_id')
            //     ->constrained()
            //     ->cascadeOnDelete();
            $table->date('work_date');
            $table->time('clock_in')->nullable();
            $table->time('clock_out')->nullable();
            $table->time('break_in')->nullable();
            $table->time('break_out')->nullable();
            $table->timestamps();
            
            // 二重登録防止
            $table->unique(['user_id', 'work_date']);
            // $table->unique(['employee_id', 'work_date']);
            
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
        Schema::dropIfExists('attendances');
    }
};
