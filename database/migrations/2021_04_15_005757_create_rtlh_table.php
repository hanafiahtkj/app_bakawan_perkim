<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRtlhTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rtlh', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user');
            $table->string('nik');
            $table->string('nama_lengkap');
            // $table->integer('id_kecamatan');
            // $table->bigInteger('id_kelurahan');
            $table->char('id_kecamatan', 10)->nullable();
            $table->char('id_kelurahan', 10)->nullable();
            $table->string('alamat_lengkap');
            $table->date('tgl_lahir');
            $table->integer('jenis_kelamin');
            $table->integer('jenis_pekerjaan');
            $table->integer('jml_penghasilan');
            $table->integer('pernah_dibantu');
            $table->string('bantuan_dari');
            $table->integer('stts_verif')->nullable();
            $table->integer('stts_realisasi')->nullable();
            $table->integer('is_old')->nullable();
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
        Schema::dropIfExists('rtlh');
    }
}
