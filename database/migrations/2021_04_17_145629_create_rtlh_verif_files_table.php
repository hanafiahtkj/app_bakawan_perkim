<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRtlhVerifFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rtlh_verif_files', function (Blueprint $table) {
            $table->id();
            $table->integer('id_rtlh');
            $table->integer('id_rtlh_verif');
            //$table->string('type')->nullable();
            $table->integer('id_setup');
            $table->string('files');
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
        Schema::dropIfExists('rtlh_verif_files');
    }
}
