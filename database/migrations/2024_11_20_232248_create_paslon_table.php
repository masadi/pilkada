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
        Schema::create('paslon', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pemilu_id')->constrained('pemilu')->onUpdate('cascade')->onDelete('cascade');
            $table->string('nama');
            $table->unsignedInteger('nomor_urut')->length(1);
            $table->unsignedInteger('sah')->nullable();
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
        Schema::dropIfExists('paslon');
    }
};
