<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRtlhKelayakanRumahTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rtlh_kelayakan_rumah', function (Blueprint $table) {
            $table->id();
            $table->integer('id_rtlh');
            $table->integer('pondasi');
            $table->integer('kondisi_kolom');
            $table->integer('kondisi_konstruksi');
            $table->integer('jendela');
            $table->integer('ventilasi');
            $table->integer('stts_wc');
            $table->integer('jarak_air_tpa');
            $table->integer('sumber_air_minum');
            $table->integer('sumber_listrik');
            $table->integer('panjang');
            $table->integer('lebar');
            $table->integer('material_atap');
            $table->integer('kondisi_atap');
            $table->integer('material_dinding');
            $table->integer('kondisi_dinding');
            $table->integer('material_lantai');
            $table->integer('kondisi_lantai');
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
        Schema::dropIfExists('rtlh_kelayakan_rumah');
    }
}
