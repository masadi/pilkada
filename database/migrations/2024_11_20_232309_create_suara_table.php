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
        Schema::create('suara', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pemilu_id')->constrained('pemilu')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('tps_id')->constrained('tps')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedInteger('sah');
            $table->unsignedInteger('tidak_sah');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('suara');
    }
};
