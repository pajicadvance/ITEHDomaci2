<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('gpus', function (Blueprint $table) {
            $table->integer('clock');
            $table->integer('vram');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('gpus', function (Blueprint $table) {
            $table->dropColumn('clock');
            $table->dropColumn('vram');
        });
    }
};
