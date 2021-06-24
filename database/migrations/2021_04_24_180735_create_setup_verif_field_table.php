<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSetupVerifFieldTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setup_verif_field', function (Blueprint $table) {
            $table->id();
            $table->integer('id_setup');
            $table->string('name');
            $table->char('type', 32);
            $table->text('value');
            $table->tinyInteger('status');
            $table->integer('sort_order');
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
        Schema::dropIfExists('setup_verif_field');
    }
}
