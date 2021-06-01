<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessOccupationPositionsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('business_occupation_positions', function (Blueprint $table) {
      $table->id();
      $table->foreignId('occupation_id')->constrained();
      $table->foreignId('position_id')->constrained();
      $table->foreignId('business_id')->constrained();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('business_occupation_positions');
  }
}
