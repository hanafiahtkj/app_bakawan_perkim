<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create2017RtlhTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('__rtlh', function (Blueprint $table) {
            $table->id();
            $table->string('nik');
            $table->string('nama_lengkap')->nullable();
            $table->char('id_kecamatan', 10)->nullable();
            $table->char('id_kelurahan', 10)->nullable();
            $table->string('alamat_lengkap')->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->integer('jenis_kelamin')->nullable();
            $table->integer('jenis_pekerjaan')->nullable();
            $table->integer('jml_penghasilan')->nullable();
            $table->integer('pernah_dibantu')->nullable();
            $table->string('bantuan_dari')->nullable();
            $table->integer('stts_verif')->nullable();
            $table->integer('stts_realisasi')->nullable();
            $table->integer('jml_kk')->nullable();
            $table->integer('jml_penghuni')->nullable();
            $table->integer('panjang')->nullable();
            $table->integer('lebar')->nullable();
            $table->integer('stts_tanah')->nullable();
            $table->integer('stts_rumah')->nullable();
            $table->integer('stts_tanah_lain')->nullable();
            $table->integer('stts_rumah_lain')->nullable();
            $table->string('foto_bangunan')->nullable();
            $table->string('koordinat_rumah')->nullable();
            $table->integer('pondasi')->nullable();
            $table->integer('kondisi_kolom')->nullable();
            $table->integer('kondisi_konstruksi')->nullable();
            $table->integer('jendela')->nullable();
            $table->integer('ventilasi')->nullable();
            $table->integer('stts_wc')->nullable();
            $table->integer('jarak_air_tpa')->nullable();
            $table->integer('sumber_air_minum')->nullable();
            $table->integer('sumber_listrik')->nullable();
            $table->integer('material_atap')->nullable();
            $table->integer('kondisi_atap')->nullable();
            $table->integer('material_dinding')->nullable();
            $table->integer('kondisi_dinding')->nullable();
            $table->integer('material_lantai')->nullable();
            $table->integer('kondisi_lantai')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('2017_rtlh');
    }
}
