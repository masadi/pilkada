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
        Schema::create('hak_pilih', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pemilu_id')->constrained('pemilu')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('tps_id')->constrained('tps')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedInteger('dpt_l');
            $table->unsignedInteger('dpt_p');
            $table->unsignedInteger('dpt_bl');
            $table->unsignedInteger('dpt_bp');
            $table->unsignedInteger('dpt_kl');
            $table->unsignedInteger('dpt_kp');
            $table->unsignedInteger('dis_l');
            $table->unsignedInteger('dis_p');
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
        Schema::dropIfExists('hak_pilih');
    }
};
