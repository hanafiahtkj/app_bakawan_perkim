<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRtlhKondisiRumahTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rtlh_kondisi_rumah', function (Blueprint $table) {
            $table->id();
            $table->integer('id_rtlh');
            $table->integer('jml_kk');
            $table->integer('jml_penghuni');
            $table->integer('panjang');
            $table->integer('lebar');
            $table->integer('stts_tanah');
            $table->integer('stts_rumah');
            $table->integer('stts_tanah_lain');
            $table->integer('stts_rumah_lain');
            //$table->integer('bukti_kepemilikan');
            $table->string('foto_bangunan');
            $table->string('koordinat_rumah');
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rtlh_kondisi_rumah');
    }
}
