<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRtlhVerifTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rtlh_verif', function (Blueprint $table) {
            $table->id();
            $table->integer('id_rtlh');
            $table->integer('id_user');
            $table->string('nik');
            $table->string('nama_lengkap');
            $table->string('alamat_lengkap');
            $table->integer('jenis_pekerjaan');
            $table->integer('jml_penghasilan');
            $table->string('koordinat_rumah');
            // $table->integer('dibawah_umk');
            // $table->integer('sudah_berkeluarga');
            // $table->integer('menguasai_tanah');
            // $table->integer('blm_memiliki_rumah');
            // $table->integer('blm_menerima_bantuan');
            $table->text('custom_field')->nullable();
            $table->text('catatan')->nullable();
            $table->integer('stts_verif');
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
        Schema::dropIfExists('rtlh_verif');
    }
}
