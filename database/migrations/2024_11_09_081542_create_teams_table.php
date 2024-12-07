<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->id(); // Thêm cột ID tự động tăng
            $table->string('teamname'); // Tên đội
            $table->string('team_leader');
            $table->string('website')->nullable(); // Website của đội
            $table->string('group')->nullable(); // Nhóm của đội
            $table->string('country')->nullable(); // Quốc gia của đội
            $table->integer('score')->default(0);
            $table->integer('rank')->default(0);
            $table->string('password');
            $table->timestamps(); // Cột created_at và updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teams');
    }
}
