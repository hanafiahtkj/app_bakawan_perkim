<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBantaranSungaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bantaran_sungai', function (Blueprint $table) {
            $table->id();
            $table->char('id_kecamatan', 10)->nullable();
            $table->char('id_kelurahan', 10)->nullable();
            $table->string('jenis');
            $table->string('jenis_penanganan');
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
        Schema::dropIfExists('bantaran_sungai');
    }
}
