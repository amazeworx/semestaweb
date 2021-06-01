<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cities', function (Blueprint $table) {
          $table->char('id', 4)->index();
          $table->char('province_id', 2);
          $table->string('name', 50);
          $table->string('ksei_code', 4);
          $table->string('ksei_name');
          $table->foreign('province_id')
              ->references('id')
              ->on('provinces')
              ->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cities');
    }
}
