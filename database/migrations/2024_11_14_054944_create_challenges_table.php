<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChallengesTable extends Migration
{
    public function up()
    {
        Schema::create('challenges', function (Blueprint $table) {
            $table->id();
            $table->string('challenge_name')->nullable();
            $table->text('description')->nullable();
            $table->string('difficulty');
            $table->string('type');
            $table->string('file')->nullable();
            $table->string('link')->nullable();
            $table->integer('points')->default(1000);
            $table->string('flag');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('challenges');
    }
}
