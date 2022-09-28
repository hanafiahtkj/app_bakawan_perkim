<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKawasanKumuhTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kawasan_kumuh', function (Blueprint $table) {
            $table->id();
            $table->char('id_kecamatan', 10)->nullable();
            $table->char('id_kelurahan', 10)->nullable();
            $table->integer('jml_rumah');
            $table->integer('jml_kk');
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
        Schema::dropIfExists('kawasan_kumuh');
    }
}
