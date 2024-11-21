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
        Schema::create('tps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('desa_id')->constrained('desa')->onUpdate('cascade')->onDelete('cascade');
            $table->string('nama');
            $table->unsignedInteger('dpt_l');
            $table->unsignedInteger('dpt_p');
            $table->unsignedInteger('tambahan');
            $table->timestamps();
        });
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('tps_id')->references('id')->on('tps')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['tps_id']);
        });
        Schema::dropIfExists('tps');
    }
};
