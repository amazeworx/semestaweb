<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDailyMarketsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('daily_markets', function (Blueprint $table) {
      $table->id();
      $table->text('content');
      $table->date('post_date');
      $table->string('post_status');
      $table->timestamps();
      $table->softDeletes($column = 'deleted_at', $precision = 0);
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('daily_markets');
  }
}
