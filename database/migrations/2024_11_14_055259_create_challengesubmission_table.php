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
        Schema::create('challengesubmission', function (Blueprint $table) {
            $table->id();
            $table->string('name')->constrained()->onDelete('cascade'); // Tham chiếu đến bảng users
            $table->string('challenge_name')->constrained()->onDelete('cascade'); // Tham chiếu đến bảng challenges
            $table->text('flag'); // Flag mà người dùng gửi
            $table->string('type');
            $table->integer('value');
            $table->boolean('correct')->default(false); // Trạng thái flag đúng hay sai
            $table->boolean('locked')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('challengesubmission');
    }
};
